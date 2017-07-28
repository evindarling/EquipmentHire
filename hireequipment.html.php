<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: Allow the user to choose a customer and equipment type to start the hiring
               out process. Continued by submitting the form.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="files/equipmenthire.js"></script>
  <title>Hire Equipment</title>
</head>

<body>
<!--Include the sites menubar  -->
  <?php include "menubar.php"; ?>
<!--Main panel that will hold the web apps content  -->
  <div class="panel">
<!--  p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="mainmenu.html.php">Home</a><b>></b>
      <a class="tree" href="hireequipment.html.php">Hire Equipment</a><b>></b>
    </p>
    <br>
    <h1>Hire Out Equipment</h1>
    <h4> Please select a customer and an equipment type</h4>
    <br><br>
<!--    Form where user chooses the customer and equipment type from a listbox  -->
    <form action="hireequipment.php" method="post">
      <div class="listboxAmendDelete">
        <label for="listboxCustDetails"><b>Customer:</b>
          <?php include "files/listboxCustDetails.php"; ?>
        </label>
<!--        Initially empty p where customer details will be displayed once a selection is made  -->
        <p id="custDetailsReport"></p>
        <br><br>
        <label for="listboxEquipType"><b>Equipment Type:</b>
          <?php include "files/listboxEquipType.php"; ?>
        </label>
<!--        Initially empty p where equipment type details will be displayed once a selection is made  -->
        <p id="equipTypeDetailsReport"></p>
        <br><br>
      </div>
      <br>
      <div class="hireButton">
        <input type="submit" class="btn" value="Continue">
        <button type="button" class="btn" onclick="menuButton('mainmenu.html.php')">Cancel</button>
      </div>
    </form>
  </div>
</body>
</html>