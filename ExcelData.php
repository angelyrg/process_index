<?php

class ExcelData
{
    public $data_file = "dataFolder/excel.json";

    function get_link()
    {
        $json = (array) json_decode(file_get_contents($this->data_file));
        $data = '';
        foreach ($json as $k => $row) {
            $data = $row;
        }
        return $data;
    }

}



?>