<?php
namespace Controllers;


use Base\Controller;
use Base\Response;

class Home extends Controller
{
    public function index()
    {
        Response::html('home/index', array('title' => 'Home Page | Contacts'));
    }
} 