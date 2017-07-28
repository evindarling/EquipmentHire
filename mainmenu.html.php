<!DOCTYPE html>
<html lang="en">
<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: Displays a menu with which the user can access the different
               functionality of the web application.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="/files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="files/equipmenthire.js"></script>
  <title>Main Menu</title>
</head>

<body>
  <?php
  include "menubar.php";        // include the sites menu bar

  // variables containing links to be used
  $linkHireEquipment      = "https://equiphire.candept.com/EquipmentHire/hireequipment.html.php";
  $linkReturnEquipment    = "#";
  $linkDatabaseManagement = "https://equiphire.candept.com/EquipmentHire/databasemanagement.html.php";
  $linkStockControl       = "#";
  $linkMakeAPayment       = "#";
  $linkReportsMenu        = "https://equiphire.candept.com/EquipmentHire/reportsmenu.html.php";
  $linkQuit               = "index.html";
  ?>
<!--Main panel that will hold the web apps content -->
  <div class="panel">
<!--p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree"><a class="tree" href="mainmenu.html.php">Home</a><b>></b></p>
    <h1>Welcome</h1>
    <?php
    //  links to access main functionality of the web app
    //  functional links: Hire Equipment, Database Management, Reports Menu, Quit
    echo "<a href='" . $linkHireEquipment      . "' class='button'>Hire Equipment</a><br>";
    echo "<a href='" . $linkReturnEquipment    . "' class='button'>Return Equipment</a><br>";
    echo "<a href='" . $linkDatabaseManagement . "' class='button'>Database Management</a><br>";
    echo "<a href='" . $linkStockControl       . "' class='button'>Stock Control</a><br>";
    echo "<a href='" . $linkMakeAPayment       . "' class='button'>Make A Payment</a><br>";
    echo "<a href='" . $linkReportsMenu        . "' class='button'>Reports Menu</a><br>";
    echo "<a href='" . $linkQuit               . "' class='button'>Quit</a><br>";
    ?>
  </div>
</body>
</html>