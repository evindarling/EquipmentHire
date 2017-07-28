<!DOCTYPE html>
<html lang="en">
<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: Simple menu with link for the report parts of the app
-->
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/files/stylesheet.css">
<title>Reports Menu</title>
</head>
<body>
  <?php include "menubar.php";
  $linkEquipmentHired = "https://equiphire.candept.com/EquipmentHire/reports/equipmenthiredreport.html.php";
  $linkPayments = "#";
  ?>
  <div class='panel'>
<!-- Main panel that will hold the web apps content-->
    <p class="tree">
<!--  p class that allows the user to identify where on the website they are and trace back their steps-->
      <a class="tree" href="mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="reportsmenu.html.php">Reports Menu</a> <b>></b>
    </p>
    <?php
    echo "<br>";
    echo "<a href='" . $linkEquipmentHired . "' class='button'>Equipment Hired Report</a><br>";
    echo "<a href='" . $linkPayments . "' class='button'>Payments Received Report</a><br>";
    ?>
    <br>
    <form action = "mainmenu.html.php" method="post">
      <input type="submit" class="btn" value="Back"/>
    </form>
  </div>
</body>
</html>