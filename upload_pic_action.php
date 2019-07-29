<?php
  include "connect.php";
  include "validate_admin.php";
  include "admin_session_timeout.php";
?>

<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // echo "<pre>", print_r($_FILES['img']['name']), "</pre>";

        $fileName = time() . '_' . $_FILES['img']['name'];
       
      $cust_username = (mysqli_real_escape_string($conn, $_POST['cust_username']));
        if (empty($cust_username) OR empty($fileName)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
            exit;
        }

        $sql1 = "SELECT * FROM customer WHERE uname='$cust_username' LIMIT 1";

        $result1 = mysqli_query($conn, $sql1);
        if($result1){
            $count = mysqli_num_rows($result1);
            if($count < 1){
                echo "Sorry the user does not exist in the database";
                echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
            }else{
                $sql2 = "SELECT * FROM images WHERE customer_id='$cust_username'";
                $result2 = mysqli_query($conn, $sql2);
                if($result2){
                    $count = mysqli_num_rows($result2);
                    if($count >= 1){
                        echo "Sorry the user already has a passport";
                        echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
                    }else{
                        if($row = mysqli_fetch_assoc($result1)){
                            $path = '/banking/passport/' . $fileName;
                            $destination = $_SERVER['DOCUMENT_ROOT'] . $path;
            
                            if (!move_uploaded_file($_FILES['img']['tmp_name'], $destination)){
                                throw new Exception('Error in moving the uploaded file');
                            }else{
                                $sql1 = "INSERT INTO images (customer_id, image_name) VALUES ('$cust_username', '$fileName')";
                                if(mysqli_query($conn, $sql1)){
                                    echo "Succussful: Saved picture to database";
                                    echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
                                }else{
                                    echo "Database Error: Failed to save picture";
                                    echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
                                }
                            }
                            
                                die();
                           }else {
                                echo " Sorry the user does not exist in the database";
                                echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
                           }
                    }
                }
               
            }
        }

       
   } else {
    // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
        echo "<br /> <a href='uploadpic.php'><h1>Go Back</h1></a>";
    }

?>