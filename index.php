<?php
	$createhide = 0;
	if(!empty($_POST["r"]) && !empty($_POST["c"])) {
		$rows = $_POST["r"];
		$cols = $_POST["c"];
		$createhide = 1;
	}
	
	
?>

<html>
<head>
<title>Linear Matrix Solver</title>
</head>
<body>
	<h1><a href='/'>Linear Matrix Solver</a></h1>
	<div id="createtablediv" <?php if($createhide == 1) echo 'style="display:none"'; ?>>
		<p>
			Enter the size of your matrix:
		</p>
		<form method="POST" action="">
			<table>
				<tr>
					<td>
						<b>Rows:</b>
					</td>
					<td>
						<input type='number' name='r' min='1'/>
					</td>
				</tr>
					<td>
						<b>Columns:</b>
					</td>
					<td>
						<input type='number' name='c' min='1'/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td style="padding-top:10px">
						<button style="padding-top:5px;padding-bottom:5px" type="submit">Create Matrix</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<?php if($createhide == 1){ ?>
	<div id = 'table'>
		<form method="POST" action="rref.php">
			<table>
			<?php
				for($i = 0; $i < $rows; $i++){
					?><tr><?php
					for($j = 0; $j < $cols; $j++){
						?><td><input type='number' name='<?php echo $i."-".$j; ?>'/></td><?php
					}
					?></tr><?php
				}
			?>
			</table>
			<input type="hidden" name="r" value="<?php echo $rows; ?>" />
			<input type="hidden" name="c" value="<?php echo $cols; ?>" />
			<button style="padding-top:10px;padding-bottom:10px" type="submit">RREF</button>
		</form>
	</div>
	<?php } ?>
</body>
</html>