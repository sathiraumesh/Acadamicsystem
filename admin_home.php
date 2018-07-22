<?php
    require_once 'database_meta_info.php';

    session_start();
    if(isset($_SESSION['adminid'])&&isset($_SESSION['admin'])){

    }
    else{
        header('Location: index.php');
    }
    

// echo $username.$password;
$conn = new mysqli($hostname,$username,$password,$database);

$username=$_POST['username'];
$password=$_POST['password'];
$year=$_POST['year'];
$semester=$_POST['semester'];
$course_code=$_POST['courseCode'];
$course_name=$_POST['courseName'];
$course_id =$_POST['courseId'];
$delete=$_POST['delete'];



// echo $year.$semester.$course_code,$course_name;
$user_add=false;

// echo $username.$password.$user;

if (!$conn) {
    die($conn->connect_error);
} else {
    //  echo "connected successfuly";
}

if(isset($_POST['course_Id'])){
    $_SESSION['content']=$_POST['course_Id'];
    header('Location: add_content.php');
}

if(isset($_POST['username_delete'])){
    $del_user=$_POST['username_delete'];
    $query = "DELETE  FROM `login_credentials` WHERE `Index_no`='$del_user' ";
    $result = $conn->query($query);
    $delet_user=true;
}

if(isset($_POST['courseId']) && isset($_POST['delete'])){
    
    $query = "DELETE  FROM `course` WHERE `id`='$course_id' ";
    $result = $conn->query($query);
    

    $query = "SELECT * FROM `lecture_notes` WHERE `course_id`='$course_id' ";
    $result = $conn->query($query);
    $rows = $result->num_rows;
    echo $rows;
    
           if($rows>0){

          

            for ($i = 1; $i <=$rows; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $course_path= $row['path'];
                $file =$course_path;
                if (!unlink($file))
                {
                echo ("Error deleting $file");
                }
                else
                {
                echo ("Deleted $file");
                }
                }
                $query = "DELETE  FROM `lecture_notes` WHERE `course_id`='$course_id' ";
                $result = $conn->query($query);
            }

            $query = "SELECT * FROM `tutorials` WHERE `course_id`='$course_id' ";
            $result = $conn->query($query);
            $rows = $result->num_rows;
            echo $rows;
    
           if($rows>0){

          

            for ($i = 1; $i <=$rows; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $course_path= $row['path'];
                $file =$course_path;
                if (!unlink($file))
                {
                echo ("Error deleting $file");
                }
                else
                {
                echo ("Deleted $file");
                }
                }
                $query = "DELETE  FROM `tutorials` WHERE `course_id`='$course_id' ";
                $result = $conn->query($query);
            }

            $query = "SELECT * FROM `reference_books` WHERE `course_id`='$course_id' ";
            $result = $conn->query($query);
            $rows = $result->num_rows;
            echo $rows;
    
           if($rows>0){

          

            for ($i = 1; $i <=$rows; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $course_path= $row['path'];
                $file =$course_path;
                if (!unlink($file))
                {
                echo ("Error deleting $file");
                }
                else
                {
                echo ("Deleted $file");
                }
                }
                $query = "DELETE  FROM `reference_books` WHERE `course_id`='$course_id' ";
                $result = $conn->query($query);
            }
           
        }
    


    if(isset($_POST['username']) && isset($_POST['password'])){
        $query = "INSERT INTO `login_credentials` (`id`, `index_no`, `password`, `user`) VALUES (NULL,'$username','$password','$user') ";
        $result = $conn->query($query);
        $user_add=true;
    }

    
    if(isset($_POST['year']) && isset($_POST['semester'])&& isset($_POST['courseCode']) && isset($_POST['courseName'])){
        $query = "INSERT INTO `course`(`id`, `course_code`, `course_name`, `year`, `semsester`) VALUES (NULL,'$course_code','$course_name','$year','$semester') ";
        $result = $conn->query($query);
        
    }

    
?>

<!DOCTYPE html>
<html lang="en">

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

    <div class="container mng-users well">
        <h2>Manage Users</h2>
        <div class="well">

            <div class="container">

                <form action="admin_home.php" method="post">


                    <div class="input-group col-sm-offset-4 col-xs-12 col-sm-4 col-md-4">
                        <span class="input-group-addon glyphicon glyphicon-user" id="sizing-addon2"></span>
                        <input type="text" class="form-control" placeholder="Index number" aria-describedby="sizing-addon2" name="username">
                    </div>

                    <div class="input-group col-sm-offset-4 col-xs-12 col-sm-4 col-md-4">
                        <span class="input-group-addon glyphicon glyphicon-lock " id="sizing-addon2"></span>
                        <input type="text" class="form-control" placeholder="password" aria-describedby="sizing-addon2" name="password">
                    </div>

                    
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <button type="submit" class="btn btn-primary btn btn-primary col-md-offset-4 col-md-2">ADD</button>
                    </div>

                </form>
                </div>
    <br>
                    
        <?php
        if($user_add){
        
        echo<<<_END

        <div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     Successfully added the user <strong>$username</strong>
  </div>

_END;

        }
        $user_add=false;
        ?>            
                
           

            

        </div>

        <div class="well">
        <div class="container">
                <form action="admin_home.php" method="post">
                    <div class="input-group col-sm-offset-4 col-xs-12 col-sm-4 col-md-4">
                        <span class="input-group-addon glyphicon glyphicon-user" id="sizing-addon2"></span>
                        <input type="text" class="form-control" placeholder="Index number" aria-describedby="sizing-addon2" name="username_delete">
                    </div>


                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <button type="submit" class="btn btn-danger col-md-offset-4 col-md-2">DELETE</button>
                    </div>
                </form>
            </div>
        
        </div>
        <?php
        if($delet_user){
        
        echo<<<_END

        <div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     Successfully deleted the user <strong>$username</strong>
  </div>

_END;

        }
        $delet_user=false;
        ?>            
                
           
    </div>

    <div class="container">
        <div class="well col-md-12">
            <h1>Add Subjects</h1>
            <form  action="admin_home.php" method="post">
            <div class="col-md-6">
            <label>Year</label>
            <select class="form-control" name="year">
                <option>Year 1</option>
                <option>Year 2</option>
                <option>Year 3</option>
                <option>Year 4</option>
            </select>
            <label>Semester</label>
            <select class="form-control" name="semester">
                <option>Semester 1</option>
                <option>Semester 2</option>
            </select>
            <label>Course Code</label>
            <input type="text" class="form-control" placeholder="Course Code" aria-describedby="sizing-addon2" name="courseCode">
            <label>Course Name</label>
            <input type="text" class="form-control" placeholder="Course Name" aria-describedby="sizing-addon2" name="courseName">
            <br>
            <br>
            <br>
            <div class="col-md-12">

            <button type="submit" class="btn btn-primary ">Add Subject</button>
            </div>
            </div>
           
           
            
            </form>
        </div>
    </div>
    <div class="container">
        <h2>Manage subjects</h2>



        <div class="well col-md-12">
            <h1 class="heading">Year I</h1>
           <h2>Semester I</h2>




           <?php

          
         $query = "SELECT * FROM `course` WHERE `year`='Year 1' && `semsester`='Semester 1'";
         $result = $conn->query($query);
         $rows_year_one_sem_one = $result->num_rows;

           if($rows_year_one_sem_one>0){

          

            for ($i = 1; $i <=$rows_year_one_sem_one; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $c_code= $row['course_code'];
                $c_name= $row['course_name'];
                $c_id =$row['id'];
        
                

echo<<<_END

            <div class="well col-md-12">
                <div class="col-md-2">
                       $c_code
                </div>
            
                <div class="col-md-6">
                        $c_name
                </div>
            
                <div class="col-md-2">
                    <form action="admin_home.php" method="post">
                    <input type="hidden" value="delete" name="delete">
                    <input type="hidden" value="$c_id" name="courseId">
                    <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                    </form>
                </div>
            
                <div class="col-md-2">
                    <form action="admin_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">Add content</button>
                    </form>
                </div>
            </div>
                      
_END;
        
            }
           


           }

          
           ?>



           
           <h2>Semester II</h2>

<?php


$query = "SELECT * FROM `course` WHERE `year`='Year 1' && `semsester`='Semester 2'";
$result = $conn->query($query);
$rows_year_one_sem_two = $result->num_rows;

if($rows_year_one_sem_two>0){



 for ($i = 1; $i <=$rows_year_one_sem_two; $i++) {
     
     $row = $result->fetch_array(MYSQLI_ASSOC);
     $result->data_seek($i);
     $c_code= $row['course_code'];
     $c_name= $row['course_name'];
     $c_id =$row['id'];

     

echo<<<_END

 <div class="well col-md-12">
     <div class="col-md-2">
            $c_code
     </div>
 
     <div class="col-md-6">
             $c_name
     </div>
 
     <div class="col-md-2">
         <form action="admin_home.php" method="post">
         <input type="hidden" value="delete" name="delete">
         <input type="hidden" value="$c_id" name="courseId">
         <button type="submit" class="btn btn-danger col-md-12">Delete</button>
         </form>
     </div>
 
     <div class="col-md-2">
        <form action="admin_home.php" method="post">
        <input type="hidden" value="$c_id" name="course_Id">
         <button type="submit" class="btn btn-success col-md-12">Add content</button>
         </form>
     </div>
 </div>
           
_END;

 }



}


?>

           </div>








        <div class="well col-md-12">
            <h1 class="heading">Year II</h1>
           <h2>Semester I</h2>




           <?php

          
         $query = "SELECT * FROM `course` WHERE `year`='Year 2' && `semsester`='Semester 1'";
         $result = $conn->query($query);
         $rows_year_two_sem_one = $result->num_rows;

           if($rows_year_two_sem_one>0){

          

            for ($i = 1; $i <=$rows_year_two_sem_one; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $c_code= $row['course_code'];
                $c_name= $row['course_name'];
                $c_id =$row['id'];
        
                

echo<<<_END

            <div class="well col-md-12">
                <div class="col-md-2">
                       $c_code
                </div>
            
                <div class="col-md-6">
                        $c_name
                </div>
            
                <div class="col-md-2">
                    <form action="admin_home.php" method="post">
                    <input type="hidden" value="delete" name="delete">
                    <input type="hidden" value="$c_id" name="courseId">
                    <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                    </form>
                </div>
            
                <div class="col-md-2">
                <form action="admin_home.php" method="post">
                <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">Add content</button>
                    </form>
                </div>
            </div>
                      
_END;
        
            }
           


           }

          
           ?>



           
           <h2>Semester II</h2>

<?php


$query = "SELECT * FROM `course` WHERE `year`='Year 2' && `semsester`='Semester 2'";
$result = $conn->query($query);
$rows_year_two_sem_two = $result->num_rows;

if($rows_year_two_sem_two>0){



 for ($i = 1; $i <=$rows_year_two_sem_two; $i++) {
     
     $row = $result->fetch_array(MYSQLI_ASSOC);
     $result->data_seek($i);
     $c_code= $row['course_code'];
     $c_name= $row['course_name'];
     $c_id =$row['id'];

     

echo<<<_END

 <div class="well col-md-12">
     <div class="col-md-2">
            $c_code
     </div>
 
     <div class="col-md-6">
             $c_name
     </div>
 
     <div class="col-md-2">
         <form action="admin_home.php" method="post">
         <input type="hidden" value="delete" name="delete">
         <input type="hidden" value="$c_id" name="courseId">
         <button type="submit" class="btn btn-danger col-md-12">Delete</button>
         </form>
     </div>
 
     <div class="col-md-2">
     <form action="admin_home.php" method="post">
     <input type="hidden" value="$c_id" name="course_Id">
         <button type="submit" class="btn btn-success col-md-12">Add content</button>
         </form>
     </div>
 </div>
           
_END;

 }



}


?>

           </div>






<div class="well col-md-12">
            <h1 class="heading">Year III</h1>
           <h2>Semester I</h2>




           <?php

          
         $query = "SELECT * FROM `course` WHERE `year`='Year 3' && `semsester`='Semester 1'";
         $result = $conn->query($query);
         $rows_year_three_sem_one = $result->num_rows;

           if($rows_year_three_sem_one>0){

          

            for ($i = 1; $i <=$rows_year_three_sem_one; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $c_code= $row['course_code'];
                $c_name= $row['course_name'];
                $c_id =$row['id'];
        
                

echo<<<_END

            <div class="well col-md-12">
                <div class="col-md-2">
                       $c_code
                </div>
            
                <div class="col-md-6">
                        $c_name
                </div>
            
                <div class="col-md-2">
                    <form action="admin_home.php" method="post">
                    <input type="hidden" value="delete" name="delete">
                    <input type="hidden" value="$c_id" name="courseId">
                    <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                    </form>
                </div>
            
                <div class="col-md-2">
                <form action="admin_home.php" method="post">
                <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">Add content</button>
                    </form>
                </div>
            </div>
                      
_END;
        
            }
           


           }

          
           ?>



           
           <h2>Semester II</h2>

<?php


$query = "SELECT * FROM `course` WHERE `year`='Year 3' && `semsester`='Semester 2'";
$result = $conn->query($query);
$rows_year_three_sem_two = $result->num_rows;

if($rows_year_three_sem_two>0){



 for ($i = 1; $i <=$rows_year_three_sem_two; $i++) {
     
     $row = $result->fetch_array(MYSQLI_ASSOC);
     $result->data_seek($i);
     $c_code= $row['course_code'];
     $c_name= $row['course_name'];
     $c_id =$row['id'];

     

echo<<<_END

 <div class="well col-md-12">
     <div class="col-md-2">
            $c_code
     </div>
 
     <div class="col-md-6">
             $c_name
     </div>
 
     <div class="col-md-2">
         <form action="admin_home.php" method="post">
         <input type="hidden" value="delete" name="delete">
         <input type="hidden" value="$c_id" name="courseId">
         <button type="submit" class="btn btn-danger col-md-12">Delete</button>
         </form>
     </div>
 
     <div class="col-md-2">
     <form action="admin_home.php" method="post">
     <input type="hidden" value="$c_id" name="course_Id">
         <button type="submit" class="btn btn-success col-md-12">Add content</button>
         </form>
     </div>
 </div>
           
_END;

 }



}


?>

           </div>








        <div class="well col-md-12">
            <h1 class="heading">Year IV</h1>
           <h2>Semester I</h2>




           <?php

          
         $query = "SELECT * FROM `course` WHERE `year`='Year 4' && `semsester`='Semester 1'";
         $result = $conn->query($query);
         $rows_year_four_sem_one = $result->num_rows;

           if($rows_year_four_sem_one>0){

          

            for ($i = 1; $i <=$rows_year_four_sem_one; $i++) {
                
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $result->data_seek($i);
                $c_code= $row['course_code'];
                $c_name= $row['course_name'];
                $c_id =$row['id'];
        
                

echo<<<_END

            <div class="well col-md-12">
                <div class="col-md-2">
                       $c_code
                </div>
            
                <div class="col-md-6">
                        $c_name
                </div>
            
                <div class="col-md-2">
                    <form action="admin_home.php" method="post">
                    <input type="hidden" value="delete" name="delete">
                    <input type="hidden" value="$c_id" name="courseId">
                    <button type="submit" class="btn btn-danger col-md-12">Delete</button>
                    </form>
                </div>
            
                <div class="col-md-2">
                <form action="admin_home.php" method="post">
                <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">Add content</button>
                    </form>
                </div>
            </div>
                      
_END;
        
            }
           


           }

          
           ?>



           
           <h2>Semester II</h2>

<?php


$query = "SELECT * FROM `course` WHERE `year`='Year 4' && `semsester`='Semester 2'";
$result = $conn->query($query);
$rows_year_four_sem_two = $result->num_rows;

if($rows_year_four_sem_two>0){



 for ($i = 1; $i <=$rows_year_four_sem_two; $i++) {
     
     $row = $result->fetch_array(MYSQLI_ASSOC);
     $result->data_seek($i);
     $c_code= $row['course_code'];
     $c_name= $row['course_name'];
     $c_id =$row['id'];

     

echo<<<_END

 <div class="well col-md-12">
     <div class="col-md-2">
            $c_code
     </div>
 
     <div class="col-md-6">
             $c_name
     </div>
 
     <div class="col-md-2">
         <form action="admin_home.php" method="post">
         <input type="hidden" value="delete" name="delete">
         <input type="hidden" value="$c_id" name="courseId">
         <button type="submit" class="btn btn-danger col-md-12">Delete</button>
         </form>
     </div>
 
     <div class="col-md-2">
     <form action="admin_home.php" method="post">
     <input type="hidden" value="$c_id" name="course_Id">
         <button type="submit" class="btn btn-success col-md-12">Add content</button>
         </form>
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