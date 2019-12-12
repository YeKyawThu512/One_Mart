<?php  
include("header.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">
    
    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <title>One Mart</title>
    
    <style>
    .zawgyi{
        font-family:Zawgyi-One;
    }
    .unicode{
        font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
    }
    </style>
  </head>
    <body>

    <div class="fixed-top">
        <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 60px; line-height: 60px; text-align: center; font-size: 19px;">
            <div class="col-2">
                <a href="#" onclick="goBack()" style="text-align: center;color: white;">
                    <i class="fa fa-arrow-left"> </i>
                </a>
            </div>
            <div class="col-10">
                <p class="text-justify zawgyi" style="color:white;text-align: center;">
                    My Account
                </p>
            </div>
        </div>
    </div>
  
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-12">
                <center>
                    <img class="demo-avatar" src="profile/<?php echo $profile; ?>" alt="profile" style="width: 250px; height: 250px;">
                </center>
            </div>
        </div> 
    </div><hr>
 
    <center>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p style="font-size: 20px;text-align: center;color: #02b875;" class="zawgyi"> 
                        <i class="fa fa-user"></i> &nbsp; <?php echo $name; ?>
                    </p>
                </div>
            </div>
        </div><hr>
    </center>

    <center>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p style="font-size: 20px;text-align: center;color: #006698;font-weight: bold;"> 
                        <i class="fa fa-phone"></i> &nbsp; <?php echo $phone; ?>
                    </p>
                </div>
            </div>
        </div><hr>
    </center>
    <br/><br/>   
  
    <a href="acc_edit.php" style="text-align: center;color: white;text-decoration: none;">
        <div class="fixed-bottom">
            <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 50px; line-height: 50px; text-align: center; font-size: 19px;">
                <div class="col-12">
                    <i class="fa fa-edit"> </i> &nbsp; Edit
                </div>
            </div>
        </div>
    </a> 


    <script>
        function goBack() {
            window.history.back();
        }
    </script> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>