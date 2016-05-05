<?php

namespace Base;

class RestController
{

    /*
     * Check the Request Verb and call the suitable function to the verb
     */
    public function __call($strMethod, $arrParams)
    {
        var_dump($_SERVER);
    }
}