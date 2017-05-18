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
    /*
    |--------------------------------------------------------------------------
    | LIST
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $this->dataView['rows'] = Restoran::where('status', '1')->paginate(10);

        return view($this->tmpl . 'resto.index', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */
    public function detail($url)
    {
        if ( $this->dataView['row'] = Restoran::where('url', $url)->first() )
        {
            $this->dataView['title'] = $this->dataView['row']->nama;

            return view($this->tmpl . 'resto.main', $this->dataView);
        }
        else return $this->page(404);
    }

    /*
    |--------------------------------------------------------------------------
    | About
    |--------------------------------------------------------------------------
    */
    public function about($url)
    {
        if ( $this->dataView['row'] = Restoran::where('url', $url)->first() )
        {
            $this->dataView['title'] = $this->dataView['row']->nama;

            return view($this->tmpl . 'resto.about', $this->dataView);
        }
        else return $this->page(404);
    }
}
