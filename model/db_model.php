<?php
class Database_Model {
  protected $conn;
  protected $error="";
  
  private function MakeDbConnection() {
    require_once('../config/db.php');
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn){
      $this->$error.=mysqli_connect_error();
    }
    else{
      $this->conn = $conn;
    }
    
  }

  // method to execute a query and return the result set
  public function insert($fields) {
    $this->MakeDbConnection();
    if(empty($this->error))
    {
          //prepared statement
          $stmt = $this->conn->prepare("INSERT INTO users (user_name,email,first_name,last_name,phone,gender,pass_word) VALUES (?,?,?,?,?,?,?)");
          
          
          //bind params  
          $stmt->bind_param("sssssss",$fields['user_name'],$fields['email'], $fields['fname'],$fields['lname'],$fields['phone'],$fields['gender'],$fields['pass_word']);
          
          if($stmt->execute()){
            $json = ['success' => TRUE, "message" => "REGISTERED SUCCESSFULLY"];
          }
          else{
            $json = ['success' => FALSE ,"message" => "CREDETIALS ALREADY EXIST"];
          } 
    }
    else{
          $json = ['success' => FALSE ,"message" => "<h1>DATA BASE ERROR,Connect backend team<h1>"];
    }
    $this->conn->close();
    return $json;
  }

  // Get User Details in form of html table
  public function GetUserDetails(){
    $this->MakeDbConnection();

    if(empty($this->error)){
      $output="";
      $sql="Select * from users";
      $result=mysqli_query($this->conn,$sql);

      if(mysqli_num_rows($result)>0){
        $output='<table>
                    <tr> 
                      <th>name</th>
                      <th>email</th>
                    </tr>';
        while($row=mysqli_fetch_assoc($result)){
        $output.=
            "<tr> 
              <td>{$row["first_name"]}</td>
              <td>{$row["email"]}</td>
            </tr>
            ";
        }
        $output.="</table>";
        mysqli_close($this->conn);
      }
      else{
        $output="<h2>no result found <h2>";
      }
      $json = ['success' => TRUE ,"message" =>$output];
    }
    else{
      $json = ['success' => FALSE ,"message" => "<h1>DATA BASE ERROR,Connect backend team<h1>"];
    }
    return $json;
  }
     
  public function ValidateLogin($fields){

    $this->MakeDbConnection();
    if(empty($this->error)){
      
      $sql =$this->conn->prepare("SELECT * FROM users WHERE user_name = ? OR email = ? AND pass_word=?");

      // Bind the parameters
      $sql->bind_param("sss", $fields['user_name'],$fields['user_name'],$fields['password']);
      
      // Execute the statement
      $sql->execute();
      
      $result=$sql->get_result();
      // $stmt->execute();
      // $result=mysqli_query($this->conn,$sql);
      
      $n=mysqli_num_rows($result);
      if(mysqli_num_rows($result)>0){
        $row = $result->fetch_assoc();
        if($row['isadmin']==1){
          //go to admin page
          $json = ['success' => TRUE ,"message" => "<h1>Login sucess=>welcome admin ".$row['first_name']."</h1>"];  
        }
        else{
          // go to user page
          $json = ['success' => TRUE ,"message" => "<h1>Login sucess=>welcome user ".$row['first_name']."</h1>"];  
        }

      }
      else{
        $json = ['success' => FALSE ,"message" => "<h1>Invalid login credentials RETRY! <h1>"];  
      }
    }
    else{
      $json = ['success' => FALSE ,"message" => "<h1>DATA BASE ERROR,Connect backend team<h1>"];
    }  
    $this->conn->close();

    return $json;

  }






}
  

          







//    
//     echo $output;
// }
// 
// }