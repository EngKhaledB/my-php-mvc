<?php

namespace Controllers;

use Base\Request;
use Base\Response;
use Base\RestController;


class Contacts extends RestController
{
    function __construct()
    {
        $this->model = new \Models\Contacts();
        parent::__construct();
    }

    function get()
    {
        $mobile_no = $this->router->getSegment(2);
        $result = $this->model->get($mobile_no);

        if (!empty($result)) {
            Response::json($result);
        } else {
            Response::json(array(), 404);
        }

    }

    function post()
    {
        $mobile_no = Request::post('mobile_no');
        $name = Request::post('name');
        $address = Request::post('address');

        $result = $this->model->create($name, $mobile_no, $address);
        if (!empty($result)) {
            Response::json($result, 201);
        } else {
            Response::json(array(), 409); // Contact Exists before
        }

    }

    function put()
    {
        $mobile_no = Request::put('mobile_no');
        $name = Request::put('name');
        $address = Request::put('address');

        $result = $this->model->update($name, $mobile_no, $address);
        if (!empty($result)) {
            Response::json($result, 200);
        } else {
            Response::json(array(), 404); // Contact Exists before
        }
    }

    function delete()
    {
        $mobile_no = $this->router->getSegment(2);

        $result = $this->model->delete($mobile_no);
        if ($result) {
            Response::json(array(), 200);
        } else {
            Response::json(array(), 404);
        }
    }
}