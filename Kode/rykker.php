<?php
	$message2 ="";
	if (isset($_POST['ryk'])) {
		$ryk = $_POST['ryk'];

		if(!empty($ryk)) {
			$n = count($ryk);

			for($i=0; $i < $n; $i++) {
				$exp = explode(':', $ryk[$i]);

				if(empty($exp[1])) {

					$sqlInsert = "INSERT INTO rykker (uID) VALUES ('$exp[0]')";

					if (!mysqli_query($conn, $sqlInsert)) {
    					$message = "Error: " . $sqlInsert . "<br>" . $conn->error;
    				}
				}
				else {
					$sqlUpdate = "UPDATE rykker SET Antal = Antal + 1 WHERE rID = '$exp[1]'";

					if (!mysqli_query($conn, $sqlUpdate)) {
    					echo "Error updating record: " . mysqli_error($conn);
					}
				}
			}
			$message2 = "Der er blevet sendt $n rykker(e).";
		}
	}

?>

<div class="content">
	<h1>Rykkere</h1>
	<form action="forside.php?content=rykker" method="post">
		<?php
			$message ="";

			$sqlSelect = "SELECT Navn, Titel, udato, rdato, Antal, udlaan.uID, rID
						  FROM udlaan NATURAL JOIN brugere NATURAL JOIN bog LEFT JOIN rykker
						  ON udlaan.uID = rykker.uID
						  WHERE (Afleveret = 0 AND (TIMESTAMPDIFF(DAY, udato, NOW()) > 30) AND rdato is NULL)
						  OR (Afleveret = 0 AND (TIMESTAMPDIFF(DAY, rdato, NOW()) > 14))";
			$result = mysqli_query($conn, $sqlSelect);

			if (mysqli_num_rows($result) > 0) {
				?>
				<table id="rykkerTabel" cellspacing="40" rules="rows">
					<tr>
						<th>Send</th>
					    <th>Navn</th>
					    <th>Titel</th>
					    <th>Udlåns dato</th>
					    <th>Sidste rykker sendt</th>
					    <th>Antal rykkere sendt</th>
		  			</tr>
		  		<?php
  					while($row = mysqli_fetch_assoc($result)) {
  						?>
  						<tr>
		  					<td><input type="checkbox" name="ryk[]" value="<?php print $row['uID'] . ':' . $row['rID'];?>"></input></td>
		    				<td><?php print $row['Navn'];?></td>
		    				<td><?php print $row['Titel'];?></td> 
		    				<td><?php print $row['udato'];?></td>
		    				<td><?php if(empty($row['rdato'])) { print "Ingen";} else {print $row['rdato'];}?></td>
		    				<td><?php if(empty($row['Antal'])) { print "0";} else {print $row['Antal'];}?></td>
		  				</tr>
  					<?php }
  					?> </table>
  					<br/>
					<input class="button" type="submit" value="Send rykkere"></input>
  					<?php
			}

			else {
				$message = "Ingen udlån er overskredet.";
			}
		?>
	</form>
	<?php
		echo $message . "<br/>";
		echo $message2;
	?>
</div>