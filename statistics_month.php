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
			<header>
			<br><br><br>
				<h1><a href="#">FILTER</a></h1>				
			</header>
			<nav id="secnav">
  				<ul>
                            	<li><a href="statistics.php">By Date</a></li>
                           		<li class="selected-item"><a href="#">By Month</a></li>
                </ul>
			</nav>					
			</aside>

		<section id="content" class="column-right">    
			<h1>Expense Analysis</h1>	
				<fieldset>
					<form action="#" method="post">
						<p><label for="From Date">From:</label><input type="date" name="FromDate" required="required" /></p>	
						<p><label for="Till Date">To:</label><input type="date" name="ToDate" required="required" /></p>	
						<p><input type="submit" name="submit" class="formbutton" value="Submit" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="reset" name="reset" class="formbutton" value="Reset" /></p>				
					</form>	
				</fieldset>
				
<?php //INSERTION
if(isset($_POST['submit']))
{
	$FromDate=$_POST['FromDate'];
	$ToDate=$_POST['ToDate'];
	$query1 = "SELECT sum(Grocery) as g,sum(Entertainment) as e,sum(Vehicle) as v,sum(Food) as f,sum(Miscellaneous) as m FROM expenses WHERE (date>='$FromDate') and (date<='$ToDate')";
	//$query2 = "SELECT MONTH(date) FROM expenses WHERE date='$Date'";
	//$dateElements = explode('-', $Date);
	//$mon = $dateElements[1];	
	//echo $mon;
	echo "Expense Analysis from ". $FromDate . " to " . $ToDate . "<br>";
	
	$result1 = mysqli_query($con,$query1);
	while($row1 = mysqli_fetch_assoc($result1))
	{
		extract($row1);
		$grocery=$g;
		$entertainment=$e;
		$vehicle=$v;
		$food=$f;
		$misc=$m;
		//echo month($Date);
	}	
}		
else
{	
	$FromDate=date("Y/m/1");
	$ToDate=date("Y/m/d");
	$query1 = "SELECT sum(Grocery) as g,sum(Entertainment) as e,sum(Vehicle) as v,sum(Food) as f,sum(Miscellaneous) as m FROM expenses WHERE (date>='$FromDate') and (date<='$ToDate')";
	$result1 = mysqli_query($con,$query1);	
	echo "Expense Analysis from ". $FromDate . " to " . $ToDate . "<br>";
	
	while($row1 = mysqli_fetch_assoc($result1))
	{
		extract($row1);
		$grocery=$g;
		$entertainment=$e;
		$vehicle=$v;
		$food=$f;
		$misc=$m;
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
