<?php
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$request = strtok($_SERVER['REQUEST_URI'], '?');

if (strpos($request, '/alittledaisy') === 0) {
    $request = substr($request, strlen('/alittledaisy'));
}

$request = ltrim($request, '/');
$segments = explode('/', $request);

$route = [
    '' => 'login',
    'home' => 'home',
    'management-item' => 'management-item',
    'management-bill' => 'management-bill',
    'management-order' => 'management-order',
    'api' =>'api',
];

if (array_key_exists($segments[0], $route)) {
    include($route[$segments[0]] . '.php');
} 
else {
    echo '404';
}
