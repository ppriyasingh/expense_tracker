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
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">
			<header>
				<h1><a href="#">Expense Tracker</a></h1>				
			</header>

			<nav id="mainnav">
  				<ul>
                            	<li><a href="index.php">Home</a></li>
                           		<li class="selected-item"><a href="#">Statistics</a></li>
                </ul>
			</nav>			
			</aside>
			
			<aside id="filterbar" class="column-left-left">
			<header><br><br><br>
				<h1><a href="#">FILTER</a></h1>				
			</header>
			<nav id="secnav">
  				<ul>
                            	<li class="selected-item"><a href="#">By Date</a></li>
                           		<li><a href="statistics_month.php">By Month</a></li>
                </ul>
			</nav>					
			</aside>

		<section id="content" class="column-right">    
			<h1>Expense Analysis</h1>	
				<fieldset>
					<form action="#" method="post">
						<p><label for="Date">Date:</label><input type="date" name="Date" required="required" /></p>		
						<p><input type="submit" name="submit" class="formbutton" value="Submit" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="reset" name="reset" class="formbutton" value="Reset" /></p>				
					</form>	
				</fieldset>
				
<?php //INSERTION
if(isset($_POST['submit']))
{
	$Date=$_POST['Date'];
	$query1 = "SELECT * FROM expenses WHERE date='$Date'";
	//$query2 = "SELECT MONTH(date) FROM expenses WHERE date='$Date'";
	$dateElements = explode('-', $Date);
	$year = $dateElements[1];	
	echo "Expense Analysis of ". $Date . "<br>";
	echo $year;
	
	$result1 = mysqli_query($con,$query1);
	while($row1 = mysqli_fetch_assoc($result1))
	{
		extract($row1);
		$grocery=$Grocery;
		$entertainment=$Entertainment;
		$vehicle=$Vehicle;
		$food=$Food;
		$misc=$Miscellaneous;
		//echo month($Date);
	}	
}		
else
{
	$Date=date("Y/m/d");
	$query1 = "SELECT * FROM expenses WHERE date='$Date'";
	$result1 = mysqli_query($con,$query1);	
	echo "Expense Analysis of ". $Date . "<br>";
	while($row1 = mysqli_fetch_assoc($result1))
	{
		extract($row1);
		$grocery=$Grocery;
		$entertainment=$Entertainment;
		$vehicle=$Vehicle;
		$food=$Food;
		$misc=$Miscellaneous;
	}
}
?>
<br><br>
	<script>
		window.onload = function () 
		{
		var chart = new CanvasJS.Chart("chartContainer",{
				animationEnabled: true,
				theme: "light2", // "light1", "light2", "dark1", "dark2","dark1", "dark2"
				title: {
				text: " "	
				},
				axisY: {
				title: "Expenditure (in Rs)",
				includeZero: false
				},
				axisX: {
				title: "Category"
				},
				data: [{
				type: "column",
				yValueFormatString: "#,##0.0#\"\"",
				dataPoints: [
				{ label: "Grocery", y:  <?php echo $grocery; ?> }, 
				{ label: "Entertainment", y: <?php echo $entertainment; ?> }, 
				{ label: "Food", y: <?php echo $vehicle; ?> },
				{ label: "Vehicle", y: <?php echo $food; ?> }, 
				{ label: "Miscellaneous", y: <?php echo $misc; ?> }   
				]
				}]
			});
	chart.render();
		}
	</script>
<div id="chartContainer" style="width: 100%; height: 300px;"></div>
<script src="canvasjs.js"></script>
		</section>
		<div class="clear"></div>
	</section>
</body>
</html>
