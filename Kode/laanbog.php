<?php
	$message ="";
	
	if(isset($_POST['email']) && isset($_POST['bognr']) && !empty($_POST['bognr']) && !empty($_POST['email'])) {
		$email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
		$bognr = mysqli_real_escape_string($conn, strtolower($_POST['bognr']));

		$sqlSelect = "SELECT * FROM udlaan NATURAL JOIN bog WHERE Afleveret = 0 AND boID = '$bognr'";
  		$result = mysqli_query($conn, $sqlSelect);

  			if (mysqli_num_rows($result) < 1) {

				$sqlSelect2 = "SELECT * FROM bog WHERE Deaktiveret = 0 AND boID = '$bognr'";
  				$result2 = mysqli_query($conn, $sqlSelect2);

  				if (mysqli_num_rows($result2) > 0) {

	  				$sqlSelect3 = "SELECT bID FROM brugere WHERE Mail = '$email'";
  					$result3 = mysqli_query($conn, $sqlSelect3);

  					if (mysqli_num_rows($result3) > 0) {
  						while($row = mysqli_fetch_assoc($result3)) {
  							$bID = $row['bID'];
		    				$sqlInsert = "INSERT INTO udlaan (boID, bID) VALUES ('$bognr', '$bID')";

			    			if (mysqli_query($conn, $sqlInsert)) {
    							$message = "Lånet er nu registreret.";
    						}
    						else {
    							$message = "Bogen til det indtastede bognummer, findes ikke i systemet.";
    						}
        				
	    				}
  					}
  					else {
  						$message = "Den indtastede mail er ikke registreret.";
	  				}
	  			}
	  			else {
	  				$message = "Bogen findes ikke.";
	  			}
			}
			else {
    			$message = "Bogen er allerede udlånt.";
			}
		
		mysqli_close($conn);
	}
?>

<div class="content">
	<h1>Lån bog</h1>
	<form action="forside.php?content=laanbog" method="post">
		Din email:
		<input type="text" name="email">
		Bog nummer:
		<input type="text" name="bognr">
		<br>
		<input class="button" type="submit" value="Lån">
	</form>
	<?php
		echo $message;
	?>
</div>