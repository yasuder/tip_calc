<?php
## Erika Yasuda
## Tip calculator that accepts a subtotal, a tip percent (options or custom percentage) and an optional split feature to split the total cost and tip between any specified number of people. 
## 5 January 2017
?>
<!DOCTYPE html<html>
<head>
	<title>Tip Calculator</title>
	<link rel="stylesheet" type="text/css" href="tipcal.css">
</head>
<body>
	<h1>Tip Calculator</h1>
			<form name="input" action="" method="post">
				<!-- Asks for user to input subtotal cost -->
	  			Bill subtotal $<input type="text" name="cost" id="cost" style=<?php echo $color ?> value=<?php if(isset($_POST['cost'])) { echo $_POST['cost']; }?>><br>

	  			<!-- Asks for user to select a tip with radio buttons or input a custom tip percentage into the text box -->
				<p>Tip Percentage</p>
				<?php
				for($i = 10; $i < 21; $i+=5) {
				?>
					<input type="radio" name="tipval" value=<?=$i / 100?>> <?=$i?>%
				<?php
				}
				?>
				<input type="radio" name="tipval" value=0> Custom: <input type="text" id="custom" name="custom" value=<?php if(isset($_POST['custom'])) { echo $_POST['custom']; }?>>% <br>

				<!-- Optional feature which allows users to split the total tip and cost by any specified number of people -->
				Split: <input type="text" name="split" id="split" value=<?php if(isset($_POST['split'])) { echo $_POST['split']; }?>> person(s)<br>

				<!-- Submission button to submit form information -->
				<input type="submit" name="submit" value="Submit">

			<?php 
				## Calculating and setting tip value and total value depending on the subtotal and tip percentage selected by the user
				## Will print the respective values if all required forms are filled in and any submitted forms contain acceptable values
				if (empty($_POST['cost'])) {
					$color = 'background-color: red';
				} else { 
					if($_POST['tipval'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['tipval'], 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['tipval']), 2, '.', '');
					} else if($_POST['custom'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['custom']/100, 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['custom']/100), 2, '.', '');
					}
					?>
						<!-- Total Tip and Total Cost to display -->
						<div id="result" style="display: hide" >
						<div>Tip: $<?php echo $tip ?></div>
						<div>Total: $<?php echo $total ?></div>
					<?php

					## Individual tips and totals each member must pay if the split is greater than or equal to 2 persons
					if(!empty($_POST['split'])) {
						if($_POST['split'] > 1) {
						?>
							<div>Tip Each: $<?php echo number_format((float)$tip / $_POST['split'], 2, '.', '') ?> </div>
							<div>Total Each: $<?php echo number_format((float)$total / $_POST['split'], 2, '.', '') ?></div>
						<?php
						}
					}
				}
			?>
			</form>
</body>
</html>