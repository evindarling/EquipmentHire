<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Display a list of buttons that give access the add, delete and amend/view apps for the equipment type
             database.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="../../files/equipmenthire.js"></script>
  <title>Equipment Type Management</title>
</head>
<body>
  <?php
  include "../../menubar.php";        // Include the sites menubar
  // Variables containing links to app pages
  $linkAddEquipment    = "/addequipmenttype.html.php";
  $linkDeleteEquipment = "/delete.html.php";
  $linkAmendEquipment  = "/amendview.html.php";
  ?>
<!--  Main panel that will hold the web apps content  -->
  <div class='panel'>
<!--    p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
    </p><br>
    <?php              // Links
    echo "<a href='" . $linkAddEquipment . "' class='button'>Add Equipment Type</a><br>";
    echo "<a href='" . $linkDeleteEquipment . "' class='button'>Delete Equipment Type</a><br>";
    echo "<a href='" . $linkAmendEquipment . "' class='button'>Amend/View Equipment Type</a><br>";
    ?>
    <form action = "../../databasemanagement.html.php" method="post">
    <input type="submit" class="btn" value="Back"/>
    </form>
  </div>
</body>
</html>