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
    <title>Ongoing Elections</title>
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
	<div class="section col l8 s12 offset-l2">
		<h3>Elections:</h3>	
		<table class="highlight centered">
			<thead>
				<tr>
					<th>Election Name</th>
					<th>Candidates</th>
				</tr>
			</thead>
			<tbody>
			<?php
			include 'sql.php';

			$SQL = "SELECT * FROM election_info";
			$result = mysqli_query($db_handle, $SQL);
			while ($db_field = mysqli_fetch_assoc($result)) {
				$a = $db_field['electionname'];
				$b = $db_field['candidates'];
				print("<tr><td><b>$a</b></td><td>$b</td>");
				print("<td><a title='Open' href='app://' class='btn btn-primary'>Start User Voting</a></td>");
				print("<form method='post' action='viewvotes.php'><td><button class='btn waves-effect waves-light blue' name = 'view' type = 'submit'>View Votes</button></td><input type='hidden' name='elname' value='$a' /></form>");
				print("<form method='post' action='delelec.php'><td><button class='btn waves-effect waves-light blue' name = 'delete' type = 'submit'>Delete</button></td><input type='hidden' name='elname' value='$a' /></form>");
				print("</tr>");
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
