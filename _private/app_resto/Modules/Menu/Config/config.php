<?php

return [
    'info' => readModulInfo(__DIR__.'/../module.json'),
    'halal' => [
        'ya' => trans('menu::global.halal'),
        'tidak' => trans('menu::global.tidak_halal'),
        'baca' => trans('menu::global.baca_desk'),
    ]
];
