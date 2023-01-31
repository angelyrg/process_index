<?php

class Master
{
    public $data_file = "./../dataFolder/data.json";

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
        if (!empty($id)) {
            $data = $this->get_all_data();
            if (isset($data[$id])) {
                return $data[$id];
            }
        }
        return (object) [];   
    }

    /**
     * Insert data in the JSON (ONLY LEVEL 1)
     */
    function insert_to_json($title, $bizagi_folder, $clickeable = false )
    {
        $data = $this->get_all_data();
        $id = array_key_last($data) + 1;
        $data[$id] = (object) [
            "id" => "$id",
            "text" => $title,
            "bizagi_folder" => null,
            "clickeable" => $clickeable,
            "items" => []
        ];
        $json = json_encode(array_values($data), JSON_PRETTY_PRINT);
        $insert = file_put_contents($this->data_file, $json);
        if ($insert) {
            $_SESSION['success'] = "New level added successfully.";
        } else {
            $_SESSION['error'] = "Could not add new level.";
        }

    }

    
    /**
     * Update JSON record
     */
    function update_json_data($id, $title, $file_text, $bizagi_folder, $attach_array)
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        switch (count($ids)){
            case 1:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $id ){
                        $json_arr[$key]['text'] = $title;

                        $json = json_encode($json_arr, JSON_PRETTY_PRINT);
                        $insert = file_put_contents($this->data_file, $json);

                    }
                }
                break;

            case 2:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $id){
                                $json_arr[$key]['items'][$k]['text'] = $title;

                                $json = json_encode($json_arr, JSON_PRETTY_PRINT);
                                $insert = file_put_contents($this->data_file, $json);
                            }
                        }
                    }
                }
                break;

            case 3:
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $items){
                            if ($items['id'] == $ids[0]."_".$ids[1]){
                                foreach($items['items'] as $k3 => $item3){
                                    if ($item3['id'] == $id){
                                        if (isset($title)){
                                            $json_arr[$key]['items'][$k]['items'][$k3]['text'] = $title;
                                        }
                                        if (isset($file_text)){
                                            $json_arr[$key]['items'][$k]['items'][$k3]['file_name'] = $file_text;
                                            $json_arr[$key]['items'][$k]['items'][$k3]['clickeable'] = true;
                                        }
                                        if(isset($bizagi_folder)){
                                            $json_arr[$key]['items'][$k]['items'][$k3]['bizagi_folder'] = $bizagi_folder;
                                        }
                                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                        $insert = file_put_contents($this->data_file, $json);
                                    }
                                }
                            }
                        }
                    }
                }
                break;
        }

        if ($insert) {
            $_SESSION['success'] = "Updated successfully.";
        } else {
            $_SESSION['error'] = "Could not update..";
        }

    }

    /**
     * Destroy record from JSON
     */
    function delete_data($id = '')
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $insert = false;


        foreach($json_arr as $key => $i){
            if( $i['id'] === $id ){
                array_splice($json_arr, $key, 1); 
                $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                $insert = file_put_contents($this->data_file, $json);
                break;
            }

            foreach($i['items'] as $key2 => $j){
                if ( isset($j['id']) &&  $j['id'] === $id ){
                    array_splice($json_arr[$key]['items'], $key2, 1);
                    $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                    $insert = file_put_contents($this->data_file, $json);
                    break 2;
                }

                foreach($j['items'] as $key3 => $k){
                    if ( isset($k['id']) &&  $k['id'] === $id){
                        array_splice($json_arr[$key]['items'][$key2]['items'], $key3, 1); 
                        $json = json_encode(($json_arr), JSON_PRETTY_PRINT);
                        $insert = file_put_contents($this->data_file, $json);
                        break 3;
                    }
                }
            }
        }

        return $insert;

    }

    /**
     * Destroy record from JSON
     */
    function delete_attached_file($id, $file_id)
    {
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        foreach($json_arr as $key => $value){
            if( $value['id'] == $ids[0] ){
                foreach($value['items'] as $k => $items){
                    if ($items['id'] == $ids[0]."_".$ids[1]){
                        foreach($items['items'] as $k3 => $item3){
                            if ($item3['id'] == $id){
                                foreach($item3['attachment_files'] as $k_at => $item_at){
                                    if ($item_at['id'] == $file_id){

                                        array_splice($json_arr[$key]['items'][$k]['items'][$k3]['attachment_files'], $k_at, 1); 
        
                                        $json = json_encode(($json_arr), JSON_PRETTY_PRINT);
                                        $insert = file_put_contents($this->data_file, $json);
                                    }
                                }

                            }
                        }
                    }
                }
            }
        }

        return $insert ? true : false;
    }


    /**
     * Insert level into another level the JSON (LEVEL 2-3)
     */
    function insert_child($id, $title, $bizagi_folder, $clickeable = false )
    {

        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        switch (count($ids)){
            
            case 1:                
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        // Set new id
                        if ( count($value['items']) > 0 ){
                            $last_id = explode('_', end( $value['items'] )['id']);
                            $child_id = $id."_".(end($last_id) + 1);
                        }else{
                            $child_id = $id."_1";
                        }                               
                        $new_data =  [
                            "id" => $child_id,
                            "text" => $title,
                            "bizagi_folder" => $bizagi_folder,
                            "clickeable" => $clickeable,
                            "items" => []
                        ];
                        array_push($json_arr[$key]['items'], $new_data);                                                            
                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                        $insert = file_put_contents($this->data_file, $json);                        
                    }
                }
                break;
            case 2:                
                foreach($json_arr as $key => $value){
                    if( $value['id'] == $ids[0] ){
                        foreach($value['items'] as $k => $value2){
                            if ($value2['id'] == $id){
                                // Set new id (INSERT NEW PROCESS)
                                if ( count($value2['items']) > 0 ){
                                    $last_id = explode('_', end( $value2['items'] )['id']);
                                    $child_id = $id."_".(end($last_id) + 1);
                                }else{
                                    $child_id = $id."_1";
                                }                               
                                $new_data =  [
                                    "id" => $child_id,
                                    "text" => $title,
                                    "bizagi_folder" => $bizagi_folder,
                                    "clickeable" => true,
                                    "items" => [],
                                    "attachment_files" => []
                                ];
                                array_push($json_arr[$key]['items'][$k]['items'], $new_data);                                                            
                                $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                $insert = file_put_contents($this->data_file, $json);
                        }
                    }
                }
            }
            break;
            
        }

        if ($insert) {
            $_SESSION['success'] = "New record saved successfully.";
        } else {
            $_SESSION['error'] = "Could not insert new data.";
        }

    }


    /**
     * Insert attached files
     */
    function insert_attachment_files($id, $array_list )
    {

        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $ids = explode("_", $id);

        foreach($json_arr as $key => $value){
            if( $value['id'] == $ids[0] ){
                
                foreach($value['items'] as $k => $value2){
                    if ($value2['id'] == ($ids[0]."_".$ids[1])){

                        foreach($value2['items'] as $k3 => $value3){
                            if ($value3['id'] == $id){

                                foreach($array_list as $file_name){  
                                    // Set new id (INSERT NEW ATTACH
                                    if ( count($value2['items']) > 0 ){
                                        $last_id = explode('_', end( $value3['attachment_files'] )['id']);
                                        $child_id = $id."_".(end($last_id) + 1);
                                    }else{
                                        $child_id = $id."_1";
                                    }  
                                    
                                    $new_data =  [
                                        "id" => "at_".$child_id,
                                        "attach_name" => $file_name,
                                        "attach_file_name" => $file_name
                                    ];
                                    array_push($json_arr[$key]['items'][$k]['items'][$k3]['attachment_files'], $new_data);                                                            
                                    $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                                    $insert = file_put_contents($this->data_file, $json);
                                }
                                
                            }
                            

                        }
                        


                    }
                }


            }
        }

        if ($insert) {
            $_SESSION['success'] = "Attachment file added successfully.";
        } else {
            $_SESSION['error'] = "Could not add.";
        }

    }


    /**
     * Update FOLDER LEVELS
     */
    function update_ids($id_from, $id_to)
    {
        // Get current data and delete item
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);
        $data_to_move = [];
        $insert = false;

        // get and save data for delete
        foreach ($json_arr as $i) {
            if ($i['id'] === $id_from){                
                $data_to_move = $i;
                break;
            }

            foreach ($i['items'] as $j) {
                if ( isset($j['id']) && $j['id'] === $id_from ){
                    $data_to_move = $j;
                    break 2;
                }                

                foreach ($j['items'] as $k ) {
                    if (isset($k['id']) && $k['id'] === $id_from){
                        $data_to_move = $k;
                        break 3;
                    }
                }
            }
        }

        $this->delete_data($id_from);

        //Get new data
        $data = file_get_contents($this->data_file);
        $json_arr = json_decode($data, true);        
        // put data to the new place
        foreach ($json_arr as $key => $i) {
            if ( $i['id'] === $id_to){
                array_push($json_arr[$key]['items'], $data_to_move);                                                            
                $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                $insert = file_put_contents($this->data_file, $json);                
                break;
            }

            foreach ($i['items'] as $key2 => $j) {
                if ( isset($j['id']) && $j['id'] === $id_to ){
                    array_push($json_arr[$key]['items'][$key2]['items'], $data_to_move);                                                            
                    $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                    $insert = file_put_contents($this->data_file, $json);                
                    break 2;
                }

                foreach ($j['items'] as $key3 => $k ) {
                    if ( isset($k['id']) && $k['id'] === $id_from ){
                        array_push($json_arr[$key]['items'][$key2]['items'][$key3]['items'], $data_to_move);
                        $json = json_encode(array_values($json_arr), JSON_PRETTY_PRINT);
                        $insert = file_put_contents($this->data_file, $json);
                        break 3;
                    }
                }
            }
        }

        return $insert;

    }
    
}
