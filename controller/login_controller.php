<?php
header('content-type application/json');
include_once('../model/db_model.php');

class LoginController
{
    public static function login(){
        $json=[];
        $errors="";
        $user_name=$_POST['username'];
        $password=$_POST['password'];
        if (empty($user_name)) {
            // throw new Exception('gender is required<br>');
            $errors.='username is required<br>';
        }
        if (empty($password)) {
            // throw new Exception('Password is required<br>');
            $errors.='Password is required<br>';
        }   
        if(!empty($errors)){
            $json = ['success' => FALSE, "message" => $errors];
        }
        else{
            $fields=array('user_name'=>$user_name,
                          'password'=>$password);

            $dbmodel = new Database_Model();  

            $json=$dbmodel->ValidateLogin($fields);            

            }   
            if($json['success']==TRUE){
                header('Location:../view/admin_dash.php');
                
            }
            else{

                echo json_encode($json);  
            }

        
        
    }          
}
LoginController::login();
?>