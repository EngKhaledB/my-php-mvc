<?php

namespace Base;

class RestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $methods = array('POST', 'PUT', 'GET', 'DELETE');
        $request_method = $_SERVER['REQUEST_METHOD'];

        if (in_array($request_method, $methods)) {
            $request_method = strtolower($request_method);
            $this->$request_method();
        } else {
            Response::json(array(), 500);
        }
    }
}