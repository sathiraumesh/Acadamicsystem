

<?php

require_once 'database_meta_info.php';

session_start();


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

if(isset($_POST['delete'])&&isset($_POST['lecId'])){
$lecID=$_POST['lecId'];

$query = "DELETE FROM `lecture_notes` WHERE `id`='$lecID'";
$result = $conn->query($query);


$file = $_POST['path'];
if (!unlink($file))
  {
//   echo ("Error deleting $file");
  }
else
  {
//   echo ("Deleted $file");
  }
}


if(isset($_POST['delete'])&&isset($_POST['tutId'])){
    $tutID=$_POST['tutId'];
    
    $query = "DELETE FROM `tutorials` WHERE `id`='$tutID'";
    $result = $conn->query($query);
    
    
    $file = $_POST['path'];
    if (!unlink($file))
      {
    //   echo ("Error deleting $file");
      }
    else
      {
    //   echo ("Deleted $file");
      }
    }


    if(isset($_POST['delete'])&&isset($_POST['refId'])){
        $refID=$_POST['refId'];
        
        $query = "DELETE FROM `reference_books` WHERE `id`='$refID'";
        $result = $conn->query($query);
        
        
        $file = $_POST['path'];
        if (!unlink($file))
          {
        //   echo ("Error deleting $file");
          }
        else
          {
        //   echo ("Deleted $file");
          }
        }

if($_POST['file']=="lecNotes"){

    $target_dir = "lectures/";

}
elseif($_POST['file']=="tutorials"){
    $target_dir = "tutorials/";
}
elseif($_POST['file']=="references"){
    $target_dir = "references/";
}

else{
    $target_dir = "uploads/";
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$base_file=basename($_FILES["fileToUpload"]["name"]);
// echo $base_file;
// echo $target_file;


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if($imageFileType != "pdf" && $imageFileType != "pptx" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
}

if($target_dir=="lectures/"){
    
   
    // echo $target_file;
    $query = "INSERT INTO `lecture_notes`(`id`, `course_id`, `path`,`name`) VALUES (NULL,'$course_id','$target_file','$base_file')";
    $result = $conn->query($query);
}
elseif($target_dir=="tutorials/"){
    
   
    // echo $target_file;
    $query = "INSERT INTO `tutorials`(`id`, `course_id`, `path`,`name`) VALUES (NULL,'$course_id','$target_file','$base_file')";
    $result = $conn->query($query);
}

elseif($target_dir=="references/"){
    
   
    // echo $target_file;
    $query = "INSERT INTO `reference_books`(`id`, `course_id`, `path`,`name`) VALUES (NULL,'$course_id','$target_file','$base_file')";
    $result = $conn->query($query);
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
require_once 'navbar_admin.php';
?>

<div class="container">
<?php echo "<h2>".$c_name."        ".$c_code."</h2>";

?>
    <div class="well row">
    <h3>Lecture Notes</h3>
    <div class="well">
        <h4>Add lecture notes</h4>
        <form action="add_content.php" method="post" enctype="multipart/form-data">
        <input type="file" class="btn btn-primary" name="fileToUpload" id="fileToUpload">
        <input type="hidden"  name="file" value="lecNotes" >
        <br>
        <input type="submit" class="btn btn-success" value="Upload " name="submit">
</form>
    </div>
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
<form action="add_content.php" method="post">
<input type="hidden" value="delete" name="delete">
<input type="hidden" value="$lec_id" name="lecId">
<input type="hidden" value="$path" name="path">
<button type="submit" class="btn btn-danger col-md-12">Delete</button>
</form>
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
    <div class="well">
        <h4>Add Tutorials</h4>
        <form action="add_content.php" method="post" enctype="multipart/form-data">
        <input type="file" class="btn btn-primary" name="fileToUpload" id="fileToUpload">
        <input type="hidden"  name="file" value="tutorials" >
        <br>
        <input type="submit" class="btn btn-success" value="Upload " name="submit">
</form>
    </div>



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
<form action="add_content.php" method="post">
<input type="hidden" value="delete" name="delete">
<input type="hidden" value="$tut_id" name="tutId">
<input type="hidden" value="$path" name="path">
<button type="submit" class="btn btn-danger col-md-12">Delete</button>
</form>
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
    <div class="well">
        <h4>Add Refernce books</h4>
        <form action="add_content.php" method="post" enctype="multipart/form-data">
        <input type="file" class="btn btn-primary" name="fileToUpload" id="fileToUpload">
        <input type="hidden"  name="file" value="references" >
        <br>
        <input type="submit" class="btn btn-success" value="Upload " name="submit">
</form>
    </div>
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
<form action="add_content.php" method="post">
<input type="hidden" value="delete" name="delete">
<input type="hidden" value="$ref_id" name="refId">
<input type="hidden" value="$path" name="path">
<button type="submit" class="btn btn-danger col-md-12">Delete</button>
</form>
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