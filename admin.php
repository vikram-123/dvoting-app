<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: index.php");
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
	<title>Admin Panel</title>
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
	<div class="section col l11 s12 offset-l1">
	    <br />
	    <br />
	    <div id="features">
	        <div class="row">
	            <div class="col s12 m3">
	               	<div class="card card-avatar">
	                    <div class="waves-effect waves-block waves-light">
	                      <img class="activator" src="images/view_user.png">
	                    </div>
	                    <div class="card-content">
	                    	<button onclick="location.href = 'users.php';" class="btn waves-effect waves-light blue" type="submit" name="users">View Users</button>
	                    </div>
	                </div>
	            </div>
	            <div class="col s12 m3">
	                <div class="card card-avatar">
	                    <div class="waves-effect waves-block waves-light">
	                      <img class="activator" src="images/conductelection.png">
	                    </div>
	                    <div class="card-content">
	                    	<button onclick="location.href = 'celection.php';" class="btn waves-effect waves-light blue" type="submit" name="election">Conduct Election</button>
	                    </div>
	                 </div>
	            </div>
	            <div class="col s12 m3">
	                <div class="card card-avatar">
	                    <div class="waves-effect waves-block waves-light">
	                      <img class="activator" src="images/ongoingelections.png">
	                    </div>
	                    <div class="card-content">
	                    	<button onclick="location.href = 'oelection.php';" class="btn waves-effect waves-light blue" type="submit" name="onelection">Ongoing Elections</button>
	               	 	</div>
	                </div>
	            </div>
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
