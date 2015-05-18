<?php
	$messagereg ="";
	
	if(isset($_POST['forfatterreg']) && isset($_POST['titelreg']) && !empty($_POST['titelreg']) && !empty($_POST['forfatterreg'])) {
		$forfatterreg = mysqli_real_escape_string($conn, strtolower($_POST['forfatterreg']));
		$titelreg = mysqli_real_escape_string($conn, strtolower($_POST['titelreg']));

		$sqlInsert = "INSERT INTO bog (Forfatter, Titel) VALUES ('$forfatterreg', '$titelreg')";

    	if (mysqli_query($conn, $sqlInsert)) {
    		$bognr = mysqli_insert_id($conn);
    		$messagereg = "Bogen er nu registreret, med id nummeret: $bognr. Husk at notere dette i bogen.";
    	}
    	else {
    		$messagereg = "Error: " . $sqlInsert . "<br>" . $conn->error;
    	}		
		mysqli_close($conn);
	}
?>

<?php
	$messageslet ="";
	
	if(isset($_POST['bognr']) && !empty($_POST['bognr'])) {
		$bognr = mysqli_real_escape_string($conn, strtolower($_POST['bognr']));

		$sqlSelect = "SELECT * FROM bog WHERE boID = '$bognr' AND Deaktiveret = 0";
		$result = mysqli_query($conn, $sqlSelect);

  			if (mysqli_num_rows($result) > 0) {
  				$sqlUpdate = "UPDATE bog SET Deaktiveret = 1 WHERE boID = '$bognr'";
  				$result2 = mysqli_query($conn, $sqlUpdate);

  					if ($result2) {
  						$messageslet = "Bogen er nu slettet";
  					}
  					else {
  						$messageslet = "Error updating record: " . mysqli_error($conn);
  					}    	    			
    		}
    		else {
    			$messageslet = "Den indtastede bog findes ikke eller allerede slettet.";
    		}

		mysqli_close($conn);
	}
?>

<div class="content">
	<h1>Registrer bog</h1>
	<form action="forside.php?content=administrerbog" method="post">
		Forfatter:
		<input type="text" name="forfatterreg">
		Titel:
		<input type="text" name="titelreg">
		<br>
		<input class="button" type="submit" value="Registrer">
	</form>
	<?php
		echo $messagereg;
	?>
</div>

<div class="content">
	<h1>Slet bog</h1>
	<form action="forside.php?content=administrerbog" method="post">
		Bog nummer:
		<input type="text" name="bognr">
		<br>
		<input class="button" type="submit" value="Slet">
	</form>
	<?php
		echo $messageslet;
	?>
</div>