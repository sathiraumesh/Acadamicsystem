<?php

require_once 'database_meta_info.php';

session_start();
    if(isset($_SESSION['id'])&&(isset($_SESSION['indexNo']))||isset($_SESSION['admin'])){
        if(isset($_SESSION['indexNo'])){
            $indexNo = $_SESSION['indexNo'];
        }
        if(isset($_SESSION['admin'])){
            $indexNo = $_SESSION['admin'];
        }
        
         
    }
    else{
        header('Location: index.php');
    }

    $conn = new mysqli($hostname,$username,$password,$database);

    if (!$conn) {
        die($conn->connect_error);
    } 
    else{
  
    }

    if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
        $query = "INSERT INTO `comments`(`Comment_id`, `comment`, `indexNo`) VALUES (NULL,'$comment','$indexNo')";
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
    <title>Comments</title>
</head>
<body>
    <?php
    require_once 'navbar.php';
    ?>

    <h1>Comments</h1>

    <div class="container">
        <div class="row">
            <div class="box">
                <?php
                $query = "SELECT * FROM `comments` ORDER BY `Comment_id` DESC ";
                $result = $conn->query($query);
                $rows = $result->num_rows;


                 if($rows>0){

  

                    for ($i = 1; $i <=$rows; $i++) {
                        
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        $result->data_seek($i);
                        $commentid =$row['Comment_id'];
                        $comment=$row['comment'];
                        $in=$row['indexNo'];

                        echo<<<_END
                       
                        <div class="well float-message" >
                        <h4> $in  </h4>
                        $comment
                    </div>
                    <br>
                    
_END;
                        
                    }
                }
               
                ?>
           
            </div>
            </div>
        </div>
       <br>
       <br>
       <div class="container">
        <form action="comments.php" method="post">
            <input type="text" class="form-control col-xs-2" placeholder="Enter your comment here" name="comment">
            <br>
            <br>
            <button type="submit" class="btn btn-success">comment</button>
        </form>
        </div>
    </div>
            


    <script type="text/javascript" src="./jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>