<?php

session_start();
include('connect.php');

$votes = $_POST['gvotes'];  // previous vote
$total_votes = $votes+1;
$gid = $_POST['gid']; // jiski id rahegi usko vote jayega
$uid = $_SESSION['userdata']['id']; // kisne vote diya

$update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$gid' "); // update vote
$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid' ");  // update user status

if($update_votes and $update_user_status){
    // fetch data
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2 ");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    //update session data
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
    alert("Voting successfull!");
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
else{
    echo '
    <script>
    alert("some error occured!");
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
?>
