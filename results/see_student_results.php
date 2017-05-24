<?php
session_start();
if (isset($_SESSION["fid"])) {
}
else{
exit("Please Sign In to continue");
}
include '../database/dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Results</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		table {
		    font-family: arial, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}

		td, th {
		    border: 1px solid #dddddd;
		    text-align: left;
		    padding: 8px;
		}

		tr:nth-child(even) {
		    background-color: #dddddd;
		}
	</style>
	<script type="text/javascript">
		function go(){
			//var student=document.getElementById("studentname").value;
			//var test=document.getElementById("testname").value;
			//document.getElementById("show").innerHTML=student + "<br>" +test;
		//}
		//function takeexam(qno){
			var sid=document.getElementById("studentname").value;
			var test=document.getElementById("testname").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    data=JSON.parse(this.responseText);
                        document.getElementById("show").innerHTML=data.text ;
                }
            };
            xmlhttp.open("GET", "get_score.php?testname="+test+"&sid="+sid, true);
            xmlhttp.send();
        }
	</script>
</head>
<body>
	<?php
		include 'fnavbar.php';
	?>
	<div id="studentselect" style="margin-top: 5%;">
	<span>Select student name</span>
		<select id="studentname">
			<?php
				$q="Select sid,name from student_details";
				$r=$con->query($q);
				if ($r->num_rows > 0) {
				    // output data of each row
				    while($row1 = $r->fetch_assoc()) {
				        echo "<option value='".$row1["sid"]."'>".$row1["name"]."</option>";
				    }
				}
			?>
		</select>
		<br>
		<span>Select Test</span>
		<select id="testname">
			<?php
				$qu="Select distinct test_name from test";
				$re=$con->query($qu);
				if ($re->num_rows > 0) {
				    // output data of each row
				    while($row2 = $re->fetch_assoc()) {
				        echo "<option value='".$row2["test_name"]."'>".$row2["test_name"]."</option>";
				    }
				}
			?>
		</select>
		<button class="btn btn-success" id="submit" onclick="go()">Submit</button>
	</div>
	<p id="show"></p>
</body>
</html>