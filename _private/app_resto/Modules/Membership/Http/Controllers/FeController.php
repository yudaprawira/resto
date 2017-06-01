<?php

namespace Modules\Membership\Http\Controllers;

use Redirect, Input, Session,
    Illuminate\Http\Request,
    Illuminate\Http\Response,
    Illuminate\Routing\Controller,
    Modules\Membership\Models\Membership,
    App\Http\Controllers\FE\BaseController;

class FeController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return 'Front End Here';
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Membership
    |--------------------------------------------------------------------------
    */
    public function save()
    {
        $input  = Input::except('_token');

        if ( val($input, 'id') )
        {
            $data = [
                'nama' => ucwords(trim(val($input, 'nama'))),
                'email' => strtolower(trim(val($input, 'email'))),
                'foto' => trim(val($input, 'foto')),
            ];

            if ( val($input, 'type')=='google' ) $sosMedId = 'google_id';
            if ( val($input, 'type')=='twitter' ) $sosMedId = 'twitter_id';
            if ( val($input, 'type')=='facebook' ) $sosMedId = 'facebook_id';

            $data[$sosMedId] = val($input, 'id');

            if ( Session::has('ses_feuserid') )
            {
                $rowUser = Membership::where('id', Session::get('ses_feuserid'));
            }
            else
            {
                $rowUser = Membership::where($sosMedId, $data[$sosMedId])->orWhere('email', $data['email']);
            }

            //add update
            if ( $user = $rowUser->first())
            {
                Membership::where('id', $user->id)->update($data);
            }
            else
            {
                $userID = Membership::insertGetId($data);

                $user = Membership::where('id', $userID)->first();
            }
        }

        if ( $user )
        {
            $this->dataView['row'] = $user;

            $this->_setSessionLogin($user);

            $dataUser = [
                val($user, 'id') => [
                    'nama' => val($user, 'nama'),
                    'foto' => val($user, 'foto'),
                    'online' => true,
                    'last_online' => dateSQL(),
                ]
            ];

            return Response()->json([ 
                'data_user'=> $dataUser,
                'response' => htmlentities(view($this->tmpl . 'box.account', $this->dataView))
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Periksa Membership
    |--------------------------------------------------------------------------
    */
    public function ping()
    {
        if ( session::has('ses_feuserid') )
        {
            $this->dataView['row'] = Membership::where('id',  session::get('ses_feuserid'))->first();

            $dataUser = [
                'title' => val($this->dataView['row'], 'nama'),
                'text' => trans('member::global.welcome'),
                'imageUrl' => val($this->dataView['row'], 'foto'),
            ];

            return Response()->json([ 
                'data_user'=> $dataUser,
                'response' => htmlentities(view($this->tmpl . 'box.account', $this->dataView))
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Logout Membership
    |--------------------------------------------------------------------------
    */
    public function logout()
    {
        Session::flush();
    }
}
