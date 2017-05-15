<?php
namespace Modules\Kategori\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Kategori\Models\Kategori,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Kategori
    |--------------------------------------------------------------------------
    */
    public function index($isTrash=false)
    {
        if ( Request::isMethod('get') )
        {
            $this->dataView['form'] = $this->form();

            $rows = Kategori::query();

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('owner_id', Session::get('ses_switch_active'));
            }

            $this->dataView['countAll'] = $rows->where('status', '<>', '-1')->count();
            $this->dataView['countTrash'] = $rows->where('status', '-1')->count();

            $this->dataView['isTrash'] = $isTrash;
            
            return view('kategori::index', $this->dataView);
        }
        else
        {
            $rows = $isTrash ? Kategori::where('status', '-1') : Kategori::where('status', '<>', '-1');

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('owner_id', Session::get('ses_switch_active'));
            }
            
            return Datatables::of($rows)
            ->addColumn('action', function ($r) use ($isTrash) { return $this->_buildAction($r->id, $r->nama, 'default', $isTrash); })
            ->editColumn('nama', function ($r) { return createLink( url(config('kategori.info.alias').'/'.$r->url.'.html'), $r->nama ); })
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
        $data = $id ? Kategori::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 
        
        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');

        return view('kategori::form', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Kategori(), $id, (val($_GET, 'permanent')=='1' ? null : ['status'=>'-1'])), 
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
            'status' => $this->_deleteData(new Kategori(), $id, ['status'=>'1']), 
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

        //owner
        $input['owner_id'] = session::get('ses_switch_active');

        $status = $this->_saveData( new Kategori(), [   
            //VALIDATOR
            "nama" => "required|unique:mod_kategori". ($input['id'] ? ",nama,".$input['id'] : '')
        ], $input, 'nama');

        $this->clearCache( config('kategori.info.alias').'/'.$input['url'].'.html' );
                
        return Response()->json([ 
            'status' => $status, 
            'message'=> $this->_buildNotification(true),
            'form'   => $status ? base64_encode($this->form()) : null
        ]);
    }
}