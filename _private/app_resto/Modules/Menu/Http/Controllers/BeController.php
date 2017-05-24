<?php
namespace Modules\Menu\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Menu\Models\Menu,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Menu
    |--------------------------------------------------------------------------
    */
    public function index($isTrash=false)
    {
        if ( Request::isMethod('get') )
        {
            $rows = Menu::query();

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('pemilik_id', Session::get('ses_switch_active'));
            }
            $rows_ = clone $rows;

            $this->dataView['countAll'] = $rows->where('status', '<>', '-1')->count();
            $this->dataView['countTrash'] = $rows_->where('status', '-1')->count();

            $this->dataView['isTrash'] = $isTrash;

            return view('menu::index', $this->dataView);
        }
        else
        {
            $rows = $isTrash ? Menu::where('status', '-1') : Menu::where('status', '<>', '-1');

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('pemilik_id', Session::get('ses_switch_active'));
            }
            return Datatables::of($rows->with('rel_kategori'))
            ->addColumn('action', function ($r) use ($isTrash) { return $this->_buildAction($r->id, $r->nama, 'default', $isTrash); })
            ->editColumn('nama', function ($r) { return createLink( FeUrl('kuliner/'.val($this->activeState, 'url').'/menu/'.$r->url.'.html'), $r->nama ); })
            ->editColumn('harga', function ($r) { return formatNumber($r->harga, 0, true); })
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
        $data = $id ? Menu::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 
        
        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');
        
        $this->dataView['dataForm']['publish_url'] = $data ? FeUrl('kuliner/'.val($this->activeState, 'url').'/'.val($data, 'url').'.html', val($data, 'nama') ) : null;

        return view('menu::form', $this->dataView);
    }
    
    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Menu(), $id, (val($_GET, 'permanent')=='1' ? null : ['status'=>'-1'])), 
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
            'status' => $this->_deleteData(new Menu(), $id, ['status'=>'1']), 
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

        $image = isset($input['foto_utama']) ? $input['foto_utama'] : null; unset($input['foto_utama']);
        
        if ( $image && is_string($image) )
        {
            $input['foto_utama'] = $image; $image = null;
        }

        //owner
        $input['pemilik_id'] = session::get('ses_switch_active');
        
        //multiple image
        $input['foto'] = isset($input['foto']) ? json_encode(array_filter($input['foto'])) : null;
        
        $status = $this->_saveData( new Menu(), [   
            //VALIDATOR
            "nama" => "required|unique:mod_menu". ($input['id'] ? ",nama,".$input['id'] : '')
        ], $input, 'nama');

        if ( $status && $image )
        {
            $image = $this->_uploadImage($image, 'menu', ['600x800', '200x300'], $input['url']);
            
            if ( isset($image['600x800']) )
            {
                Menu::where('id', $status)->update(['foto_utama'=>$image['600x800']]);
            }
        }

        $this->clearCache( config('menu.info.alias').'/'.$input['url'].'.html' );

        return Redirect( BeUrl( config('menu.info.alias') .(!$status ? ($input['id']?'/edit/'.$input['id']:'/add') : '') ) );
    }
}