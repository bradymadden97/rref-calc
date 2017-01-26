<html>
<head>
<title>RREF</title>
</head>
<body>
	<a href='/'>Home</a>
	<br>
<?php
	function printarray($array){
		echo '<table><tbody>';
		foreach($array as $arr){
			echo '<tr>';
			foreach($arr as $a){
				if($a == 0){
					$a = 0;
				}
				echo '<td>'.$a.'</td>';
			}
			echo '</tr>';
		}
		echo '</tbody></table>';
	}

	function findPivot($array, $startrow, $startcol){
		$i = $startrow;
		while($array[$i][$startcol] == 0 && $i < sizeof($array) - 1){
			$i++;
		}
		if($i == sizeof($array) - 1){
			if($array[$i][$startcol] != 0)
				return $i;
			else
				return -1;
		}
		return $i;
	}

	function interchangeRows($r1, $r2, $array){
		$row1 = $array[$r1];
		$row2 = $array[$r2];
		$array[$r1] = $row2;
		$array[$r2] = $row1;
		return $array;
	}

	function pivotToOne($rnum, $cnum, $array){
		$p = $array[$rnum][$cnum];
		$inv = 1.0/$p;
		$c = sizeof($array[$rnum]);
		for($a = 0; $a < $c; $a++){
			$array[$rnum][$a] = $array[$rnum][$a] * $inv;
		}
		return $array;
	}

	function reduceRows($pivotrow, $pivotcol, $array, $rows, $cols){
		$prow = $array[$pivotrow];
		for($i = $pivotrow + 1; $i < $rows; $i++){
			if($array[$i][$pivotcol] != 0){
				$mult = $array[$i][$pivotcol] * (-1);
				for($j = $pivotcol; $j < $cols; $j++){
					$array[$i][$j] = ($prow[$j] * $mult) + $array[$i][$j];
				}
			}
		}
		return $array;
	}

	function echelonForm($a, $rows, $cols){
		$array = $a;
		$startcol = 0;
		for($i = 0; $i < $rows; $i++){
			if($startcol < $cols){
				$pivot = findPivot($array, $i, $startcol);
				if($pivot != -1){
					if($pivot != 0){
						$array = interchangeRows($i, $pivot, $array);
					}
					$array = pivotToOne($i, $startcol, $array);
					$array = reduceRows($i, $startcol, $array, $rows, $cols);
				}
				$startcol++;
			}
		}
		printarray($array);
	}

	$rows = $_POST['r'];
	$cols = $_POST['c'];
	$array = array();
	for($i = 0; $i < $rows; $i++){
		$innerarray = array();
		for($j = 0; $j < $cols; $j++){
			array_push($innerarray, $_POST[$i.'-'.$j]);
		}
		array_push($array, $innerarray);
	}
	printarray($array);
	echo "<br><hr>Echelon Form:<br>";
	echelonForm($array, $rows, $cols);
	

?>
</body>
</html>