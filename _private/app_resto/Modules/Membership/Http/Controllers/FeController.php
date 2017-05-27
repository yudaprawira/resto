<?php

namespace Modules\Membership\Http\Controllers;

use Redirect, Input,
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

        if ( val($input, 'data') )
        {
            $dataPost = json_decode(base64_decode(val($input, 'data')), true);

            switch( val($input, 'type') )
            {
                case 'google':
                case 'twitter':
                case 'facebook':

                    $data = [
                        'nama' => ucwords(trim(val($dataPost, 'displayName'))),
                        'email' => val($dataPost, 'email') ? val($dataPost, 'email') : val($dataPost, 'providerData.0.email'),
                        'foto' => val($dataPost, 'providerData.0.photoURL'),
                    ];

                    if ( val($input, 'type')=='google' ) $sosMedId = 'google_id';
                    if ( val($input, 'type')=='twitter' ) $sosMedId = 'twitter_id';
                    if ( val($input, 'type')=='facebook' ) $sosMedId = 'facebook_id';

                    $data[$sosMedId] = val($dataPost, 'providerData.0.uid');

                    //add update
                    if ( $user = Membership::where($sosMedId, $data[$sosMedId])->orWhere('email', $data['email'])->first())
                    {
                        Membership::where('id', $user->id)->update($data);
                    }
                    else
                    {
                        $userID = Membership::insertGetId($data);

                        $user = Membership::where('id', $userID)->first();
                    }
                break;
            }
        }

        if ( $user )
        {
            $this->dataView['row'] = $user;

            return view($this->tmpl . 'box.account', $this->dataView);
        }
    }
}
