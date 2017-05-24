<?php

namespace Modules\Menu\Http\Controllers;

use Modules\Menu\Models\Menu,
    Modules\Restoran\Http\Controllers\RestoController;

class FeController extends RestoController
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR MENU
    |--------------------------------------------------------------------------
    */
    public function index($url)
    {
        $this->dataResto($url);

        $this->dataView['rowMenu'] = Menu::where('pemilik_id', $this->dataView['pemilik_id'])
                                         ->where('status', '1')->with('rel_kategori')->paginate(10);
        return view($this->tmpl . 'resto.menu', $this->dataView);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL MENU
    |--------------------------------------------------------------------------
    */
    public function detail($resto, $url)
    {
        $this->dataResto($resto);

        if($this->dataView['rowMenu'] = Menu::where('pemilik_id', $this->dataView['pemilik_id'])
                                         ->where('url', $url)
                                         ->where('status', '1')->with('rel_kategori')->first())
                                         {
                                            $this->dataView['title'] .= ' | '.val($this->dataView['rowMenu'], 'nama');
                                         }
                                         else return $this->page(404);

        return view($this->tmpl . 'resto.menu_detail', $this->dataView);
    }

}
