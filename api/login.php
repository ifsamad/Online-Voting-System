<?php

// tihs method activate the session variable and access it without session start we can"t access
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

// chack user data in database that match or not
$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile ='$mobile' AND password='$password' AND role='$role' ");

if(mysqli_num_rows($check)>0){

    // fetch single user data that exists in database
    $userdata = mysqli_fetch_array($check);
    // check group data in db that exists
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
    // fetch groups data and comine it and make a object to store in it
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata'] = $userdata;  // store user data into session variable
    $_SESSION['groupsdata'] = $groupsdata; // store group data into session variable

     

    echo '
    <script>
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
else{
    echo '
    <script>
    alert("Invalid Credential or User not found");
    window.location = "../";
    </script>
    ';
}

?>