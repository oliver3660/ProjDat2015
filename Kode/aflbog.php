<?php
	$message ="";
	
	if(isset($_POST['email']) && isset($_POST['bognr']) && !empty($_POST['bognr']) && !empty($_POST['email'])) {
		$email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
		$bognr = mysqli_real_escape_string($conn, strtolower($_POST['bognr']));

		$sqlSelect = "SELECT bID FROM brugere WHERE Mail = '$email'";
  		$result = mysqli_query($conn, $sqlSelect);

  			if (mysqli_num_rows($result) > 0) {
  				while($row = mysqli_fetch_assoc($result)) {
  					$bID = $row['bID'];
    			}
    			$sqlSelect2 = "SELECT * FROM udlaan WHERE boID = '$bognr' AND bID = '$bID' AND Afleveret = 0";
    			$result2 = mysqli_query($conn, $sqlSelect2);

    			if(mysqli_num_rows($result2) > 0) {
    				$sqlUpdate = "UPDATE udlaan SET Afleveret = 1 WHERE (boID = '$bognr' AND bID = '$bID' AND Afleveret = 0)";
  					$result3 = mysqli_query($conn, $sqlUpdate);

  					if ($result3) {
  						$message = "Bogen er nu afleveret";
  					}
  					else {
  						$message = "Error updating record: " . mysqli_error($conn);
  					}
    			}
    			else {
    				$message = "Du har ikke lånt denne bog, kontakt admin.";
    			}

			}
			else {
    			$message = "Den indtastede mail, findes ikke i systemet.";
			}
		
		mysqli_close($conn);
	}
?>

<div class="content">
	<h1>Aflever bog</h1>
	<form action="forside.php?content=aflbog" method="post">
		Din email:
		<input type="text" name="email">
		Bog nummer:
		<input type="text" name="bognr">
		<br>
		<input class="button" type="submit" value="Aflever">
	</form>
	<?php
		echo $message;
	?>
</div>