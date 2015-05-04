<?php
	$message ="";
	
	if(isset($_POST['email']) && isset($_POST['navn']) && !empty($_POST['navn']) && !empty($_POST['email'])) {
		$email = strtolower($_POST['email']);
		$navn = mysqli_real_escape_string($conn, strtolower($_POST['navn']));

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$message = "$email is not a valid email address";
		} 
		else {
  			$sqlSelect = "SELECT Mail FROM brugere WHERE Mail = '$email'";
  			$result = mysqli_query($conn, $sqlSelect);

  			if (mysqli_num_rows($result) < 1) {
    			$sqlInsert = "INSERT INTO brugere (Mail, Navn) VALUES ('$email', '$navn')";

    			if (mysqli_query($conn, $sqlInsert)) {
    				$message = "Brugeren er nu registreret.";
    			}
    			else {
    				$message = "Error: " . $sqlInsert . "<br>" . $conn->error;
    			}
			}
			else {
    			$message = "Denne mail er allerede registreret.";
			}
		}
		mysqli_close($conn);
	}
?>
<div class="content">
	<h1>Registrer bruger</h1>
	<form action="forside.php?content=regbruger" method="post">
		Din email:
		<input type="text" name="email">
		Navn:
		<input type="text" name="navn">
		<br>
		<input class="button" type="submit" value="Registrer">
	</form>
	<?php
		echo $message;
	?>
</div>