<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
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
				<li <?php if ($_REQUEST['content']=="administrerbog") { ?>class="active"<?php } ?>><a href="forside.php?content=administrerbog">Administrer bog</a></li>
				<li <?php if ($_REQUEST['content']=="administrerbruger") { ?>class="active"<?php } ?>><a href="forside.php?content=administrerbruger">Administrer bruger</a></li>
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
				case "administrerbog":		
					include('administrerbog.php');
					break;	
				case "administrerbruger":		
					include('administrerbruger.php');
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