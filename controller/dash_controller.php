<?php
include_once('../model/db_model.php');


header('content-type application/json');

class dash_controller
{
    public static function ShowUser(){
        $json=[];
        $dbmodel = new Database_Model();
        $json=$dbmodel->GetUserDetails();
        
        // if($json)
        
        echo json_encode($json); 


    }
}
dash_controller::ShowUser();


?>