<?php

class Excel
{
    public $data_file = "adminData/excel.json";

    /**
     * Get all data from JSON
     */
    function get_excel_link()
    {
        $json = (array) json_decode(file_get_contents($this->data_file));
        $data = [];
        foreach ($json as $row) {
            $data[$row->id] = $row;
        }
        return $data;
    }


    /**
     * Update EXCEL LINK
     */
    function update_excel_link($link)
    {
        if (strpos($link, 0, "https://docs.google.com/spreadsheets/") !== false ) {
            $data = file_get_contents($this->data_file);
            $json_arr = json_decode($data, true);
            $json_arr[0]['spreadsheets_link'] = $link;
            $json = json_encode($json_arr, JSON_PRETTY_PRINT);
            file_put_contents($this->data_file, $json);

        } else {
            echo "INVALID LINK";
        }
    }
}
