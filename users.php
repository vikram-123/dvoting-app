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
    <title>Users</title>
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
	<div class="col l10 s12 offset-l1">
		<h3>Users:</h3>	
			<table class="highlight centered">
				<thead>
					<tr>
						<th>Aadhar No.</th>
						<th>E-mail</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Position</th>
					</tr>
				</thead>
			<tbody>
			<?php
			include 'sql.php';

			$SQL = "SELECT * FROM user_info";
			$result = mysqli_query($db_handle, $SQL);
			while ($db_field = mysqli_fetch_assoc($result)) {
				$a = $db_field['aadhar_no'];
				$b = $db_field['email'];
				$c = $db_field['fname'];
				$d = $db_field['lname'];
				$e = $db_field['position'];
				print("<tr><td><b>$a</b></td><td>$b</td><td>$c</td><td>$d</td><td>$e</td></tr>");
			}
			mysqli_close($db_handle);
			?>
			</tbody>
		</table>
	</div>
</div>
</main>
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</body>
</html>
