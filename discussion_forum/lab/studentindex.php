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
function getpages(){
	include '../dbconnect.php';
	$query="Select count(distinct page) as pages from questionstest";
	$result=$con->query($query);
	$totalpages=0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$totalpages=$row["pages"];
		}
	}
	return $totalpages;
}
$totalpages=getpages();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Experiment 1</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	function fetchquestions(a){
  		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                data=JSON.parse(this.responseText);
                document.getElementById("prime_tag").innerHTML = data.prime_tag;
                document.getElementById("mainquestion").innerHTML = data.question;
                document.getElementById("maintimestamp").innerHTML = data.timestamp;
                document.getElementById("mainfaculty").innerHTML = data.posted_by;
            }
        };
        xmlhttp.open("GET", "showquestions.php?p=" + a, true);
        xmlhttp.send();
  	}
  </script>
</head>
<body>
<form method="get" action="insertquestion.php">
	Question:<input type="text" name="question"><br>
	prime tag:<input type="text" name="prime_tag"><br>
	shown to:<select name="shown_to">
		<option value="faculty">Faculty</option>
		<option value="student">Student</option>
	</select><br>
	<input type="submit" name="submit" value="Submit">
</form>
<ul class="pagination">
<?php
for ($i=1; $i <= $totalpages; $i++) { 
	echo "<li><a href='#' onclick='fetchquestions(".$i.")'>".$i."</a></li>";
}
?>
</ul>
</body>
</html>