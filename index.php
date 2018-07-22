<?php
 require_once 'database_meta_info.php';

 

  $conn = new mysqli($hostname,$username,$password,$database);
  
  $indexNumber=$_POST['indexNumber'];
  $password=$_POST['password'];
//   echo $indexNumber.$password;

  session_start();
  
  if (!$conn) {
      die($conn->connect_error);
  } 
  else{

  }
  



$query = "SELECT * FROM `login_credentials` WHERE `index_no`='$indexNumber' && `password`='$password'";
$result = $conn->query($query);
$rows = $result->num_rows;

// echo $rows;


if(!($rows>0)){
    
}else{
    

    
    

    for ($i = 1; $i <= $rows; $i++) {
            
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->data_seek($i);
        
        $_SESSION['id'] = $row['id'];
        $_SESSION['indexNo'] = $row['Index_no'];
        // echo $_SESSION['id'].$_SESSION['indexNo'];

    }
    header('Location: user_home.php');
   

}


  
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<h1 class="heading">GEOMATE</h1>
  
       
        
    <div class="container ">
        
        
        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 image-logo">
                <img src="./assets/geomatics_front.jpg" alt="gemotaics" class="img-responsive">
        </div> -->

        <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
        <div class="login-panel col-xs-12 col-sm-4 col-md-4 col-lg-4">

           

            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">IndexNumber</label>
                    <input type="text" class="form-control" id="indexnumber"  placeholder="Enter indexNumber" name="indexNumber">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
               
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="./admin_login.php"><div class="btn btn-primary">Administrator</div></a>
            </form>
        </div>



    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>

    <script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>


</body>

</html>