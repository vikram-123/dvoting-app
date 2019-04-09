<?php
session_start();
$user = $_SESSION['username'];
$log = $_SESSION['admin'];
if ($log != "log"){
	header ("Location: index.php");
}
if (isset($_POST['conduct']))
{

$exist = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	include 'sql.php';
	
	$election = $_POST['ename'];
	$candidates = $_POST['unum'];
	if($election == ''){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Please enter Election Name!')</script><script>location.href = 'celection.php'</script>");
	}
		
	$SQL = "SELECT * FROM election_info";
	$result = mysqli_query($db_handle, $SQL);
	while ($db_field = mysqli_fetch_assoc($result)) {
		if ($election == $db_field['electionname']){
			$exist = true;
			break;
		}
	}

	if ($exist){
		die("<SCRIPT LANGUAGE='JavaScript'>alert('Election is already in progress!')</script><script>location.href = 'celection.php'</script>");
		mysqli_close($db_handle);
	}
	else{
		$SQL = "CREATE TABLE $election (username VARCHAR(50) NOT NULL,votes VARCHAR(50))";
		mysqli_query($db_handle, $SQL);
		$count=1;
		while($count <= $candidates)
		{
			$name=$_POST['lname'.$count];
			$SQL = "INSERT INTO $election VALUES ('$name','0')";
			mysqli_query($db_handle, $SQL);
			$count++;
		}

		$SQL = "INSERT INTO election_info VALUES ('$election','$candidates')";
		mysqli_query($db_handle, $SQL);
		mysqli_close($db_handle);
	}
}
	header('location: oelection.php');
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
    <title>Conduct Election</title>
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
<div class="row center">
	<div class="section col l6 s12 offset-l3">
		<div class="card-panel hoverable grey lighten-5">
        	<div class="card-content">
	          <span class="card-title"><h4>Conduct Election</h4></span>
	          <form name='celection_form' method='post' action='celection.php'>
	          	<div class="input-field">
			        <?php if (isset($_POST['proceed']))
			        { print("<input type='text' name='ename' value='".$_POST['ename']."' id='e_name' class='validate'><label for='e_name'>Enter name for election</label>"); }
			        else
			        {
			        	print("<input type='text' name='ename' value='' id='e_name' class='validate'><label for='e_name'>Enter name for election</label>");
			        }
			        ?>
			    </div>
				<div class="input-field">
			        <?php if (isset($_POST['proceed']))
			        { print("<input type='text' name='unum' value='".$_POST['unum']."' id='user_num' class='validate'><label for='user_num'>Enter number of candidates</label>"); }
			        else
			        {
			        	print("<input type='text' name='unum' value='' id='user_num' class='validate'><label for='user_num'>Enter number of candidates</label>");
			        }
			        ?>
			    </div>
				<button class="btn waves-effect waves-light blue" type="submit" name="proceed">Proceed</button>
				<?php
				if (isset($_POST['proceed']) && $_POST['unum'] != '')
				{
					$num=1;
					while($num <= $_POST['unum'])
					{
						print("<div class='input-field'><input type='text' name='lname".$num."' value='' id='l_name".$num."' class='validate'><label for='l_name".$num."'>Enter name of candidate ".$num."</label></div>");
						$num++;
					}
					print("<button class='btn waves-effect waves-light indigo darken-4' type='submit' name='conduct'>Conduct</button>");
 				}
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
