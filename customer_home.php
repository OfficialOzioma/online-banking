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

    $sql1 = "SELECT * FROM passbook".$id." WHERE trans_id=(SELECT MAX(trans_id) FROM passbook".$id.")";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();

    $getTransID = $row1['trans_id'];

    if ($row1["debit"] == 0) {
        $transaction = $row1["credit"];
        $type = "credit";
    }
    else {
        $transaction = $row1["debit"];
        $type = "debit";
    }

    $time = strtotime($row1["trans_date"]);
    $sanitized_time = date("d/m/Y, g:i A", $time);

    $sql2 = "SELECT COUNT(*) FROM beneficiary".$id;
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_home_style.css">
    <link rel="stylesheet" href="transactions_style.css">
</head>

<body>
    <div class="flex-container">
        <div class="flex-item">
            <label class="alert alert-info">
                <h2 id="customer">
                    Welcome, <?php echo $row0["first_name"] ?>&nbsp<?php echo $row0["last_name"] ?>&nbsp!
                </h2>
            </label>
        </div>

        <!--market updates updates-->
	    <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
                        <h2>Your </h2>
						<h3>Account Number: </h3>
						<h4><?php echo $row0["account_no"]; ?></h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				    <div class="col-md-8 market-update-left">
                        <h2>Your </h2>
					    <h3>Balance (USD) </h3>
					    <h4>$ <?php echo number_format($row1["balance"]); ?></h4>
				    </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				    <div class="clearfix"> </div>
			    </div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
                        <h2>You have</h2>
						<h3><?php echo $row2["COUNT(*)"]; ?></h3>
						<h4>beneficiaries.</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				    <div class="clearfix"> </div>
				</div>
			</div>
		    <div class="clearfix"> </div>
        </div>

        <!--market updates end here-->
                <div class="chit-chat-heading">
                    &#9656 Yours last transaction
                </div>
                <div id="flex-container">
                    <table id="transactions">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Remarks</th>

                                <th>Type</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $sanitized_time; ?></td>
                                <td><?php echo $row1["remarks"]; ?></td>

                                <td><span class="label label-danger"><?php echo $type; ?></span></td>
                                <td><span class="badge badge-info">successful</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

    </div>

</div>

</body>
</html>

<?php include "easter_egg.php"; ?>
