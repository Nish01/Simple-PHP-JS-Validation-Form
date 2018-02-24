<?php

//Alternative way for the project, is to split code up for better reuse and more MVC style. To create classes, FormEntry and FormEntryRepo to handle the different parts
//FormEntryRepo could have methods such as store, fetch and prepareAndBind to handle the sql queries etc.


define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_NAME', 'ilogik' );
define( 'DB_PORT', '3306' );
/* Attempt MySQL server connection. Assuming, running MySQL
server with default setting (user 'root' with no password) */
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check connection
    if(!$conn){
     die("ERROR: Could not connect. " . mysqli_connect_error());
    }

session_start();
if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
         // Proceed to process the form data

        // Escape user inputs for security
$name = test_input(mysqli_real_escape_string($conn, $_REQUEST['name']));
$email = test_input(mysqli_real_escape_string($conn, $_REQUEST['email']));
$number = test_input(mysqli_real_escape_string($conn, $_REQUEST['number']));

// Get the remaining 'fields' in an array 

$values = ($_POST);
$last_id = 0;

// Validation of Input and Assigning Errors
$nameErr = "";
$emailErr = "";
$numberErr = "";
$fieldErr = "";
$sqlErr = "";

//$provinceErr = "";
//$provs = array("Eastern Cape", "Free State", "Gauteng", "KwaZulu-Natal", "Limpopo", "Mpumalanga", "Northern Cape", 
//    "North West", "Western Cape");

//Check that the extra data is not empty. I.e. Province and city is filled in
$count = 0;
    foreach($values as $key => $value) {
        $count++;
        if ($count > 4){
            if (empty($value)) {
            $fieldErr = "Please fill in your extra data.";
            } 
        }
    }

   if (empty($name)) {
        $nameErr = "Please enter your name.";
    } 

    if (empty($email)) {
       $emailErr = "Please enter your email address.";  
    } 
    else{
        $email = test_email($email);
        if($email == FALSE){
            $emailErr = "Please enter a valid email address.";
        }
    }

    if (empty($number)) {
        $numberErr = "Please enter your mobile number.";
    } 
    else{
        if(($number < 0) || (strlen($number) != 10) || $number[0] != 0){
              $numberErr = "Please enter a valid mobile number.";
        }
    }

    // if (empty($province)) { 
    //     $provinceErr = "Please select your province.";
    // } 
    // else{
    //     if($province != $provs[0] && $province != $provs[1] && $province != $provs[2] && $province != $provs[3]
    //         && $province != $provs[4] && $province != $provs[5] && $province != $provs[6] && $province != $provs[7]
    //         && $province != $provs[8]){
    //           $provinceErr = "Please select a valid province.";
    //     }
    // }
        
    // Validation of Input and Assigning Errors End(Above)


        // Check if there are any errors, If not add to the DB, Else Display Errors and Ask for Input again
    if (empty($nameErr) && empty($emailErr) && empty($numberErr) && empty($fieldErr))
    {
        $sql = $conn->prepare("INSERT INTO formentry (name, email, number) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $name, $email, $number);
        
             if ($sql->execute()) {
                //Get the last inserted ID
                $last_id = $conn->insert_id;
            } else {
                $sqlErr = "ERROR: It was not able to execute $sql. " . $conn->error;
                echo $sqlErr;
            }
        $sql->close();

      //Check if there is an error from the First insert query 
    if (empty($sqlErr)){

        $counter = 0;
        foreach($values as $key => $value) {
            $keyT = test_input(mysqli_real_escape_string($conn, $key));
            $valueT = test_input(mysqli_real_escape_string($conn, $value));
            $counter++;
            
            if ($counter > 4){
                $sqls = $conn->prepare("INSERT INTO formfield (formentryId, fieldName, fieldValue) VALUES (?, ?, ?)");
                $sqls->bind_param("iss", $last_id, $keyT, $valueT);
            if ($sqls->execute()) {
            }
                else {
                $sqlErr = "ERROR: It was not able to execute $sqls. " . $conn->error;
                echo $sqlErr;
                mysqli_rollback($conn);
                }
            }
        }
    $sqls->close(); 
    } 

        if(empty($sqlErr)){
            echo "Records added successfully. Thank you.<br>";
            echo "Click <a href='http://localhost/Users/'>HERE</a> to add another record";
        } 
        // close connection
        $conn->close();
   
    }
      else{

        echo $nameErr . "<br>" . $emailErr . "<br>" . $numberErr . "<br>" . $fieldErr . "<br>";
        echo "Click <a href='http://localhost/Users/'>HERE</a> to go back to make the appropriate changes and add another record.";
        }



    } else {
         // Log this as a warning and keep an eye on these attempts...
       echo "You cannot be trusted....";
    }
}




//Functions to Test and Trim input, Check Email input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_email($field){
    // Sanitize e-mail address
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    // Validate e-mail address FILTER_VALIDATE_EMAIL is used for this use case. More specific requirements could call for 
    // a more specific Regexp
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return FALSE;
    }
}


?>