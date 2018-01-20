<?php
/**
 * Created by PhpStorm.
 * User: Mateus
 * Date: 17/01/2018
 * Time: 11:58
 */

namespace App\Action;

class Action{

    private $container ;

    function __construct($container )
    {
        $this->container = $container;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        if ( $this->container->{$name}

        ){
            return$this->container->{$name};
        }
    }
}