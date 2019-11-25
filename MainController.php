<?php


class MainController
{
    public static function index(){

        if( isset($_REQUEST) && count($_REQUEST) > 0){
            $request = $_REQUEST;
            echo '<pre>';
            print_r($request);
            echo '</pre>';
        }else{
            echo 'Request params is empty';
        }
    }

    /**
     * First Action
     */
    public static function cacheSystem()
    {
        echo 'Hello from '.__METHOD__.'!';
        echo '<br>';
        echo '<br>';

    }

    /**
     * Second Action
     */
    public static function secondAction($var)
    {
        echo 'Hello from '.__METHOD__.'( "'.$var.'" )!';
    }
}