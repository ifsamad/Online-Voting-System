<?php
// connection by using another file in which connection defined
include("connect.php");

// data collection from user
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
   $image = $_FILES['photo']['name'];
   $tmp_name = $_FILES['photo']['tmp_name'];
   $role = $_POST['role'];


   if($password == $cpassword){
    //image move inside folder
        move_uploaded_file($tmp_name, "../uploads/$image");
        // data store into database
        $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, password, address, photo, role, status, votes)
         VALUES('$name', ' $mobile', '$password', '$address', '$image','$role', 0, 0)");
         if($insert){
            echo '
    <script>
    alert("Registration Succesful!");
    window.location = "../";
    </script>
    ';
  }
  else{
    echo '
    <script>
    alert("Some error Occured");
    window.location = "../register.html";
    </script>
    ';
  }
   }
   else{
    // return to register page
    echo '
    <script>
    alert("Password and confirm Password does not match!");
    window.location = "../routes/register.html";
    </script>
    ';
   }


?>