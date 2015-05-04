<?php
	$message ="";
	
	if(isset($_POST['forfatter']) && isset($_POST['titel']) && !empty($_POST['titel']) && !empty($_POST['forfatter'])) {
		$forfatter = mysqli_real_escape_string($conn, strtolower($_POST['forfatter']));
		$titel = mysqli_real_escape_string($conn, strtolower($_POST['titel']));

		$sqlInsert = "INSERT INTO bog (Forfatter, Titel) VALUES ('$forfatter', '$titel')";

    	if (mysqli_query($conn, $sqlInsert)) {
    		$bognr = mysqli_insert_id($conn);
    		$message = "Bogen er nu registreret, med id nummeret: $bognr. Husk at notere dette i bogen.";
    	}
    	else {
    		$message = "Error: " . $sqlInsert . "<br>" . $conn->error;
    	}		
		mysqli_close($conn);
	}
?>

<div class="content">
	<h1>Registrer bog</h1>
	<form action="forside.php?content=regbog" method="post">
		Forfatter:
		<input type="text" name="forfatter">
		Titel:
		<input type="text" name="titel">
		<br>
		<input class="button" type="submit" value="Registrer">
	</form>
	<?php
		echo $message;
	?>
</div>