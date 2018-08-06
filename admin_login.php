<?php
 require_once 'database_meta_info.php';

 

  $conn = new mysqli($hostname,$username,$password,$database);
  
  $admin_username=$_POST['username'];
  $password=$_POST['password'];
//   echo $admin_username.$password;

  session_start();
  
  if (!$conn) {
      die($conn->connect_error);
  } 
  else{

  }
  



$query = "SELECT * FROM `admin_table` WHERE `username`='$admin_username' && `password`='$password'";
$result = $conn->query($query);
$rows = $result->num_rows;

// echo $rows;


if(!($rows>0)){
    
}else{
    

    
    

    for ($i = 1; $i <= $rows; $i++) {
            
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->data_seek($i);
        
        $_SESSION['adminid'] = $row['id'];
        $_SESSION['admin'] = $row['username'];
        // echo $_SESSION['adminid'].$_SESSION['admin'];

    }
    header('Location: admin_home.php');
   

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

           

            <form method="post" action="admin_login.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Use Name</label>
                    <input type="text" class="form-control" id="indexnumber"  placeholder="Enter User Name" name="username">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
               
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="./index.php"><div class="btn btn-primary">User</div></a>
              
            </form>
        </div>



    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>

    <script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>


</body>

</html>