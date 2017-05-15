<?php
namespace Modules\Membership\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Membership\Models\Membership,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Membership
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if ( Request::isMethod('get') )
        {
            return view('membership::index', $this->dataView);
        }
        else
        {
            return Datatables::of(Membership::query())
            ->addColumn('action', function ($r) { return $this->_buildAction($r->id, $r->nama); })
            ->editColumn('nama', function ($r) { return createLink( url(config('membership.info.alias').'/'.$r->url.'.html'), $r->nama ); })
            ->editColumn('status', function ($r) { return $r->status=='1' ? trans('global.active') : trans('global.inactive'); })
            ->editColumn('created_at', function ($r) { return formatDate($r->created_at, 5); })
            ->editColumn('updated_at', function ($r) { return $r->updated_at ? formatDate($r->updated_at, 5) : '-'; })
            ->make(true);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Build Form
    |--------------------------------------------------------------------------
    */
    public function form($id='')
    {
        $data = $id ? Membership::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 
        
        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');

        return view('membership::form', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Membership(), $id), 
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

        $status = $this->_saveData( new Membership(), [   
            //VALIDATOR
            "nama" => "required|unique:mod_membership". ($input['id'] ? ",nama,".$input['id'] : '')
        ], $input, 'nama');

        if ( $status && $image )
        {
            $image = $this->_uploadImage($image, 'membership', ['600x800', '200x300'], $input['url']);
            
            if ( isset($image['600x800']) )
            {
                Membership::where('id', $status)->update(['image'=>$image['600x800']]);
            }
        }

        $this->clearCache( config('membership.info.alias').'/'.$input['url'].'.html' );

        return Redirect( BeUrl( config('membership.info.alias') .(!$status ? ($input['id']?'/edit/'.$input['id']:'/add') : '') ) );
    }
}