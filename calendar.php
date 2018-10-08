<!DOCTYPE html>
<html lang="en">
<head>
  <title>Calendar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
	table{
		border:#808080 1px solid;
		margin-top: 20px;
	}
	caption{
		font-size: 25px;
		background: #134F5C;
		color: #fff;
		padding: 18px;
	}
	caption, th{
		text-align:center;
	}
	tr{
		border-bottom:#808080 1px solid;
	}
	th{
		background-color: #FF0000;
		color: #ffffff;
	}
	th,td{
		padding: 30px;
		font-size: 20px;
	}
	.error{
		margin-top: 20px;
		border: 1px solid #ff0000;
		color: #ff0000;
		padding: 10px;
		text-align: center;
	}
  </style>
</head>
<body>

<div class="container">
<div class="row">
<div class="col-md-4 col-md-offset-4">
  <h2>Calendar form</h2>
  <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
	  <label for="sel1">Select month:</label>
	  <select class="form-control" id="sel1" name="month">
		<option value="1">January</option>
		<option value="2">February</option>
		<option value="3">March</option>
		<option value="4">April</option>
		<option value="5">May</option>
		<option value="6">June</option>
		<option value="7">July</option>
		<option value="8">August</option>
		<option value="9">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	  </select>
	</div>
    <div class="form-group">
      <label for="year">Year:</label>
      <input type="text" class="form-control" id="year" placeholder="Enter year" name="year">
    </div>
    <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
  </form>

</div>
</div>

<?php
if(!empty($_POST['submit'])){
	$month = $year = '';
	if(!empty($_POST['month'])){
		$month = $_POST['month'];
	}
	if(!empty($_POST['year'])){
		$year = $_POST['year'];
	}else{
		echo "<div class='row'><div class='col-md-4 col-md-offset-4 error'>Year is mandatory.</div></div>";
		die();
	}
	
	$date_today = getdate(mktime(0,0,0,$month,1,$year));
	
	$month_name = $date_today["month"];
	
	$first_week_day = $date_today["wday"];
	
	$cont = true;
	$today = 27;
	while (($today <= 32) && ($cont))
	{
		$date_today = getdate(mktime(0,0,0,$month,$today,$year));

		if ($date_today["mon"] != $month)
		{
			$lastday = $today - 1;
			$cont = false;
		}
		$today++;
	}
?>
<div class="table-responsive">
<table cellpadding="10" class="col-md-12">
<caption><?php echo $month_name.' - '.$year ?></caption>
<tr align=center><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr>

<?php 
	$day = 1;
	$wday = $first_week_day;
	$firstweek = true;
	while ( $day <= $lastday)
	{
		if ($firstweek)
		{
		echo "<tr align=center>";
		for ($i=1; $i<=$first_week_day; $i++)
		{
			echo "<td>*</td>";
		}
		$firstweek = false;
		}
		if ($wday==0)
		echo "<tr align=center>";
		
		echo "<td>".$day."</td>";
		if ($wday==6)
		echo "</tr>";

		$wday++;
		$wday = $wday % 7;
		$day++;
	}
	
	while($wday <=6 )
	{
		echo "<td>*</td>";
		$wday++;
	}
	echo "</tr></table>";
}
?>
</div>
</div>
</body>
</html>