<?php
    /* Avoid multiple sessions warning
    Check if session is set before starting a new one. */
    if(!isset($_SESSION)) {
        session_start();
    }

    include "validate_customer.php";
    include "connect.php";
    include "header.php";
    include "customer_navbar.php";
    include "customer_sidebar.php";
    include "verify_beneficiary.php";
    include "session_timeout.php";

    if (isset($_SESSION['loggedIn_cust_id'])) {
        $sql0 = "SELECT * FROM beneficiary".$_SESSION['loggedIn_cust_id'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transfer Money</title>
    <link rel="stylesheet" href="css/transfer_other.css">
    <link rel="stylesheet" href="css/model.css">
    <script src="js/bootstrap.bundle.js"></script>
</head>

<body>
    <div class="headTitle" >
       <h2> Transfer To Other Banks </h2>
        <hr />
    </div>
   
    <form method="post" action="#"  id="myForm">
        <div class="form-input-text">
            <label>Receiver's Account Name: <br /></label>
            <input type="text" name="acct_name" placeholder="Enter Receiver's Account Name" required>
        </div>
        <div class="form-input-text">
            <label>Receiver's Account Number: <br /></label>
            <input type="text" name="acct_name" placeholder="Enter Receiver's Account  Number" required>
        </div>
        <div class="form-input-text">
            <label>Receiver's Bank Name: <br /></label>
            <input type="text" name="acct_name" placeholder="Enter Receiver's Bank Name" required>
        </div>
        <div class="form-input-text">
            <label>Receiver's Country: <br /></label>
            <input type="text" name="acct_name" placeholder="Enter Receiver's Conntry" required>
        </div>
        <div class="form-input-text">
            <label>Amount: <br /></label>
            <input type="text" name="acct_name" placeholder="Enter Amount" required>
        </div>
        <div class="form-input-text">
            <label>Description: <br /></label>
            <textarea name="desc" class="desc" cols="55" rows="7" required></textarea>
        </div>
        <div class="form-input-text">
            <button type="button" class="back">
                <a href="customer_home.php">Go Back</a>
            </button>
            <button type="submit" class="btn" >Send</button>
            <button type="reset" class="reset" onclick="return confirmReset();">Reset</button>
        </div>
    </form>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body">
            <p style=" text-align: center;">
                <img src="ajax-loader.gif" alt="Loading">
            </p>
            <h6 style=" text-align: center;">Please Wait</h6>
        </div>
      </div>
    </div>
  </div>





    <script>
        function confirmReset() {
            return confirm('Do you really want to reset?')
        }
        $(document).ready(function(){
            $('#myForm').on('submit', function(e){
                $('#myModal').modal();
                e.preventDefault();
                window.setTimeout(function(){ window.location = "message.php"; },3000); 
            });
        });
    </script>
</body>
</html>
