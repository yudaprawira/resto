<?php

function imageSelector()
{
    $fullPath = Route::current()->uri();
    $backPath = config('app.backend').'/';
    $curnPath = $fullPath;

    if ( substr($fullPath, 0, strlen($backPath)) == $backPath  )
        $curnPath = explode('/', $fullPath)[1];

    return view('global.selector', ['path'=>$curnPath]);
}

?>