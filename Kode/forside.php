<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "bibliotek";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Bibliotek</title>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>

	<body>
		<div id="menu">
			<ul>
				<li <?php if ($_REQUEST['content']=="forside") { ?>class="active"<?php } ?>><a href="forside.php?content=forside">Forside</a></li>
				<li <?php if ($_REQUEST['content']=="laanbog") { ?>class="active"<?php } ?>><a href="forside.php?content=laanbog">Lån bog</a></li>
				<li <?php if ($_REQUEST['content']=="aflbog") { ?>class="active"<?php } ?>><a href="forside.php?content=aflbog">Aflever bog</a></li>
				<li <?php if ($_REQUEST['content']=="regbog") { ?>class="active"<?php } ?>><a href="forside.php?content=regbog">Registrer bog</a></li>
				<li <?php if ($_REQUEST['content']=="regbruger") { ?>class="active"<?php } ?>><a href="forside.php?content=regbruger">Registrer bruger</a></li>
				<li <?php if ($_REQUEST['content']=="rykker") { ?>class="active"<?php } ?>><a href="forside.php?content=rykker">Rykkere</a></li>
			</ul>
		</div>

		<?php
			switch ($_REQUEST['content']) {
				case "laanbog":
					include('laanbog.php');
					break;
				case "forside":		
					include('velkommen.php');
					break;
				case "aflbog":		
					include('aflbog.php');
					break;
				case "regbog":		
					include('regbog.php');
					break;	
				case "regbruger":		
					include('regbruger.php');
					break;
				case "rykker":		
					include('rykker.php');
					break;
				default:
					echo "error";
			}
		?>
	</body>
</html>