<?php

echo<<<_END

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="navbar-brand" >Geomate</span>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./admin_home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="./comments.php">Comments <span class="sr-only">(current)</span></a></li>
        
        
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      <form action="logout.php" method="post">
      <input type="hidden" value="logout" name="logoutadmin">
     <button type="submit" class='btn btn-primary'>Logout</button>
      </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

_END;
?>