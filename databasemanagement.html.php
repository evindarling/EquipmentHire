<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Display a list of buttons that give access to applications for managing the various database tables.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="files/equipmenthire.js"></script>
  <title>Database Management</title>
</head>
<body>
  <?php
  include "menubar.php";      // Include the sites menubar

  // Variables containing links to database management pages
  $linkEquipType = "/database-management/equipment-type-management/equipmenttypemanagement.html.php";
  $linkEquipItem = "#";
  $linkCust      = "#";
  $linkSupp      = "#";
  $linkStaff     = "#";
  $linkReports   = "/reportsmenu.html.php";
  ?>
<!--  Main panel that will hold the web apps content  -->
  <div class='panel'>
<!--    p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="databasemanagement.html.php">Database Management</a> <b>></b>
    </p>
    <?php
    echo "<br>";        // Links
    echo "<a href='" . $linkEquipType . "' class='button'>Equipment Type Maintenance Menu</a><br>";
    echo "<a href='" . $linkEquipItem . "' class='button'>Equipment Item Maintenance Menu</a><br>";
    echo "<a href='" . $linkCust      . "' class='button'>Customer Maintenance Menu</a><br>";
    echo "<a href='" . $linkSupp      . "' class='button'>Supplier Maintenance Menu</a><br>";
    echo "<a href='" . $linkStaff     . "' class='button'>Staff Maintenance Menu</a><br>";
    echo "<a href='" . $linkReports   . "' class='button'>Reports Maintenance Menu</a><br>";
    ?>
    <form action = "mainmenu.html.php" method="post">
    <input type="submit" class="btn" value="Back"/>
    </form>
  </div>
</body>
</html>