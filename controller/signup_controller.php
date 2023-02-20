<?php
header('content-type application/json');
include_once('../model/db_model.php');


class SignupController 
{
  //TO register the data in db
  
  public static function signup(){
      
   
      $json=[];
    
      $user_name=$_POST['username'];
      $fname =trim($_POST['fname']) ;
      $lname =trim($_POST['lname']);
      $email =trim($_POST['email']);
      $pass_word =$_POST['password'];
      $confirm_password = $_POST['confirm_password'];
      $gender=$_POST['gridRadios'];
      $phone=trim($_POST['contact']);

      $errors = "";   
    
      //username
      if (empty($user_name)) {
        // throw new Exception('gender is required<br>');
        $errors.='username is required<br>';
      }
      //gender
      if (empty($gender)) {
        // throw new Exception('gender is required<br>');
        $errors.='gender is required<br>';
      }
     
      //validate contact
      if(!preg_match('/^[0-9]{10}$/', $phone)){
        // throw new Exception("enter valid phone no.<br>");
        $errors.="enter valid phone no.<br>";
    
      }
     
      
      // Validate name
      if (empty($fname)) {
        // throw new Exception('Name is required<br>');
        $errors.='Name is required<br>';
      }
      elseif (strlen($fname) < 2) {
        // throw new Exception('Name must be at least 2 characters long<br>');
        $errors.='Name must be at least 2 characters long<br>';
       }
         
      //last name
      if (empty($lname)) {
        // throw new Exception('lastName is required<br>');
        $errors.='lastName is required<br>';
      }
      elseif (strlen($lname) < 2){
        // throw new Exception('last name must be at least 2 characters long<br>');
        $errors.= 'last name must be at least 2 characters long<br>';
      }
        
    
      // Validate email
      if (empty($email)) {
        // throw new Exception('Email is required<br>');
        $errors.='Email is required<br>';
      } 
      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // throw new Exception('Email is not valid<br>');
        $errors.='Email is not valid<br>';
      }
    
      // Validate password
      if (empty($pass_word)) {
        // throw new Exception('Password is required<br>');
        $errors.='Password is required<br>';
      } 
      elseif (strlen($pass_word) < 4) {
        // throw new Exception('Password must be at least 8 characters long<br>');
        $errors.='Password must be at least 8 characters long<br>';
      }
      // Validate confirm password
      elseif (empty($confirm_password)) {
        // throw new Exception('Confirm Password is required<br>');
        $errors.='Confirm Password is required<br>';
      } 
      elseif($pass_word != $confirm_password) {
        // throw new Exception('Passwords do not match<br>');
        $errors.='Passwords do not match<br>';
      }
    
    
      $json = ['success' => TRUE, "message" => 'Validation done'];
      if(!empty($errors)){ 
      // catch(Exception $ex){
      $json = ['success' => FALSE, "message" => $errors];
      
      }
    
      if ($json['message'] === 'Validation done'){
      
        $fields=array('user_name'=>$user_name,
                      'fname'=>$fname,
                      'lname'=>$lname,
                      'email'=>$email,
                      'pass_word'=>$pass_word,
                      'gender'=>$gender,
                      'phone'=>$phone);

        // insert to database
        $dbmodel = new Database_Model();
        $json=$dbmodel->insert($fields);        
      }
      
      echo json_encode($json);  
    }
    
}

SignupController::signup();
?>




