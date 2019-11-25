<?php

include 'Router.php';

if( Router::is_cli() ){
    $arg = $_SERVER['argv'];
    unset($arg[0]);
    var_dump($arg);
} else{

    $router = Router::fromGlobals();

// Or add array of routes.
    $router->add([
        '/' => 'MainController@index',
        '/system'       => 'MainController@cacheSystem',
        '/main'  => 'MainController@mainCache',
    ]);

    // Start route processing
    if ($router->isFound()) {
        $router->executeHandler(
            $router->getRequestHandler(),
            $router->getParams()
        );
    }
    else {
        // Simple "Not found" handler
        $router->executeHandler(function () {
            http_response_code(404);
            echo '404 Not found';
        });
    }
}
