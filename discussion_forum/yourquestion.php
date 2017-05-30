<?php
session_start();
include 'dbconnect.php';

if(isset($_SESSION["sid"])){
	$id_of="student";
}
else if(isset($_SESSION["fid"])){	
	$id_of="faculty";
}
else{
	echo "Please Sign In to continue.";
}

function getpages(){
	include 'dbconnect.php';
	$query="Select count(distinct page) as pages from questions where shown_to='faculty'";
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
<body>
        <!-- Fixed navbar -->
<?php
  include 'navbar.php';
?>
<!--Navbar-->

<!--Vertical Navbar-->
<div class="container" style="margin-top: 5%;">
<div class="row">
  <div class="col-sm-3">
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="faculty_view.php">New Questions</a></li>
            <li><a href="yourquestion.php">Submit a question</a></li>
            <li><a href="#">Total Questions <span class="badge">
            <?php
        $total;
        $query="Select count(qid) from questions where shown_to='student'";
        $result = $con->query($query);
        if ($result->num_rows > 0) {    
            while($row = $result->fetch_assoc()) {
                $total=$row["count(qid)"];
            }
        }
        echo $total;
            ?>              
            </span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>  
  <div class="col-sm-9" id="main_content">
  <form method="get" action="insertquestion.php">
  <!--input type="hidden" name="id_of" value="<?php //echo $id_of;?>"-->
	Question:<input type="text" name="question"><br><br>
	prime tag:<input type="text" name="prime_tag"><br><br>
	shown to:<select name="shown_to">
		<option value="faculty">Faculty</option>
		<option value="student">Student</option>
	</select><br><br>
	<input type="submit" name="submit" value="Submit">
</form>
  </div>
  </body>
</html>