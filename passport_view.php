<?php
    include "validate_customer.php";
    include "header.php";
    include "customer_navbar.php";
    include "customer_sidebar.php";
    include "session_timeout.php";

    $id = $_SESSION['loggedIn_cust_id'];

    $sql0 = "SELECT * FROM customer WHERE cust_id=".$id;
    $result0 = $conn->query($sql0);
    $row0 = $result0->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_home_style.css">
    <link rel="stylesheet" href="transactions_style.css">
    <link rel="stylesheet" href="css/passport_view.css">

</head>

<body>
    <div class="flex-container">
        <div class="flex-item">
        <?php
            $msg = "";
            $username = $row0["uname"] ;
            $sql = "SELECT * FROM images WHERE customer_id = '$username'";
            $result = $conn->query($sql);
            $count = mysqli_num_rows($result);
           if ($count < 1){
            $msg = "Sorry you don't have any passport yet!";
           }else{
               $pictures = $result->fetch_assoc();
           }
            
        ?>
        <div class="container" id="page-wrapper">
            <div class="card border-primary card-div">
                <?php if(isset($msg)) {
                    echo "<h3>" .$msg ."</h3>";
                }else{ ?>
                   <img src="passport/<?php echo $pictures['image_name']; ?>" width="500" alt="passport">
               <?php }   ?>
               
            </div>
        </div>
        </div>
    </div>
        
</body>
</html>

<?php include "easter_egg.php"; ?>
