<?php
session_start();
include '../dbconnect.php';

if($con->connect_error)
{
  echo "Error: could not establish database connection";
}
if(isset($_SESSION["sid"])){
}
else{
  exit("Please Sign In to continue");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Experiment 1</title>
</head>
<body>
<form method="get" action="insertquestion.php">
	Question:<input type="text" name="question"><br>
	prime tag:<input type="text" name="prime_tag"><br>
	shown to:<select name="shown_to">
		<option value="faculty">Faculty</option>
		<option value="student">Student</option>
		<option value="all">All</option>
	</select><br>
	<input type="submit" name="submit" value="Submit">
</form>
<?php
$query="Select count(distinct page) as pages from questionstest";
$result=$con->query($query);
$totalpages=0;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$totalpages=$row["pages"];
	}
}
echo $totalpages;
?>
</body>
</html>