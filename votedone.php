<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['user'];
if ($log != "log"){
	header ("Location: index.php");
}
$ename= $_SESSION['elec'];
$cand= $_POST['leader'];
include 'sql.php';
$SQL="INSERT INTO `voting_details`(`aadhar_no`, `election`, `voted`) VALUES ('$user','$ename','1')";
$result = mysqli_query($db_handle, $SQL);
$SQL="UPDATE $ename SET votes=votes+1 WHERE username='$cand'";
$result = mysqli_query($db_handle, $SQL);
mysqli_close($db_handle);
die("<SCRIPT LANGUAGE='JavaScript'>alert('Voting Done')</script><script>location.href = 'index.php'</script>");
?>
