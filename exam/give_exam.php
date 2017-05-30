<?php
session_start();
if(isset($_SESSION["sid"])){
}
else{
exit("Please Sign In to continue");
}
include '../database/dbconnect.php';

$total=0;
$exams=array();
$getexams = "SELECT distinct test_name as exam FROM test";
$result = $con->query($getexams);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($exams,$row["exam"]);
        $total=$total+1;
    }
} else {
    echo "No Exams";
}

$qno=1;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            #question{
                visibility: hidden;
            }   
            #option1,#option2,#option3,#option4{
                visibility: hidden;
            }
            #testwindow{
                visibility: hidden;   
            }
        </style>
        <script type="text/javascript">
            
            function initscoring(){
                document.getElementById("score").value=0;
                document.getElementById("tn").innerHTML=document.getElementById("selection").value;
            }
            function lock(){
                document.getElementById("yans").disabled = true;
                document.getElementById("lock").disabled = true;
                document.getElementById("click").disabled = false;
            }
            function unlock(){
                document.getElementById("yans").disabled = false;
                document.getElementById("lock").disabled = false;
                document.getElementById("click").disabled = true;
            }
            function reverseVisibility(){
                document.getElementById("testwindow").style.visibility="hidden";
                document.getElementById("question").style.visibility="hidden";
                document.getElementById("option1").style.visibility="hidden";
                document.getElementById("option2").style.visibility="hidden";
                document.getElementById("option3").style.visibility="hidden";
                document.getElementById("option4").style.visibility="hidden";
            }
            function visibility(){
                document.getElementById("testselect").style.visibility="hidden";
                document.getElementById("testwindow").style.visibility="visible";
                document.getElementById("question").style.visibility="visible";
                document.getElementById("option1").style.visibility="visible";
                document.getElementById("option2").style.visibility="visible";
                document.getElementById("option3").style.visibility="visible";
                document.getElementById("option4").style.visibility="visible";
            }
            function takeexam(qno){
                var examname=document.getElementById("selection").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        data=JSON.parse(this.responseText);
                            document.getElementById("question").innerHTML="<b>Question : </b>"+data.question;
                            document.getElementById("option1").innerHTML="<b>Option 1 : </b>"+data.option1;
                            document.getElementById("option2").innerHTML="<b>Option 2 : </b>"+data.option2;
                            document.getElementById("option3").innerHTML="<b>Option 3 : </b>"+data.option3;
                            document.getElementById("option4").innerHTML="<b>Option 4 : </b>"+data.option4;
                            document.getElementById("op1").value=data.option1;
                            document.getElementById("op2").value=data.option2;
                            document.getElementById("op3").value=data.option3;
                            document.getElementById("op4").value=data.option4;
                            document.getElementById("rans").value=data.rans;
                            if(data.next=="true"){
                                document.getElementById("thebutton").innerHTML="<button id='click' class='btn btn-success' onclick='takeexam(<?php $qno=$qno+1;echo $qno;?>)' disabled='true'>Next</button>";
                            }
                            if (data.next=="false") {
                                document.getElementById("thebutton").innerHTML="<button id='click' class='btn btn-success' onclick='wrapup()' disabled='true'>Finish</button>";
                            }
                            unlock();
                    }
                };
                xmlhttp.open("GET", "get_questions.php?testname="+examname+"&qno="+qno, true);
                xmlhttp.send();
                visibility();
            }
            function wrapup(){
                var examname=document.getElementById("selection").value;
                var finalscore=document.getElementById("score").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("show").innerHTML ="<br>Your score is: "+finalscore+"<br>"+this.responseText;
                    }
                };
                xmlhttp.open("GET", "savescore.php?score="+finalscore+"&sid="+<?php echo $_SESSION["sid"];?>+"&testname="+examname, true);
                xmlhttp.send();
                reverseVisibility();
            }
            function score(){
                var yourans=document.getElementById("yans").value;
                var rans=document.getElementById("rans").value;
                var score=document.getElementById("score").value;
                ans=0;
                if(yourans==rans){
                    ans=1;
                }
                if(!(yourans==rans)){
                    ans=0;
                }
                //click - Next/finish button
                //yans - select tag
                //lock - lock button
                document.getElementById("score").value= +score + +ans;
                lock();
            }
        </script>
    </head>
    <body onbeforeunload="wrapup()">
        <!-- Fixed navbar -->
        <?php
        include 'navbar.php';
        ?>


        <div id="testselect" style="margin-left: 10%;">
            <div style="margin-top: 5%;">
                Select the exam you want to take:
            </div>
            <select id="selection">
                <?php
                    for($i=0;$i<$total;$i++){
                        echo "<option value='".$exams[$i]."'>".$exams[$i]."</option>";
                    }
                ?>
            </select>
            <button class="btn btn-success" onclick="takeexam(1);initscoring();">Go</button>
        </div>
        <input type="hidden" id="score">
        <input type="hidden" id="rans">
        <p id="show"></p>

        <div id="testwindow">
            <h3 id="tn" style="margin-left: 45%;margin-top: -5%;"></h3>
            <p id="question" style="margin-left: 12%;"></p><br>
            <p id="option1" style="margin-left: 12%;"></p><br>
            <p id="option2" style="margin-left: 12%;"></p><br>
            <p id="option3" style="margin-left: 12%;"></p><br>
            <p id="option4" style="margin-left: 12%;"></p><br>
            <p style="margin-left: 12%;">Choose Your Answer Below:</p>
            <div style="margin-left: 12%;">
                <select id="yans" required>
                    <option disabled>
                        Select Right Answer
                    </option>
                    <option id="op1">Option 1</option>
                    <option id="op2">Option 2</option>
                    <option id="op3">Option 3</option>
                    <option id="op4">Option 4</option>
                </select>
            </div><br>
            <button style="margin-left: 12%;" class="btn btn-primary" id="lock" onclick="score()" >Lock</button>
            <div style="margin-left: 12%;" id="thebutton"></div>
        </div>
    </body>
</html>
