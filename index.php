<?php
session_start();
session_destroy();
$user = "";
$pass = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'sql.php';

	$user = $_POST['uname'];
	$pass = $_POST['pword'];
		
	//unwanted HTML (scripting attacks)
	$user = htmlspecialchars($user);
	$pass = htmlspecialchars($pass);
	
	$SQL = "SELECT * FROM user_info";
	$result = mysqli_query($db_handle, $SQL);
	while ($db_field = mysqli_fetch_assoc($result)) {
		$a = $db_field['aadhar_no'];
		$b = $db_field['password'];
		$pos = $db_field['position'];
		if(($user == $a) AND ($pass == $b)){
			if($pos == "admin"){
				session_start();
				$_SESSION['username'] = $user;
				$_SESSION['admin'] = "log";
				mysqli_close($db_handle);
				header("Location: admin.php");
				break;
			}
			else if($pos == "user"){
				session_start();
				$_SESSION['username'] = $user;
				$_SESSION['user'] = "log";
				mysqli_close($db_handle);
				header("Location: dashboard.php");
				break;
			}
		}
	}
	$msg = "Check aadhar number and/or password.";
	mysqli_close($db_handle);
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
	<title>Home</title>
</head>
<body>
	<header>
		<div class="navbar-fixed">
		<nav class="indigo darken-3">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo"><img src="images/dvoting_logo.png" height="65"></a>
		      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
		        <li class="active"><a href="index.php">Home</a></li>
		        <li><a href="signup.php">Create Account</a></li>
		        <li><a href="about.php">About Us</a></li>
		      </ul>
		    </div>
  		</nav>
  		</div>
	  	<ul class="sidenav" id="mobile-demo">
	    	<li class="active"><a href="index.php">Home</a></li>
	    	<li><a href="signup.php">Create Account</a></li>
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
	<div class="section col l4 s12 offset-l4">
		<div class="card-panel hoverable grey lighten-5">
        <div class="card-content">
          <span class="card-title"><h4>Log In</h4></span>
          <form name='login_form' method='post' action='index.php'>
			<div class="input-field">
		        <input type="text" name="uname" value="" id="user_name" class="validate">
		        <label for="user_name">Aadhar Number</label>
		    </div>
			<div class="input-field">
		        <input type="password" name="pword" value="" id="pass_word" class="validate">
		        <label for="pass_word">Password</label>
		    </div>
			<button class="btn waves-effect waves-light indigo darken-4" type="submit" name="login">LogIn</button>
		<?php
			print "<br /><br /><font color = 'red'><b>".$msg."</b></font>";
		?>
		</form>
        </div>
      </div>
	</div>
</div>
</main>
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</body>
</html>
