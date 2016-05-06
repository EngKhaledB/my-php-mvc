<?php

namespace Models;

use Base\Model;
use Helpers\Config;
use Helpers\CSV;

class Contacts extends Model
{
    private $contacts;
    private $file_path;

    function __construct()
    {
        $this->file_path = Config::get('csv_folder') . '/example.csv';
        $this->contacts = CSV::CSVToArray($this->file_path);
    }

    function get($mobile_no = '')
    {
        if ($mobile_no !== '') {
            $mobile_no = intval($mobile_no);
            $contact = array_pop($this->findByMobileNo($mobile_no));
            if (!empty($contact)) {
                return $contact;
            } else {
                return array();
            }
        } else {
            return $this->contacts;
        }
    }

    function create($name, $mobile_no, $address)
    {
        $contact = $this->findByMobileNo($mobile_no);
        if (empty($contact)) {
            $newContact = array($name, $mobile_no, $address);
            array_push($this->contacts, $newContact);
            $this->updateCSVFile();
            return $newContact;
        } else {
            return array();
        }
    }

    function update($name, $mobile_no, $address)
    {
        $contact = $this->findByMobileNo($mobile_no);
        if (!empty($contact)) {
            $newContact = array($name, $mobile_no, $address);
            $this->contacts[key($contact)] = $newContact;
            $this->updateCSVFile();
            return $newContact;
        } else {
            return array();
        }
    }

    function delete($mobile_no)
    {
        $contact = $this->findByMobileNo($mobile_no);
        if (!empty($contact)) {
            unset($this->contacts[key($contact)]);
            $this->updateCSVFile();
            return true;
        } else {
            return false;
        }
    }

    private function findByMobileNo($mobile_no)
    {
        $contact = array_filter($this->contacts, function ($item) use ($mobile_no) {
            return $item[1] == $mobile_no;
        });

        return $contact;
    }

    private function updateCSVFile()
    {
        CSV::ArrayToCSV($this->contacts, $this->file_path);
    }
}