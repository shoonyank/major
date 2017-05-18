<!-- Navbar for faculty (used in files in folder discussion_forum or level 1) -->
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
          	<li><a href="../submit_assignment.php" style="color: black;">Post New Assignment</a></li>
            <li><a href="#" style="color: black;">NoticeBoard</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header" style="color: black;">Prepare Mock Tests</li>
            <li><a href="#" style="color: black;">Create Mock test</a></li>
            <li><a href="#" style="color: black;">See Results</a></li>
          </ul>
        </li>
        <li><a href="database/logout.php" style="color: white;">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>