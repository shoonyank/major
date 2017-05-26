<!-- Navbar for students (used in files in folder discussion_forum or level 1) -->
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #335571;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: white;">WebCods</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../dashboard.php" style="color: white;">Home</a></li>
        <li><a href="../profile.php" style="color: white;">Profile</a></li>
        <li><a href="faculty_view.php" style="color: white;">Forum</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Academics<span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="../submit_assignment.php" style="color: black;">Post New Assignments</a></li>
            <li><a href="../noticeboard.php" style="color: black;">NoticeBoard</a></li>
            <li><a href="../exam/create_exam.php" style="color: black;">Create Exam</a></li>
            <li><a href="../material.php" style="color: black;">Upload Study Material</a></li>
            <li><a href="../results/see_student_results.php" style="color: black;">See Results of Students</a></li>
          </ul>
        </li>
        <li><a href="../database/logout.php" style="color: white;">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>