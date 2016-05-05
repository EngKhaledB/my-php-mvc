<?php

namespace Controllers;

use Base\Response;
use Base\RestController;


class Contacts extends RestController
{
    function test()
    {
        Response::html('contacts/test', array('name' => 'Khaled'));
    }

    function test2()
    {
        $data = array(
            'name' => 'Khaled',
            'age' => 28,
            'country' => 'Palestine'
        );
        Response::json($data);
    }
}