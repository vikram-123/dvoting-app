<?php
session_start();
session_destroy();
$msg = "";

include 'sql.php';

if (isset($_POST['register'])) {
	$eadd = $_POST['eadd'];
	$unem = $_POST['unem'];
	$pword = $_POST['pword'];
	$rpword = $_POST['rpword'];
	$fnem = $_POST['fnem'];
	$lnem = $_POST['lnem'];
	
	if(($eadd == "") OR ($unem == "") OR ($fnem == "") OR ($lnem == "")){
		$msg = "Please supply each field.";
	}
	else if($pword != $rpword){
		$msg = "Password did not match.";
	}
	else{
		$SQL = "SELECT * FROM user_info";
		$result = mysqli_query($db_handle, $SQL);
		while ($db_field = mysqli_fetch_assoc($result)) {
			$a = $db_field['aadhar_no'];
			$b = $db_field['email'];
			if($a == $unem){
				$msg = "Aadhar Number is not available.";
				break;
			}
			else if($b == $eadd){
				$msg = "Already registered with this Email address.";
				break;
			}
			else{
				$SQL = "INSERT INTO `user_info`(`email`, `aadhar_no`, `password`, `fname`, `lname`, `position`) VALUES ('$eadd','$unem','$pword','$fnem','$lnem','user')";
				mysqli_query($db_handle, $SQL);
				$msg = "User added.";
			}
		}
	}
}
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
<title>Create Account</title>
</head>
<body>
	<header>
		<div class="navbar-fixed">
		<nav class="indigo darken-3">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo"><img src="images/dvoting_logo.png" height="65"></a>
		      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		        <li><a href="index.php">Home</a></li>
		        <li class="active"><a href="signup.php">Create Account</a></li>
		        <li><a href="about.php">About Us</a></li>
		      </ul>
		    </div>
  		</nav>
  		</div>
	  	<ul class="sidenav" id="mobile-demo">
	    	<li><a href="index.php">Home</a></li>
	    	<li class="active"><a href="signup.php">Create Account</a></li>
	    	<li><a href="about.php">About Us</a></li>
	  	</ul>
	</header>
<main>
<div class="row">
	<div class="section col l11 s12 offset-l1">
       	<span class="flow-text">
	        <h2 class="indigo-text text-darken-2">Decentralized Voting app using Blockchain</h2>
      	</span>
 	</div>
 </div>
	<div class="row center">
	<div class="section col l5 s12 offset-l3">
    	<form method='post' action='signup.php'>
    		<?php
				print "<font color = 'red'><b>$msg</b></font>";
			?>
	        <div class="input-field col s12">
	          <input name="eadd" id="email" type="email" class="validate">
	          <label for="email" data-error="Wrong">Email Address</label>
	        </div>
	        <div class="input-field col s12">
	          <input name="unem" id="user_name" type="text" class="validate">
	          <label for="user_name">Aadhar Number</label>
	        </div>
        	<div class="input-field col s12">
	          	<input name="pword" id="pass_word" type="password" class="validate">
	          	<label for="pass_word">Password</label>
	        </div>
	        <div class="input-field col s12">
	          <input name="rpword" id="rpass_word" type="password" class="validate">
	          <label for="rpass_word">Retype Password</label>
	        </div>
		    <div class="input-field col s6">
		        <input name="fnem" id="first_name" type="text" class="validate">
		        <label for="first_name">First Name</label>
		    </div>
	        <div class="input-field col s6">
	          <input name="lnem" id="last_name" type="text" class="validate">
	          <label for="last_name">Last Name</label>
	        </div>
	        <br /><br />
	        <button class="btn waves-effect waves-light cyan darken-1" type="reset" name="cancel">Clear</button>
			<button class="btn waves-effect waves-light blue" type="submit" name="register">Register</button>
    	</form>
  	</div>
</div>
</main>
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</body>
</html>
