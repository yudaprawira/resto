<?php

namespace Modules\Restoran\Http\Controllers;

use Redirect,
    Illuminate\Http\Request,
    Illuminate\Http\Response,
    Illuminate\Routing\Controller,
    Modules\Restoran\Models\Restoran,
    App\Http\Controllers\FE\BaseController;

class RestoController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | DATA RESTO
    |--------------------------------------------------------------------------
    */
    protected function dataResto($url, $with=array())
    {
        if ( $this->dataView['row'] = Restoran::where('url', $url)->where('status', 1)->with($with)->first() )
        {
            $this->dataView['title'] = val($this->dataView['row'], 'nama');

            $this->dataView['pemilik_id'] = 'resto-'.val($this->dataView['row'], 'id');
        }
        else return $this->page(404);
    }
}