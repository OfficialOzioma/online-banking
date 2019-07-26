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
                            <p class="card-text">
                                <div class="form-group">
                                    <label for="title"><h3>Message header</h3></label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter the Heading of the message here" value="<?php echo $title; ?>">
                                </div>  
                                <div class="form-group">
                                    <label for="message"><h4>Message</h4></label>
                                    <textarea class="form-control" name="message" id="message" rows="7"><?php echo $message; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-success" name="msg_btn">Update Message</button>
                                <a href="admin_home.php" class="btn btn-success" style="float:right;">Go Back</a>
                            </p>
                          </div>
                        </div>
                    </form>
                    <?php 
                     if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $title = mysqli_real_escape_string($conn, $_POST["title"]);
                        $message = mysqli_real_escape_string($conn, $_POST["message"]);
                        
                        $sql0 = "UPDATE messages SET title = '$title', message = '$message' WHERE id ='$id'";

                        if (($conn->query($sql0) === TRUE)) { 
                           header("location:add_messages.php?Updated=true");
                            echo "
                                <script>
                                    alert('Message Updated Successfully');
                                </script>
                            ";
                            
                        }
                        else { 
                             echo "Error, didn't update successfully : " . $sql0 . "<br>" . $conn->error . "<br>";
                        }
                     }
                    ?>
            </div>
        </div>
        <br /> <br />   <br /> <br /> 
    </body>
</html>