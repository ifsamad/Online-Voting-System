<?php

session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

// stored user data in thr form of array
$userdata = $_SESSION['userdata']; 

//stored groups data in thr form of array
$groupsdata = $_SESSION['groupsdata'];

if( $_SESSION['userdata']['status']==0){
    $status = '<b style="color:red"> Not Voted</b>';
}
else{
    $status = '<b style="color:green"> Voted</b>';
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online-Voting-System-Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  


<div id="mainSection">
        <center>
     <div id="headerSection">
     <a href="../"><button id="backbtn" > Back</button></a>
     <a href="logout.php"><button id="logoutbtn">Logout</button></a>
       
       <h1>Online Voting System</h1>
     </div>     
     </center>
    
    <hr>

    <div id="mainpanel">
    <div id="profile">

    <!-- fetch user image and php code inside html -->
    <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100px" width="100px"></center>
    <b>Name:</b> <?php echo $userdata['name'] ?> <br><br>
    <b>Mobile:</b> <?php echo $userdata['mobile'] ?> <br><br>
    <b>Address:</b> <?php echo $userdata['address'] ?> <br><br>
    <b>status:</b> <?php echo $status ?> <br><br>
    </div>


    <div id="group">
   <?php 
   if($_SESSION['groupsdata']){
    for($i=0; $i<count($groupsdata); $i++){
        ?>
        <div>
        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100px" width="100px">
        <b>Group Name: <?php echo $groupsdata[$i]['name'] ?></b> <br><br>
        <b>Votes: <?php echo $groupsdata[$i]['votes'] ?> </b> <br><br>
        <form action="../api/vote.php" method="POST">
          <!-- groups previous data  and its id for database -->
                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">   
                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">       
                <input type="submit" name="votebtn" value="vote" id="votebtn">
        </form>
        </div>
        <?php

    }
   }
   else{

   }
   ?>
 </div>
    </div>
   

  </div>   
</body>
</html>