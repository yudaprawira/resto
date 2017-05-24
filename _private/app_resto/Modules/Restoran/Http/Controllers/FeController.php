<?php

namespace Modules\Restoran\Http\Controllers;

use Modules\Restoran\Models\Restoran,
    Modules\Restoran\Http\Controllers\RestoController;

class FeController extends RestoController
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
        $this->dataResto($url);

        return view($this->tmpl . 'resto.main', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | INFO
    |--------------------------------------------------------------------------
    */
    public function about($url)
    {
        $this->dataResto($url);

        return view($this->tmpl . 'resto.about', $this->dataView);
    }
}