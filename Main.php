<?php

use function PHPSTORM_META\type;

class Main
{
    public $data_file = "./dataFolder/data.json";

    /**
     * Get all data from JSON
     */
    function get_all_data()
    {
        $json = (array) json_decode(file_get_contents($this->data_file));
        $data = [];
        foreach ($json as $row) {
            $data[$row->id] = $row;
        }
        return $data;
    }

    /**
     * Get specific data from JSON
     */
    function get_data($id = '')
    {
        // Get current data and delete item
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $data_to_return = [];

        // get and save data for delete
        foreach ($json_arr as $i) {
            if ($i['id'] === $id){                
                $data_to_return = $i;
                break;
            }

            foreach ($i['items'] as $j) {
                if ( isset($j['id']) && $j['id'] === $id ){
                    $data_to_return = $j;
                    break 2;
                }                

                foreach ($j['items'] as $k ) {
                    if (isset($k['id']) && $k['id'] === $id){
                        $data_to_return = $k;
                        break 3;
                    }
                }
            }
        }
        return $data_to_return;
    }


    function make_expand($id = '')
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $insert = false;

        foreach ($json_arr as $key => $i) {
            foreach ($i['items'] as $key2 => $j) {
                foreach ($j['items'] as $key3 => $k) {
                    if (isset($k['id']) && $k['id'] === $id){
                        $json_arr[$key]['items'][$key2]['items'][$key3]['expanded']  = true;
                        $json = json_encode($json_arr, JSON_PRETTY_PRINT);
                        $insert = file_put_contents($this->data_file, $json);

                        break 3;
                    }
                }
            }
        }
        return $insert;
    }

    

    function restore_expanded()
    {

        $data = file_get_contents($this->data_file);

        $data = str_replace('"expanded" : true', '"expanded" : false', $data);
        $data = str_replace('"expanded": true', '"expanded": false', $data);
        $data = str_replace('"expanded" :true', '"expanded" :false', $data);
        $data = str_replace('"expanded":true', '"expanded":false', $data);
        
        $json_arr = json_decode($data, true);

        $json = json_encode($json_arr, JSON_PRETTY_PRINT);
        $insert = file_put_contents($this->data_file, $json);
    }
    
}
