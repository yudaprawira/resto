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
            $data = json_decode(val($input, 'data'), true);
echoPre($data);
            switch( val($input, 'type') )
            {
                case 'google':
                    $data = [
                        'nama' => ucwords(trim(val($data, 'displayName'))),
                        'google_id' => val($data, 'providerData.0.uid'),
                        'email' => val($data, 'providerData.0.email'),
                        'foto' => val($data, 'providerData.0.photoURL'),
                    ];
                    //add update
                    if ( $user = Membership::where('google_id', $data['google_id'])->first())
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
