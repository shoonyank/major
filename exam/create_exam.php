<?php
session_start();
if(isset($_SESSION["fid"])){
}
else{
exit("Please Sign In to continue");
}
include '../database/dbconnect.php';

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
            #finish{
                visibility:hidden;
            }
        </style>
        <script type="text/javascript">
            function addop1(){
                document.getElementById("option1").style.visibility="visible";
                var x=document.getElementById("op1").value;
                document.getElementById("option1").value=x;
                document.getElementById("option1").innerHTML=x;
            }
            function addop2(){
                document.getElementById("option2").style.visibility="visible";
                var x=document.getElementById("op2").value;
                document.getElementById("option2").value=x;
                document.getElementById("option2").innerHTML=x;
            }
            function addop3(){
                document.getElementById("option3").style.visibility="visible";
                var x=document.getElementById("op3").value;
                document.getElementById("option3").value=x;
                document.getElementById("option3").innerHTML=x;
            }
            function addop4(){
                document.getElementById("option4").style.visibility="visible";
                var x=document.getElementById("op4").value;
                document.getElementById("option4").value=x;
                document.getElementById("option4").innerHTML=x;
            }
            function home(){
                window.location.assign("http://localhost/Major%20Project/Online%20Exam%20Portal/faculty_page.php");
            }
            function submittestname(){
                var testname=document.getElementById('tname').value;
                document.getElementById("testname").value=testname;
                document.getElementById("finish").style.visibility="visible";
                document.getElementById("examname").style.visibility="hidden";
                document.getElementById("question").style.visibility="visible";
                document.getElementById("curr_test").innerHTML=testname;
            }
            function submitquestion(){
                var t=document.getElementById("testname").value;
                var q=document.getElementById("q").value;
                var op1=document.getElementById("op1").value;
                var op2=document.getElementById("op2").value;
                var op3=document.getElementById("op3").value;
                var op4=document.getElementById("op4").value;
                var rans=document.getElementById("rans").value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("response").innerHTML =
                        this.responseText;
                   }
                };
                xhttp.open("GET", "insertquestion.php?testname="+t+"&q="+q+"&op1="+op1+"&op2="+op2+"&op3="+op3+"&op4="+op4+"&rans="+rans, true);
                xhttp.send();
            }
        </script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <?php
        include 'fnavbar.php';
        ?>
        <div style="margin-top: 5%;margin-left: 30%;">
            <div id="examname">
                <input type="text" id="tname" placeholder="Test Name">
                <button class="btn btn-success" onclick="submittestname()">Submit</button>
            </div>
            <h2 id="curr_test"></h2>
            <div id="question">
                <input type="hidden" name="testname" id="testname"><br>
                <input type="textarea" id="q"><br>
                <input type="textarea" id="op1" onchange="addop1()" placeholder="Option 1"><br>
                <input type="textarea" id="op2" onchange="addop2()" placeholder="Option 2"><br>
                <input type="textarea" id="op3" onchange="addop3()" placeholder="Option 3"><br>
                <input type="textarea" id="op4" onchange="addop4()" placeholder="Option 4"><br>
                <select id="rans">
                    <option>
                        Select Right Answer
                    </option>
                    <option id="option1">
                        Option 1
                    </option>
                    <option id="option2">
                        Option 2
                    </option>
                    <option id="option3">
                        Option 3
                    </option>
                    <option id="option4">
                        Option 4
                    </option>
                </select>
                <br>
                <button class="btn btn-success" onclick="submitquestion()">Submit</button><br>
                <p id="response"></p>
            </div><br>
            <button id="finish" class="btn btn-primary" onclick="home()">Finish</button>
        </div>
    </body>
</html>
