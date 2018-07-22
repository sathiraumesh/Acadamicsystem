<?php
    require_once 'database_meta_info.php';

    session_start();
    if(isset($_SESSION['id'])&&isset($_SESSION['indexNo'])){

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
    header('Location: user_view_content.php');
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
require_once 'navbar.php';
?>

    
    <div class="container">
       



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
                    
                </div>
            
                <div class="col-md-2">
                    <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
         
     </div>
 
     <div class="col-md-2">
     <form action="user_home.php" method="post">
     <input type="hidden" value="$c_id" name="course_Id">
     <button type="submit" class="btn btn-success col-md-12">view content</button>
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
                   
                </div>
            
                <div class="col-md-2">
                <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
         
     </div>
 
     <div class="col-md-2">
     <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
                    
                </div>
            
                <div class="col-md-2">
                <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
         
     </div>
 
     <div class="col-md-2">
     <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
                    
                </div>
            
                <div class="col-md-2">
                <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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
         
     </div>
 
     <div class="col-md-2">
     <form action="user_home.php" method="post">
                    <input type="hidden" value="$c_id" name="course_Id">
                    <button type="submit" class="btn btn-success col-md-12">view content</button>
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