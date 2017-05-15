<?php
namespace Modules\Pesanan\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Pesanan\Models\Pesanan,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Pesanan
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if ( Request::isMethod('get') )
        {
            return view('pesanan::index', $this->dataView);
        }
        else
        {
            return Datatables::of(Pesanan::query())
            ->addColumn('action', function ($r) { return $this->_buildAction($r->id, $r->invoice); })
            ->editColumn('invoice', function ($r) { return createLink( url(config('pesanan.info.alias').'/'.$r->url.'.html'), $r->invoice ); })
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
        $data = $id ? Pesanan::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 
        
        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');

        return view('pesanan::form', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Pesanan(), $id), 
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
        
        $input['url'] = str_slug(trim($input['invoice']));
        $input['status'] = val($input, 'status') ? 1 : 0;

        $status = $this->_saveData( new Pesanan(), [   
            //VALIDATOR
            "invoice" => "required|unique:mod_pesanan". ($input['id'] ? ",invoice,".$input['id'] : '')
        ], $input, 'invoice');

        $this->clearCache( config('pesanan.info.alias').'/'.$input['url'].'.html' );

        return Redirect( BeUrl( config('pesanan.info.alias') .(!$status ? ($input['id']?'/edit/'.$input['id']:'/add') : '') ) );
    }
}