<?php

use Illuminate\Support\Facades\Request;

function active($path, $active = 'active')
{
    return Request::is($path) ? $active : ' ';
}
