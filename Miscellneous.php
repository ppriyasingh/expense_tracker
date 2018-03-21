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
                            	<li class="selected-item"><a href="index.php">Home</a></li>
                           		<li><a href="statistics.php">Statistics</a></li>
                </ul>
			</nav>					
			</aside>			
			<aside id="filterbar" class="column-left-left">
			<header>	<br><br><br>		
				<h1><a href="#">FILTER</a></h1>				
			</header>
			<nav id="secnav">
  				<ul>
                            	<li ><a href="index.php">All Categories</a></li>
                           		<li><a href="Grocery.php">Grocery</a></li>
                           		<li><a href="Entertainment.php">Entertainment</a></li>
								<li><a href="Vehicle.php">Vehicle</a></li>
								<li><a href="Food.php">Food</a></li>
								<li class="selected-item"><a href="#">Miscellneous</a></li>
                </ul>
			</nav>					
			</aside>						
			<section id="content" class="column-right">			
				<h3>Miscellaneous Expenses</h3>
				<fieldset>
					<legend>Add Miscellaneous Expenditure</legend>
					<form action="#" method="post">
						<p><label>Date:</label><input type="date" name="Date" required="required" /></p>		
						<p><label>Expenditure:</label><input type="number_format" name="Miscellaneous" required="required" pattern="[0-9]+"/><br /></p>
						<p><input type="submit" name="submit" class="formbutton" value="Submit" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="reset" name="reset" class="formbutton" value="Reset" /></p>
					</form>	
				</fieldset>			
				<br><br>
				<fieldset>
					<legend>Expenses</legend>
				</fieldset>	
				<br>
			<?php //INSERTION
				if(isset($_POST['submit']))
				{
					$query1 = 'SELECT * FROM expenses';
					$result1 = mysqli_query($con,$query1);
					//loop through the results
					$flag=0;
					$Date=$_POST['Date'];
					while($row1 = mysqli_fetch_assoc($result1))
					{
						extract($row1);
						if($date==$Date)
						{
							$flag=1;
							$oldMiscellaneous=$Miscellaneous;
							$oldTotal=$total;
							break;
						}	
					}
					$Miscellaneous=$_POST['Miscellaneous'];
					if($flag==1)
					{
						$query = "UPDATE expenses
						SET Miscellaneous= ($oldMiscellaneous+$Miscellaneous),total=($oldTotal+$Miscellaneous)
						WHERE date='$Date'"; 
						mysqli_query($con, $query);
					}
					else
					{	
						$query = "INSERT INTO expenses(date,Miscellaneous,total)  
						VALUES('$Date','$Miscellaneous','$Miscellaneous')"; 
						mysqli_query($con, $query);
					}
				}
			?>

<?php //DISPLAY 
	echo '<table>';
	echo '<tr>';
	echo '<th> SNo</th>';
	echo '<th> Date</th>';
	echo '<th> Expenditure</th>';
	echo '<tr>';
	$result1 = mysqli_query($con,'SELECT * FROM expenses order by date desc');      //loop through the results
	$snum=1;
	while($row =  mysqli_fetch_assoc($result1))	
	{	
	extract($row);
	echo '<tr>';
	echo '<td>' . $snum . ' </td> ';
	echo '<td>' . $date . ' </td> ';
	echo '<td>' . $Miscellaneous . ' </td> ';
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
