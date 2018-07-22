<?php

require_once 'database_meta_info.php';

session_start();
    if(isset($_SESSION['id'])&&isset($_SESSION['indexNo'])){

    }
    else{
        header('Location: index.php');
    }

    $course_id=$_SESSION['content'];
   

$conn = new mysqli($hostname,$username,$password,$database);

 
 
// echo $course_id;


$query = "SELECT * FROM `course` WHERE `id`='$course_id'";
$result = $conn->query($query);
$rows = $result->num_rows;

  if($rows>0){

 

   for ($i = 1; $i <=$rows; $i++) {
       
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $result->data_seek($i);
       $c_code= $row['course_code'];
       $c_name= $row['course_name'];
       
// echo $c_code.$c_name;
   }
}







?>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>Home</title>
</head>
<body>

  <?php
require_once 'navbar.php';
?>

<div class="container">
<?php echo "<h2>".$c_name."        ".$c_code."</h2>";

?>
    <div class="well row">
    <h3>Lecture Notes</h3>
    
<?php

 $query = "SELECT * FROM `lecture_notes` WHERE `course_id`='$course_id'";
 $result = $conn->query($query);
 $rows = $result->num_rows;

   if($rows>0){

  

    for ($i = 1; $i <=$rows; $i++) {
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->data_seek($i);
        $name =$row['name'];
        $path=$row['path'];
        $lec_id=$row['id'];
        
echo<<<_END

<div class="well col-md-12">


<div class="col-md-8">
    $name
</div>

<div class="col-md-2">

</div>

<div class="col-md-2">


<a href="$path"><button class="btn btn-success col-md-12">Download</button></a>
</div>
    </div>

_END;

    }

}
?>
    
    </div>

    <div class="well row">
    <h3>Tutorials</h3>
    



    <?php

$query = "SELECT * FROM `tutorials` WHERE `course_id`='$course_id'";
$result = $conn->query($query);
$rows = $result->num_rows;

  if($rows>0){

 

   for ($i = 1; $i <=$rows; $i++) {
       
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $result->data_seek($i);
       $name =$row['name'];
       $path=$row['path'];
       $tut_id=$row['id'];
       
echo<<<_END

<div class="well col-md-12">


<div class="col-md-8">
   $name
</div>

<div class="col-md-2">

</div>

<div class="col-md-2">


<a href="$path"><button class="btn btn-success col-md-12">Download</button></a>
</div>
   </div>

_END;

   }

}
?>
    </div>

    <div class="well row">
    <h3>Refernce Books</h3>
    
    <?php

$query = "SELECT * FROM `reference_books` WHERE `course_id`='$course_id'";
$result = $conn->query($query);
$rows = $result->num_rows;

  if($rows>0){

 

   for ($i = 1; $i <=$rows; $i++) {
       
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $result->data_seek($i);
       $name =$row['name'];
       $path=$row['path'];
       $ref_id=$row['id'];
       
echo<<<_END

<div class="well col-md-12">


<div class="col-md-8">
   $name
</div>

<div class="col-md-2">

</div>

<div class="col-md-2">


<a href="$path"><button class="btn btn-success col-md-12">Download</button></a>
</div>
   </div>

_END;

   }

}
?>

    </div>
</div>



 <script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>