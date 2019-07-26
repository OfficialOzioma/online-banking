<?php
  include "connect.php";
  include "validate_admin.php";
  include "admin_session_timeout.php";
?>

<?php 

    if (isset($_POST['submitBtn'])){
        echo "<pre>", print_r($_FILES['img']['name']), "</pre>";

        echo $fileName = time() . '_' . $_FILES['img']['name'];

        $cust_username = mysqli_real_escape_string($conn, $_POST['cust_username']);

        $sql1 = "SELECT * FROM customer WHERE uname='$cust_username' LIMIT 1";

        $result1 = mysqli_query($conn, $sql1);
        if($result1){
            $count = mysqli_num_rows($result1);
            if($count < 1){
                echo "<br /> Sorry the user does not exist in the database";
            }else{
               if($row = mysqli_fetch_assoc($result1)){
                
               }else {
                    echo "<br /> Sorry the user does not exist in the database";
               }
            }
        }

       $path = '/banking/passport/' . $fileName;
       $destination = $_SERVER['DOCUMENT_ROOT'] . $path;

       if (!move_uploaded_file($_FILES['img']['tmp_name'], $destination)){
        throw new Exception('Error in moving the uploaded file');
       }
     
        die();
    }

?>