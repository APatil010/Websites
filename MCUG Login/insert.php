<?php
    header('Location: index.html');
    header("Content-type: text/javascript");
    session_start();
    include('database_configuration.php');


//check for all fields of form are set

if(isset($_POST['fullname'],$_POST['rollnumber'],$_POST['address'],$_POST['birthdate'],$_POST['email'],$_POST['phonenumber'],$_POST['password'],$_POST['gender'],$_POST['department'],$_POST['yearofadmission'],$_POST['class'],$_POST['division'],$_POST['confirmpassword'])) {
    
    //convert strings to mysql Strings
    
    $fullname = mysql_real_escape_string($_POST['fullname']);
    $rollnumber = mysql_real_escape_string($_POST['rollnumber']);
    $address = mysql_real_escape_string($_POST['address']);
    $birthdate = mysql_real_escape_string($_POST['birthdate']);
    $email = mysql_real_escape_string($_POST['email']);
    $phonenumber = mysql_real_escape_string($_POST['phonenumber']);
    $password = mysql_real_escape_string($_POST['password']);
    $gender = mysql_real_escape_string($_POST['gender']);
    $department = mysql_real_escape_string($_POST['department']);
    $yearofadmission = mysql_real_escape_string($_POST['yearofadmission']);
    $class = mysql_real_escape_string($_POST['class']);
    $division = mysql_real_escape_string($_POST['division']);
    
    //search for rollnumber if in the database
    
    $findRoll = "SELECT user_rollnumber FROM user_login;";
    $result = $db->query($findRoll);
    $flag=0;
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['user_rollnumber'] === $rollnumber) {
                echo "Roll Number Already Exists...";
                $flag=1;
                break;
            }
        }
    }
    
    //if flag is true then insert the record to database
    if ($flag === 0) {

              if ($_POST['password'] === $_POST['confirmpassword']) {
                    $insertQuery = "INSERT INTO user_login (user_fullname,user_rollnumber,user_address,user_birthdate,user_email,user_phonenumber,user_password,user_gender,user_department,user_yearofadmission,user_class,user_division) VALUES ('$fullname','$rollnumber','$address','$birthdate','$email','$phonenumber','$password','$gender','$department','$yearofadmission','$class','$division');";

                  //validation check for correct insertion of record in database
               if($db->query($insertQuery) === TRUE) {
                        $json = array(
                        'status' =>'true',
                        'core' =>'Data Is Recorded.'
                        );
                        echo json_encode($json);
                    }
                    else {
                        $json = array(
                        'status' =>'false',
                        'core' =>'Data Is Not Recorded.'
                        );
                        echo json_encode($json);
                    }
              }
    }
}

?>