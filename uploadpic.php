<?php
  include "connect.php";
  include "validate_admin.php";
  include "admin_session_timeout.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Upload a picture</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/upload.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">
        <!-- <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/app.js"></script> -->
    </head>
    <body>

    <br />  <br />

    <div class="container" id="page-wrapper">

      <form action="upload_pic_action.php" id="ajax-submit" method="post" enctype="multipart/form-data" name="passport_form">

        <div class="card border-primary card-div">

          <img class="card-img-top" src="images/clickhere.png" id="displayImg" alt="image" height="250" width="100" accept="image/*">  

          <div class="card-body">

            <div class="form-group">

              <label for="cust_username">Customer's username</label>

              <input type="text" class="form-control" name="cust_username" id="cust_username" placeholder="Enter the Username of the customer" required> 

            </div>
            
            <div id="form-messages" ></div>
            <input type="file" class="form-control-file" name="img" id="realfilebtn" required onchange="displayPicture(this)" > <br />

            <button type="submit" class="btn btn-success" id="main_upload_btn" name="submitBtn">Save Picture</button>

            <a href="admin_home.php" class="btn btn-info" style="float:right;">Go Back</a>

          </div>
        </div>
      </form>
        
    </div>
    <script type="text/javascript">
        const uploadbtn = document.getElementById('main_upload_btn');
        const real_file_btn = document.getElementById('realfilebtn');
        const display_Img = document.getElementById('displayImg');

        real_file_btn.style.display = 'none';
        display_Img.addEventListener('click', () => {
          real_file_btn.click();
        });

        function displayPicture(e){
          if(e.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
              display_Img.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
          }
        }
    </script>
    
    </body>
</html>