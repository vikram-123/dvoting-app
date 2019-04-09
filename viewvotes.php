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
    <title>Election Votes</title>
</head>
<body>
	<header>
		<div class="navbar-fixed">
		<nav class="indigo darken-3">
		    <div class="nav-wrapper">
		      <a href="#" class="brand-logo"><img src="images/dvoting_logo.png" height="65"></a>
		      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		      <ul class="right hide-on-med-and-down">
			<li><a href="admin.php">Admin Panel</a></li>
		        <li><a href="index.php">Logout</a></li>
		      </ul>
		    </div>
  		</nav>
  		</div>
	  	<ul class="sidenav" id="mobile-demo">
		<li><a href="admin.php">Admin Panel</a></li>
	    	<li><a href="index.php">Logout</a></li>
	  	</ul>
	</header>
<main>
<br />
<br />
<div class="row">
<div class="section col l5 s12 offset-l3">
<table class="highlight centered">
	<thead>
		<tr>
			<th>Candidates</th>
			<th>Votes</th>
		</tr>
	</thead>
	<tbody>
<?php
  include 'sql.php';

  print("<h3>".$_POST['elname']."</h3>");
  $el=$_POST['elname'];

  $SQL = "SELECT * FROM $el";
  $result = mysqli_query($db_handle, $SQL);
  
  while ($db_field = mysqli_fetch_assoc($result)) 
  {
	$lname = $db_field['username'];
	$votes = $db_field['votes'];
	print("<tr><td><b>$lname</b></td><td>$votes</td></tr>");
  }
?>
</tbody>
</table>
</div>
</div>
</main>
</body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</html>
