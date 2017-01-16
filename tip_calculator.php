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
	  			Bill subtotal $<input type="text" name="cost" id="cost" value=<?php if(isset($_POST['cost'])) { echo $_POST['cost']; } else { echo 20;} ?>><br>

	  			<!-- Asks for user to select a tip with radio buttons or input a custom tip percentage into the text box -->
				<p id="tipform">Tip Percentage</p>
				<?php
				for($i = 10; $i < 21; $i+=5) {
				?>
					<input type="radio" name="tipval" value=<?=$i / 100?> <?php if (isset($_POST['tipval']) && $_POST['tipval'] == $i / 100) echo ' checked="checked"'?>> <?=$i?>%
				<?php
				}
				?>
				<input type="radio" name="tipval" <?php if (isset($_POST['custom']) && $_POST['tipval'] == 0) echo ' checked="checked"'?> value=0> Custom: <input type="text" id="custom" name="custom" value=<?php if(isset($_POST['custom'])) { echo $_POST['custom']; } else { echo 10;} ?> >% <br>

				<!-- Optional feature which allows users to split the total tip and cost by any specified number of people -->
				Split: <input type="text" name="split" id="split" value=<?php if(isset($_POST['split'])) { echo $_POST['split']; } else { echo 2; }?>> person(s)<br>

				<!-- Submission button to submit form information -->
				<input type="submit" name="submit" value="Submit">

			<?php 
				## Calculating and setting tip value and total value depending on the subtotal and tip percentage selected by the user
				## Will print the respective values if all required forms are filled in and any submitted forms contain acceptable values
				if (isset($_POST['cost']) && !empty($_POST['cost']) && is_numeric( $_POST['cost']) && $_POST['cost'] > 0) {
					if($_POST['tipval'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['tipval'], 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['tipval']), 2, '.', '');
					} else if(isset($_POST['custom']) && $_POST['custom'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['custom']/100, 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['custom']/100), 2, '.', '');
					}

					if($_POST['tipval'] > 0 || ($_POST['tipval'] == 0 && $_POST['custom'] > 0)) { 
					?>
						<!-- Total Tip and Total Cost to display -->
						<div id="result" style="display: hide" >
							<div>Tip: $<?php echo $tip ?></div>
							<div>Total: $<?php echo $total ?></div>
					<?php
					} else if(!isset($_POST['tipval'])) {
						?>
						<div class="error">!! You must select a tip percentage value !!</div>
					<?php
					} else if(empty($_POST['custom']) || $_POST['custom'] < 0 || !is_numeric($_POST['custom'])) {
						?>
						<div class="error">!! You must enter a valid custom tip value !!</div>
						<?php
						$_POST['custom'] = 10;
					}

						## Individual tips and totals each member must pay if the split is greater than or equal to 2 persons
					if(!empty($_POST['split']) || $_POST['split'] < 0) {
						if($_POST['split'] > 1) {
						?>
							<div>Tip Each: $<?php echo number_format((float)$tip / $_POST['split'], 2, '.', '') ?> </div>
							<div>Total Each: $<?php echo number_format((float)$total / $_POST['split'], 2, '.', '') ?></div>
						</div>
						<?php
						} else {
							?>
							<div class="error">!! You must input a valid value to split the bill by !!</div>
							<?php
							$_POST['split'] = 2;
						}
					}
				} else if((isset($_POST['cost']) && empty($_POST['cost'])) || (isset($_POST['cost']) && !empty($_POST['cost']) && !is_numeric($_POST['cost'])) || (isset($_POST['cost']) && !empty($_POST['cost']) && is_numeric($_POST['cost']) && $_POST['cost'] < 0)){
					?>
					<div class="error">!! You must input a valid bill subtotal !!</div>
					<?php
					$_POST['cost'] = 10.00;
				}
			?>
			</form>
</body>
</html>