<?php

namespace Helpers;


class CSV
{
    public static function CSVToArray($file_path = '')
    {
        if (!file_exists($file_path)) {
            return array();
        } else {
            return array_map('str_getcsv', file($file_path));
        }
    }

    public static function ArrayToCSV($rows, $file_path)
    {
        if (!empty($rows)) {
            $fp = fopen($file_path . '.new', "w");
            foreach ($rows as $row) {
                fputcsv($fp, $row, ',');
            }
            fclose($fp);
            rename($file_path . '.new', $file_path);
        }else{
            file_put_contents($file_path,'');
        }
    }
}