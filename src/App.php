<?php


use Authentication\Authentication;

class App
{
    public $authentication;

    /**
     * App constructor.
     */
    public function __construct()
    {
        session_start();
        $this->authentication = new Authentication();
    }
}