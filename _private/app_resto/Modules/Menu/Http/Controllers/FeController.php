<?php

namespace Modules\Menu\Http\Controllers;

use Redirect,
    Illuminate\Http\Request,
    Illuminate\Http\Response,
    Illuminate\Routing\Controller,
    App\Http\Controllers\FE\BaseController;

class FeController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function detail($resto,$url)
    {
        $this->dataView['title'] = $resto.'-'.$url;
        return view($this->tmpl . 'about', $this->dataView);
    }

}
