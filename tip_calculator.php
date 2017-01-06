<!DOCTYPE html<html>
<head>
	<title>Tip Calculator</title>
	<link rel="stylesheet" type="text/css" href="tipcal.css">
</head>
<body>
	<h1>Tip Calculator</h1>
			<form name="input" action="" method="post">
	  			Bill subtotal $<input type="text" name="cost"><br>
				<p>Tip Percentage</p>
				<?php
				for($i = 10; $i < 26; $i+=5) {
					if($i == 10) {
					?>
						<input type="radio" name="tipval" value=<?=$i / 100?> checked="true" > <?=$i?>%
					<?php
					} else if($i != 25) {
					?>
						<input type="radio" name="tipval" value=<?=$i / 100?>> <?=$i?>%
					<?php
					} else {
					?>
						<input type="radio" name="tipval"> Custom: <input type="text" name="custom">%
					<?php
					}
				}
				?>
				<input type="submit" name="submit" value="Submit">

			<?php 
				if (!empty($_POST['cost']) && $_POST['cost'] > 0) { 
			?>
				<div id="result" style="display: hide" >
					<div>Tip: $<?php echo number_format((float)$_POST['cost'] * $_POST['tipval'], 2, '.', '')?></div>
					<div>Total: $<?php echo number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['tipval']), 2, '.', '')?></div>
				</div>
			<?php 
				} 
			?>
			</form>
</body>
</html>