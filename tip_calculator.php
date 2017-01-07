<!DOCTYPE html<html>
<head>
	<title>Tip Calculator</title>
	<link rel="stylesheet" type="text/css" href="tipcal.css">
</head>
<body>
	<h1>Tip Calculator</h1>
			<form name="input" action="" method="post">
	  			Bill subtotal $<input type="text" name="cost" value=<?php if(isset($_POST['cost'])) { echo $_POST['cost']; }?>><br>
				<p>Tip Percentage</p>
				<?php
				for($i = 10; $i < 21; $i+=5) {
				?>
					<input type="radio" name="tipval" value=<?=$i / 100?>> <?=$i?>%
				<?php
				}
				?>
				<input type="radio" name="tipval" value=0> Custom: <input type="text" id="custom" name="custom" value=<?php if(isset($_POST['custom'])) { echo $_POST['custom']; }?>>% <br>

				Split: <input type="text" name="split" id="split" value=<?php if(isset($_POST['split'])) { echo $_POST['split']; }?>> person(s)<br>
				
				<input type="submit" name="submit" value="Submit">

			<?php 
				if (!empty($_POST['cost']) && $_POST['cost'] > 0.00 && ($_POST['custom'] > 0 || empty($_POST['custom']))) { 
					if($_POST['tipval'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['tipval'], 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['tipval']), 2, '.', '');
					} else if($_POST['custom'] > 0) {
						$tip = number_format((float)$_POST['cost'] * $_POST['custom']/100, 2, '.', '');
						$total = number_format((float)$_POST['cost'] + ($_POST['cost'] * $_POST['custom']/100), 2, '.', '');
					}
					?>
						<div id="result" style="display: hide" >
						<div>Tip: $<?php echo $tip ?></div>
						<div>Total: $<?php echo $total ?></div>
					<?php

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