<?php 
    include "connect.php"; 
    include "validate_customer.php";
    include "session_timeout.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php 
        $sql = "SELECT * FROM messages";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = $row["title"];
            $message = $row["message"];
        }
    ?>
    <br /><br /><br /><br />
<div class="container">
    <div class="card text-center text-white border-success">
        <div class="card-header text-success"><h1>Information</h1></div>
        <div class="card-body text-success">
            <h5 class="card-title text-uppercase " style="text-decoration:underline;"><?php echo  $title; ?></h5>
            <p class="card-text text-justify"><?php echo  $message; ?></p>
            <hr />
            <a href="customer_home.php" class="btn btn-success">Go Back </a>
        </div>
    </div>
</div>


</body>
</html>