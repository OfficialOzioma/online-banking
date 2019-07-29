<?php 
    include "connect.php"; 
    include "validate_admin.php";
    include "admin_session_timeout.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add messages</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/addmessage.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
    <?php 
        $sql = "SELECT * FROM messages";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $title = $row["title"];
            $message = $row["message"];
        }
    ?>
        <br />
        <div class="container">
            <div class="container">
                    <form method="post" name="msg_form" action="add_messages.php">

                        <div class="card border-success">
                          <div class="card-body">
                            <h2 class="card-title text-center">Information Form</h2>
                            <?php if(isset($msg)) {?>
                            <div class="alert alert-info">
                                <?php echo $msg; ?>
                            </div>
                            <?php }?>
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="title"><h3>Message header</h3></label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter the Heading of the message here" >
                                </div> 
                                <div class="form-group">
                                    <label for="title"><h3>Username</h3></label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter the username of the person" >
                                </div>  
                                <div class="form-group">
                                    <label for="message"><h4>Message</h4></label>
                                    <textarea class="form-control" name="message" id="message" rows="7"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success" name="msg_btn">Update Message</button>
                                <a href="admin_home.php" class="btn btn-success" style="float:right;">Go Back</a>
                            </p>
                          </div>
                        </div>
                    </form>
                    <?php 
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            $msg = "";
                            $title = mysqli_real_escape_string($conn, $_POST["title"]);
                            $username = mysqli_real_escape_string($conn, $_POST["username"]);
                            $message = mysqli_real_escape_string($conn, $_POST["message"]);
                        
                            $sql0 = "SELECT * FROM 	customer WHERE uname = '$username'";
                            $result = $conn->query($sql0);
                            if ($result) { 
                                $count = mysqli_num_rows($result);
                                if($count < 1){
                                    echo "
                                        <script>
                                            alert('Sorry the user does not exist in the database');
                                        </script>
                                    ";

                                } else {
                                    $sql3 = "SELECT * FROM messages WHERE username = '$username'";
                                    $result3 = $conn->query($sql3);
                                    if ($result3->num_rows < 1) {
                                        $sql4 = "INSERT INTO messages VALUES('','$username','$title','$message')";
                                        $result4 = $conn->query($sql4);
                                        if($result4){
                                            echo "
                                                <script>
                                                    alert('Message sent succussfully');
                                                </script>
                                            "; 
                                        }
                                    }else{
                                        $sql1 = "UPDATE messages SET username = '$username', title = '$title', message = '$message' WHERE username = '$username'";
                                        if (($conn->query($sql1) === TRUE)) { 
                                            //  header("location:add_messages.php?Updated=true");
                                            echo "
                                                <script>
                                                    alert('Message Updated Successfully');
                                                </script>
                                            ";
                                        } else { 
                                            echo "Error, didn't update successfully : " . $sql1 . "<br>" . $conn->error . "<br>";
                                        }
                                    }

                                    
                                }
                            }else{
                                echo "Error, didn't update successfully : " . $sql0 . "<br>" . $conn->error . "<br>";
                            }
                        
                        }
                    ?>
            </div>
        </div>
        <br /> <br />   <br /> <br /> 
    </body>
</html>