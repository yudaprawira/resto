<?php
namespace Modules\Restoran\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Restoran\Models\Restoran,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Restoran
    |--------------------------------------------------------------------------
    */
    public function index($isTrash=false)
    {
        if ( Request::isMethod('get') )
        {
            $rows = Restoran::query();

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where(function($q){
                    $q->where('created_by', Session::get('ses_userid'))
                    ->orWhere('id', str_replace('resto-', '', Session::get('ses_default_company')));
                });
            }

            $this->dataView['countAll'] = $rows->where('status', '<>', '-1')->count();
            $this->dataView['countTrash'] = $rows->where('status', '-1')->count();

            $this->dataView['isTrash'] = $isTrash;

            return view('restoran::index', $this->dataView);
        }
        else
        {
            $rows = $isTrash ? Restoran::where('status', '-1') : Restoran::where('status', '<>', '-1');

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where(function($q){
                    $q->where('created_by', Session::get('ses_userid'))
                    ->orWhere('id', str_replace('resto-', '', Session::get('ses_default_company')));
                });
            }
            
            return Datatables::of($rows)
            ->addColumn('action', function ($r) use ($isTrash) { return $this->_buildAction($r->id, $r->nama, 'default', $isTrash); })
            ->editColumn('nama', function ($r) { return createLink( FeUrl('kuliner/'.$r->url), $r->nama ); })
            ->editColumn('status', function ($r) { return $r->status=='1' ? trans('global.active') : trans('global.inactive'); })
            ->editColumn('created_at', function ($r) { return formatDate($r->created_at, 5); })
            ->editColumn('updated_at', function ($r) { return $r->updated_at ? formatDate($r->updated_at, 5) : '-'; })
            ->make(true);
        }
    }

    public function trash()
    {
        return $this->index(true);
    }

    /*
    |--------------------------------------------------------------------------
    | Build Form
    |--------------------------------------------------------------------------
    */
    public function form($id='')
    {
        $data = $id ? Restoran::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 

        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');

        return view('restoran::form', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Restoran(), $id, (val($_GET, 'permanent')=='1' ? null : ['status'=>'-1'])), 
            'message'=> $this->_buildNotification(true)
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Restore
    |--------------------------------------------------------------------------
    */
    function restore($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Restoran(), $id, ['status'=>'1']), 
            'message'=> $this->_buildNotification(true)
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Save Data | Insert Or Update
    |--------------------------------------------------------------------------
    */
    function save()
    {
        $input  = Input::except('_token');
        
        $input['url'] = str_slug(trim($input['nama']));
        $input['status'] = val($input, 'status') ? 1 : 0;

        $image = isset($input['image']) ? $input['image'] : null; unset($input['image']);

        if ( $image && is_string($image) )
        {
            $input['foto_utama'] = $image; $image = null;
        }
        
        //multiple image & type
        $input['foto'] = isset($input['foto']) ? json_encode(array_filter($input['foto'])) : null;
        $input['type'] = isset($input['type']) ? json_encode(array_filter($input['type'])) : null;
        $input['meja'] = isset($input['meja']) ? json_encode(array_filter($input['meja'])) : null;
        $input['kategori'] = isset($input['kategori']) ? json_encode(array_filter($input['kategori'])) : null;
        $input['jam_operasional'] = isset($input['jam_operasional']) ? json_encode(array_filter($input['jam_operasional'])) : null;

        $status = $this->_saveData( new Restoran(), [   
            //VALIDATOR
            "nama" => "required|unique:mod_restoran". ($input['id'] ? ",nama,".$input['id'] : '')
        ], $input, 'nama');

        if ( $status && $image )
        {
            $image = $this->_uploadImage($image, 'restoran', ['600x800', '200x300'], $input['url']);
            
            if ( isset($image['600x800']) )
            {
                Restoran::where('id', $status)->update(['foto_utama'=>$image['600x800']]);
            }
        }

        $this->clearCache( 'kuliner/'.$input['url'] );

        return Redirect( BeUrl( config('restoran.info.alias') .(!$status ? ($input['id']?'/edit/'.$input['id']:'/add') : '') ) );
    }
}