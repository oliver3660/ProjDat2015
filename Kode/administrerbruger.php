<?php
	$messagereg ="";
	
	if(isset($_POST['emailreg']) && isset($_POST['navn']) && !empty($_POST['navn']) && !empty($_POST['emailreg'])) {
		$emailreg = strtolower($_POST['emailreg']);
		$navn = mysqli_real_escape_string($conn, strtolower($_POST['navn']));

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$messagereg = "$emailreg er ikke en gyldig e-mail.";
		} 
		else {
  			$sqlSelect = "SELECT Mail FROM brugere WHERE Mail = '$emailreg'";
  			$result = mysqli_query($conn, $sqlSelect);

  			if (mysqli_num_rows($result) < 1) {
    			$sqlInsert = "INSERT INTO brugere (Mail, Navn) VALUES ('$emailreg', '$navn')";

    			if (mysqli_query($conn, $sqlInsert)) {
    				$messagereg = "Brugeren er nu registreret.";
    			}
    			else {
    				$messagereg = "Error: " . $sqlInsert . "<br>" . $conn->error;
    			}
			}
			else {
    			$messagereg = "Denne mail er allerede registreret.";
			}
		}
		mysqli_close($conn);
	}
?>

<?php
	$messageslet ="";
	
	if(isset($_POST['emailslet']) && !empty($_POST['emailslet'])) {
		$emailslet = strtolower($_POST['emailslet']);

		if (!filter_var($emailslet, FILTER_VALIDATE_EMAIL)) {
  			$messageslet = "$emailslet er ikke en gyldig e-mail.";
		} 
		else {
  			$sqlUpdate = "UPDATE brugere SET Mail = NULL, Navn = NULL WHERE Mail = '$emailslet'";
  			$result = mysqli_query($conn, $sqlUpdate);

  			if ($result) {
  				$messageslet = "Brugeren er slettet.";
  			}

			else {
    			$messageslet = "Error updating record: " . mysqli_error($conn);
			}
		}
		mysqli_close($conn);
	}
?>

<div class="content">
	<h1>Registrer bruger</h1>
	<form action="forside.php?content=administrerbruger" method="post">
		Din email:
		<input type="text" name="emailreg">
		Navn:
		<input type="text" name="navn">
		<br>
		<input class="button" type="submit" value="Registrer">
	</form>
	<?php
		echo $messagereg;
	?>
</div>

<div class="content">
	<h1>Slet bruger</h1>
	<form action="forside.php?content=administrerbruger" method="post">
		Din email:
		<input type="text" name="emailslet">
		<br>
		<input class="button" type="submit" value="Slet">
	</form>
	<?php
		echo $messageslet;
	?>
</div>