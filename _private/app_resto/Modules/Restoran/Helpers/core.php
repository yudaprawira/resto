<?php

use Modules\Restoran\Models\Restoran;

/*
|--------------------------------------------------------------------------
| Get Resto | By Active User
|--------------------------------------------------------------------------
*/
function getRestoUser()
{
    $rows = Restoran::where('status', '1');
    
    $rows->selectRaw("*, CONCAT('resto-', id) as idr, CONCAT('RESTO - ', nama) as nama");

    if ( !Session::get('ses_is_superadmin') )
    {
        $rows->where(function($q){
            $q->where('created_by', Session::get('ses_userid'))
              ->orWhere('id', str_replace('resto-', '', Session::get('ses_default_company')));
        });
    }
    
    return getRowArray($rows->get(), 'idr', '*');
}


/*
|--------------------------------------------------------------------------
| URL DETAIL MENU
|--------------------------------------------------------------------------
*/
function urlMenu($rowResto, $rowMenu, $type=null)
{
    $url = 'kuliner/'.val($rowResto, 'url').'/menu/'.val($rowMenu, 'url').'.html';

    return $type=='share' ? url($url) : $url;
}


?>