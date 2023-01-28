<?php
session_start();
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
        if ( $this->str_starts_with($link,  "https://docs.google.com/spreadsheets/") && $this->str_ends_with($link,  "/pubhtml")) {
            $data = file_get_contents($this->data_file);
            $json_arr = json_decode($data, true);
            $json_arr[0]['spreadsheets_link'] = $link;
            $json = json_encode($json_arr, JSON_PRETTY_PRINT);
            file_put_contents($this->data_file, $json);
            $_SESSION['success'] = "Excel link updated successfully";
        } else {
            $_SESSION['error'] = "Invalid link.";
        }
    }


    function str_starts_with(string $string, string $substring): bool {
        $len = strlen($substring);
        if ($len == 0) {
            return true;
        }
        return substr($string, 0, $len) === $substring;
    }

    function str_ends_with(string $string, string $substring): bool {
        $len = strlen($substring);    
        if ($len == 0) {
            return true;
        }
        return substr($string, -$len) === $substring;
    }


}
