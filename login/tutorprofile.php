<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    #myiframe {width:700px; height:350%;} 
  </style>
  <title>PTA</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<?php 
  session_start();
  if(!isset($_SESSION["user"] ) && !isset($_SESSION["email"]))
  {
    header("location:index.php");
  }
  elseif ($_SESSION["role"]!="tutor")
  {
    header("location:logout.php");
  }
require("connect.php");
$sql="SELECT * FROM admin WHERE role ='hod' ";
$res=mysqli_query($db,$sql);
//$row=mysqli_fetch_assoc($res);

?>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Welcome</a>
    <ul class="navbar-nav mr-auto">
    
      <li class="nav-item active">
        <a class="nav-link" href="adminprofile.php">Manage HOD</a>
      </li>

    
      <li class="nav-item">
        <a class="nav-link" href="changepassword.php">Change Password</a>
      </li>

    </ul>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

     
    </ul>
  </nav>

<div class="container-float"> 
<table class="table table-striped">
  <thead>
    <tr>
      <th>Reviewer Name</th>
      <th>Email</th>
      <th>Department</th>     
    </tr>
  </thead>
  <tbody>
    <?php
      if( mysqli_num_rows( $res )==0 ){
        echo '<tr><td colspan="4">No Sub Admins Found</td></tr>';
          echo "<tr>
       <td><a href='createhod.php'><button class='btn btn-primary'>Create Reviewer</button></a></td>
       <td><a href='../php/changeadminmail.php'><button class='btn btn-primary'>Change Admin Mail</button></a></td>
       <td></td>
       <td></td>
       </tr>";

      }else{
        while($row=mysqli_fetch_assoc($res)){
        $id=$row["admname"];
       echo "<tr>
       <td>{$row['admname']}</td>
       <td>{$row['email']}</td>
       <td>{$row['dept']}</td>
       <td><form action=adminprofile.php method='post'>
          <input type='hidden' name ='subid' value='$id'>
          <input type='submit' class='btn btn-default' value ='Delete' ></form></td>
       </tr>";
        }
       echo "<tr>
       <td><a href='createhod.php'><button class='btn btn-primary'>Create Reviewer</button></a></td>
       <td><a href='changeadminmail.php'><button class='btn btn-primary'>Change Admin Mail</button></a></td>
       <td></td>
       <td></td>
       </tr>";

      }



    if(isset($_POST["subid"]))
    {
  
      
      $sql3="DELETE FROM admin WHERE admname='$_POST[subid]'";

          if (mysqli_query($db,$sql3))
          {
            echo "<script>
                  swal(
                  'Deleted',
                  'Reviewer Deleted',
                  'warning'
                    ).then(function() {
                window.location.href ='adminprofile.php'; 
              });
                </script>";
          }

     
      
    
    }

    ?>

  </tbody>
</table>

</div>

<br>


<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>
