<?php
namespace Base;


class Response
{
    public static function html($view, $data = array(), $output = true)
    {
        extract($data);
        ob_start();
        require_once(VIEWPATH . $view . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        if ($output)
            echo $html;
        else
            return $html;
    }

    public static function json($data, $output = true)
    {
        if ($output)
            echo json_encode($data);
        else
            return json_encode($data);
    }
}