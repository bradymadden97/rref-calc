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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<div style="text-align:center"><h1><a href='/'>Linear Matrix Reducer</a></h1></div>
	<div id="createtablediv" style="text-align:center;<?php if($createhide == 1) echo 'display:none'; ?>">
		<p>
			Enter the size of your matrix:
		</p>
		<form method="POST" action="">
			<table align="center" style="text-align:center">
				<tr>
					<td>
						<b>Rows:</b>
					</td>
					<td>
						<input id='rows' type='number' name='r' min='1'/>
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
						<button style="margin-top:10px;padding-top:10px;padding-bottom:10px" type="submit">Create Matrix</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script>
		$('#rows').focus();
	</script>
	<?php if($createhide == 1){ ?>
	<div style="text-align:center" id = 'table'>
		<form id='matrixform' method="POST">
			<table align="center" style="text-align:center">
			<?php
				for($i = 0; $i < $rows; $i++){
					?><tr><?php
					for($j = 0; $j < $cols; $j++){
						?><td><input type='number' name='<?php echo $i."-".$j; ?>' id='<?php echo "r".$i."c".$j; ?>' /></td><?php
					}
					?></tr><?php
				}
			?>
			</table>
			<input type="hidden" name="r" value="<?php echo $rows; ?>" />
			<input type="hidden" name="c" value="<?php echo $cols; ?>" />
			<button style="margin-top:25px;padding-top:10px;padding-bottom:10px;padding-left:15px;padding-right:15px;" type="submit">Reduce Matrix</button>
		</form>
	</div>
	<div id="res" style="display:none">
		<div>
			<div style="text-align:center">
				<hr style="width:66%">
				<h3>Echelon Form:</h3>
			</div>
			<div id='echelonresults'>

			</div>
		</div>

		<div style='margin-top:20px'>
			<div style="text-align:center">
				<hr style="width:66%">
				<h3>Row Reduced Echelon Form:</h3>
				<br>
			</div>
			<div id='rrefresults'>

			</div>
		</div>
	</div>
	<script>
	$('#r0c0').focus();
	$("#matrixform").submit(function(e){
		$('#echelonresults').empty();
		$('#rrefresults').empty();
		var url = "/rref.php";
		$.ajax({
			type:"POST",
			url:url,
			data:$("#matrixform").serialize(),
			dataType:"json",
			success:function(data)
			{
				var echelon = data[0];
				var rref = data[1];
				$("#echelonresults").append('<table align="center">');
				$.each(echelon, function(i, val){
					$("#echelonresults table").append('<tr>');
					$.each(val, function(j, v){
						$("#echelonresults tr").last().append('<td align="center">'+v+'</td>');
					});
				});
				$("#rrefresults").append('<table align="center">');
				$.each(rref, function(i, val){
					$("#rrefresults table").append('<tr>');
					$.each(val, function(j, v){
						$("#rrefresults tr").last().append('<td align="center">'+v+'</td>');
					});
				});
				$("#res").css("display","block");
			}
		});
		e.preventDefault();
	});
	</script>
	<?php } ?>
</body>
</html>