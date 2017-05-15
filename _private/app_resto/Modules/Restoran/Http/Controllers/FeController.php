<?php

namespace Modules\Restoran\Http\Controllers;

use Redirect,
    Illuminate\Http\Request,
    Illuminate\Http\Response,
    Illuminate\Routing\Controller,
    Modules\Restoran\Models\Restoran,
    App\Http\Controllers\FE\BaseController;

class FeController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($url)
    {
        if ( $this->dataView['row'] = Restoran::where('url', $url)->first() )
        {
            $this->dataView['title'] = $this->dataView['row']->nama;

            return view($this->tmpl . 'resto.main', $this->dataView);
        }
        else return $this->page(404);
    }
}
