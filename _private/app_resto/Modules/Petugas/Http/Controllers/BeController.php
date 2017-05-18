<?php
namespace Modules\Petugas\Http\Controllers;

use Illuminate\Routing\Controller,
    App\Http\Controllers\BE\BaseController,
    Modules\Petugas\Models\Petugas,
    App\Models\System\Level,
    Yajra\Datatables\Datatables;

use Input, Session, Request, Redirect;

class BeController extends BaseController
{
    function __construct() {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | Management Petugas
    |--------------------------------------------------------------------------
    */
    public function index($isTrash=false)
    {
        if ( Request::isMethod('get') )
        {
            $this->dataView['form'] = $this->form();

            $rows = Petugas::query();

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('owner_id', Session::get('ses_switch_active'));
            }
            
            $this->dataView['countAll'] = $rows->where('status', '<>', '-1')->count();
            $this->dataView['countTrash'] = $rows->where('status', '-1')->count();

            $this->dataView['isTrash'] = $isTrash;
            
            return view('petugas::index', $this->dataView);
        }
        else
        {
            $rows = $isTrash ? Petugas::with('level')->where('status', '-1') : Petugas::with('level')->where('status', '<>', '-1');

            if ( !Session::get('ses_is_superadmin') )
            {
                $rows->where('owner_id', Session::get('ses_switch_active'));
            }

            return Datatables::of($rows)
            ->addColumn('action', function ($r) use ($isTrash) { return $this->_buildAction($r->id, $r->username, 'default', $isTrash); })
            ->editColumn('username', function ($r) { return $r->username; })
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
        $data = $id ? Petugas::find($id) : null;
        
        $this->dataView['dataForm'] = $data ? $data->toArray() : []; 

        $this->dataView['level'] = getRowArray(Level::where('name', 'LIKE', 'resto%')->get(), 'id', 'name'); 
        
        $this->dataView['dataForm']['form_title'] = $data ? trans('global.form_edit') : trans('global.form_add');

        return view('petugas::form', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    function delete($id)
    {
        return Response()->json([ 
            'status' => $this->_deleteData(new Petugas(), $id, (val($_GET, 'permanent')=='1' ? null : ['status'=>'-1'])), 
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
            'status' => $this->_deleteData(new Petugas(), $id, ['status'=>'1']), 
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
        $image  = isset($input['file']) ? $input['file'] : null;unset($input['file']);
        
        if ( val($input, '_post') )
        {
            parse_str($input['_post'], $params);
            $input  = $params;
        }

        unset($input['_image']);
        unset($input['_token']);
        
        $input['url'] = str_slug(trim($input['username']));
        $input['status'] = val($input, 'status') ? '1' : '0';
        //owner
        $input['owner_id'] = session::get('ses_switch_active');

        //password
        $exclude = ['password_confirmation'];
        $hash = ['password'];
        if ( !$input['password'] ) $exclude[] = 'password';
        
        $status = $this->_saveData( new Petugas(), [   
            //VALIDATOR
            "username" => "required|unique:user". ($input['id'] ? ",username,".$input['id'] : ''),
            "email" => "email|unique:user". ($input['id'] ? ",id,.".$input['id'] : ''),
        ], $input, 'username', $exclude, $hash);

        if ( $image )
        {
            $image = $this->_uploadImage($image, 'petugas', ['600x800', '200x300'], $input['url']);
            
            if ( isset($image['600x800']) )
            {
                Petugas::where('id', $status)->update(['image'=>$image['600x800']]);
            }
        }

        $this->clearCache( config('petugas.info.alias').'/'.$input['url'].'.html' );
                
        return Response()->json([ 
            'status' => $status, 
            'message'=> $this->_buildNotification(true),
            'form'   => $status ? base64_encode($this->form()) : null
        ]);
    }
}