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
    <title>View Votes</title>
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
<div class="row">
	<div class="section col l10 s12 offset-l1">
		<h3>Elections:</h3>	
		<table class="highlight centered">
			<thead>
				<tr>
					<th>Election Name</th>
					<th>Candidates</th>
					<th>Deploy this contract in your terminal</th>
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
				$count=1;
				print("<tr><td id='elec_name'><b>$a</b></td><td>$b</td>");
				print("<form method='post' action='viewvotes.php'><td><p style='text-align:left;'>~ require('./client.js');<br />~ deployedContract = VotingContract.new([");
				$SUBSQL = "SELECT * FROM $a";
				$subresult = mysqli_query($db_handle, $SUBSQL);
				//comma counter
				$COMASQL = "SELECT count(*) FROM $a";
				$comaresult = mysqli_query($db_handle, $COMASQL);
				$coma_field = mysqli_fetch_assoc($comaresult);
				$count = $coma_field['count(*)'];
				$count--;

				while ($subdb_field = mysqli_fetch_assoc($subresult)) 
				{
					$lname = $subdb_field['username'];
					print("'$lname'");
					if($count !=0)
					{ 
						print(",");
						$count--;
					}
				}
			print("],{data: byteCode, from: web3.eth.accounts[0], gas: 4700000});<br />~ deployedContract.address;</p><div class='input-field'><input type='text' name='adr' value='' id='svr_adr' class='validate'><label for='svr_adr'>Enter deployed contract address</label></div><a title='Open' href='ap://' class='btn btn-primary'>Open terminal</a></td>");
				print("<td><input type='hidden' name='election_name' value='$a' /><button class='btn waves-effect waves-light blue' id='vote' type = 'submit'>Proceed</button></td></form></tr>");
				$count++;
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
