<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: index.php");
}

include 'sql.php';

$SQL = "DELETE FROM election_info WHERE electionname='".$_POST['elname']."'";
$result = mysqli_query($db_handle, $SQL);
mysqli_close($db_handle);
die("<SCRIPT LANGUAGE='JavaScript'>alert('Election Removed !')</script><script>location.href = 'oelection.php'</script>");
?>
