<?php
  include "connect.php";
  include "validate_admin.php";
  include "admin_session_timeout.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Passpoart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/upload.css" rel="stylesheet">
        <link href="css/bootstrap.css " rel="stylesheet">
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM images";
            $result = mysqli_query($conn, $sql);
            
            $pictures = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        ?>
        <div class="container" id="page-wrapper">
            <div class="card border-primary card-div">
                <table class="table-bordered">
                    <thead>
                        <th>Username</th>
                        <th>Passport</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pictures as $picture):?>
                            <tr>
                                <td> <?php echo $picture['customer_id']; ?></td>
                                <td> <img src="passport/<?php echo $picture['image_name'];?>" width="100"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br />
                <a href="admin_home.php" class="btn btn-info" style="float:right;">Go Back</a>
            </div>
        </div>
    </body>
</html>