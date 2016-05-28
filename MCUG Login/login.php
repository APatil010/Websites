<?php    
    header("Content-type: text/javascript");
    session_start();
    include('database_configuration.php');
    
//check for fields if not filled
    if (isset($_POST['login_rollnumber'],$_POST['login_password'])){
        $rollnumber = mysql_real_escape_string($_POST['login_rollnumber']);
        $password = mysql_real_escape_string($_POST['login_password']);
        
        
        //search for database for the rollnumber
        $selectQuery = "SELECT user_rollnumber,user_password FROM user_login;";
        $result = $db->query($selectQuery);
        $match=0;
        
        //if found login ,else nothing
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['user_rollnumber'] === $rollnumber && $row['user_password'] === $password) {
                    echo "Login Successful";
                    $match=1;
                    break;
                }
            }
        }
       //if match was not set ,then incorrect details was present 
        if ($match === 0) {
            echo "Incorrect Password or rollnumber.";
        }
    }
?>