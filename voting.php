<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['user'];
if ($log != "log"){
	header ("Location: index.php");
}
$_SESSION['elec'] = $_POST['election_name'];
?>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <title>Voting Page</title>
</head>
<body>
	<header>
		<div class="navbar-fixed">
		<nav class="indigo darken-3">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo"><img src="images/dvoting_logo.png" height="65"></a>
		      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		        <li><a href="index.php">Logout</a></li>
		      </ul>
		    </div>
  		</nav>
  		</div>
	  	<ul class="sidenav" id="mobile-demo">
	    	<li><a href="index.php">Logout</a></li>
	  	</ul>
	</header>
<main>
<div class="row">
<div class="section col l5 s12 offset-l3">
<table class="highlight centered">
	<thead>
		<tr>
			<th>Candidates</th>
		</tr>
	</thead>
	<tbody>
<!-- For Contract Address and Election info--> 
<?php
  include 'sql.php';
  $exist=false;
  print("<input name='svradr' id='server_address' type='hidden' value=".$_POST['adr']." />");
  print("<h3>".$_POST['election_name']."</h3>");
  $el=$_POST['election_name'];

  //checking if user has already voted
  $SQL = "SELECT * FROM voting_details";
  $result = mysqli_query($db_handle, $SQL);
  while ($db_field = mysqli_fetch_assoc($result)) {
	if ($user == $db_field['aadhar_no'] && $el == $db_field['election'] && $db_field['voted']=='1'){
			$exist = true;
			break;
		}
	}
  if ($exist){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Already Voted !')</script><script>location.href = 'dashboard.php'</script>");
		mysqli_close($db_handle);
	}

else
{
  $SQL = "SELECT * FROM $el";
  $result = mysqli_query($db_handle, $SQL);
				/*counter
				$COMASQL = "SELECT count(*) FROM $a";
				$comaresult = mysqli_query($db_handle, $COMASQL);
				$coma_field = mysqli_fetch_assoc($comaresult);
				$count = $coma_field['count(*)'];
				$count--;*/

 while ($db_field = mysqli_fetch_assoc($result)) 
 {
	$lname = $db_field['username'];
	print("<tr><td>$lname</td></tr>");
 }
}
?>
</tbody>
</table>
<form action="votedone.php" method="post">
<div class='input-field'><input type='text' name='leader' value='' id="candidate" class='validate'><label for="candidate">Enter your choice</label></div>
<a onclick="voteForCandidate()" class="btn btn-primary">Vote</a>
<button class="btn waves-effect waves-light indigo darken-4" type="submit">Submit</button>
</form>
</div>
</div>
</main>
</body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
    <script src="https://cdn.rawgit.com/ethereum/web3.js/develop/dist/web3.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="./index.js"></script>
</html>
