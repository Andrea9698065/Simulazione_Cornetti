<?php

function dd($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
    die();
}
function abort($code = 404)
{
    http_response_code($code);
    die();
}

function RouteControl($route, $page)
{
    if(array_key_exists($page, $route)) {
        require $route[$page];
    }else
        abort();
}
function GetUrl($path = '')
{
    return BASE_PATH . '/index.php?page=' . $path;
}