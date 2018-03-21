<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Expense Tracker</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>
<?php
include 'connection.php';
?> 
<body>
		<!-- Database Name: expense_manager 
			 Database Table Name: expenses
		{		COLUMN			TYPE
				Grocery 		float,
				Entertainment 	float,
				Vehicle 		float, 
				Food 			float,
				Miscellaneous 	float,
				date 			date,
				total 			double
		}
		-->

		<section id="body" class="width">
			<aside id="sidebar" class="column-left">
			<header>
				<h1><a href="#">Expense Tracker</a></h1>				
			</header>
			<nav id="mainnav">
  				<ul>
                            	<li class="selected-item"><a href="index.php">Home</a></li>
                           		<li><a href="statistics.php">Statistics</a></li>
                </ul>
			</nav>					
			</aside>			
			<aside id="filterbar" class="column-left-left">
			<header>
			<br><br><br>
				<h1><a href="#">FILTER</a></h1>				
			</header>
			<nav id="secnav">
  				<ul>
                            	<li class="selected-item" ><a href="#">All Categories</a></li>
                           		<li><a href="Grocery.php">Grocery</a></li>
                           		<li><a href="Entertainment.php">Entertainment</a></li>
								<li><a href="Vehicle.php">Vehicle</a></li>
								<li><a href="Food.php">Food</a></li>
								<li><a href="Miscellneous.php">Miscellneous</a></li>
                </ul>
			</nav>					
			</aside>						
			<section id="content" class="column-right">
	<h3>All Expenses</h3>
	<fieldset>
	</fieldset>	
	<br>

<?php //DISPLAY 
	echo '<table>';
	echo '<tr>';
	echo '<th> SNo</th>';
	echo '<th> Date</th>';
	echo '<th> Grocery</th>';
	echo '<th> Entertainment</th>';
	echo '<th> Vehicle</th>';
	echo '<th> Food</th>';
	echo '<th> Miscellaneous</th>';
	echo '<th> Total</th>';
	echo '<tr>';
	$result1 = mysqli_query($con,'SELECT * FROM expenses order by date desc');      //loop through the results
	$snum=1;
	while($row =  mysqli_fetch_assoc($result1))
	{	
		extract($row);
		echo '<tr>';
		echo '<td>' . $snum . ' </td> ';
		echo '<td>' . $date . ' </td> ';
		echo '<td>' . $Grocery . ' </td> ';
		echo '<td>' . $Entertainment . ' </td> ';
		echo '<td>' . $Vehicle . ' </td> ';
		echo '<td>' . $Food . ' </td> ';
		echo '<td>' . $Miscellaneous . ' </td> ';
		echo '<td>' . $total . ' </td> ';
		echo '</tr>';
		$snum+=1;
	} 
	echo '<table>';
?>	
		</section>

		<div class="clear"></div>

	</section>
	

</body>
</html>
