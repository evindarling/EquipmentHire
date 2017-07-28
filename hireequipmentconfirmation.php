<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Execute insertion of a new row to the hire table, increment the relevant equipmenttype.QuantityOfItems
             by 1, set equipmentitem Status to Unavailable, print a confirmation if successful
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="files/equipmenthire.js"></script>
  <title>Hire Equipment</title>
</head>

<body>
  <?php
  include "files/db.inc.php";       // Database connection
  include "menubar.php";            // Include the sites menubar
  date_default_timezone_set('UTC'); // Set default timezone
  ?>
<!--  Main panel that will hold the web apps content  -->
  <div class="panel">
<!--    p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="hireequipment.html.php">Hire Equipment</a> <b>></b>
    </p>
    <?php
    $price = $_POST['balancePrice'];                // Price posted from previous page
    $noOfDays = $_POST['balanceNoOfDays'];          // No. of days customer requested for hire
    $currDate = date("Y-m-d");                      // Current date
    $dueDate = strtotime("+$noOfDays Days");        // Date the equipment item is due back
    $dueDateF = date("Y-m-d", $dueDate);            // Due date formatted for insertion into table
    $custID = $_SESSION['customer'][0];             // ID of customer requesting hire
    $itemTypeID = $_SESSION['itemType'][0];         // ID of item type selected
    $itemID = $_SESSION['firstAvailableItemID'];    // ID of item that will be hired out
    $newBalance = $_SESSION['customerBalance'] + $price;

    // Attempt to insert new hire into table, die if unsuccessful
    $sql = "INSERT INTO hire (HireID, EquipmentItemID, CustomerID, HireDate, DateDue, Price)
    VALUES ('$_SESSION[newHireID]', '$itemID', '$custID', '$currDate', '$dueDateF', '$price');";
    if (!mysqli_query($con, $sql)) {
        die("An error in the SQL Query: " . mysqli_error($con));
    }

    // Attempt to update Status of the equipment item to Unavailable, die if unsuccessful
    $sql = "UPDATE equipmentitem SET Status='Unavailable' WHERE EquipmentItemID=$itemID";
    if (!mysqli_query($con, $sql)) {
        die("An error in the SQL Query: " . mysqli_error($con));
    }

    // Attempt to increment QuantityOnHire for the given item type, die if unsuccessful
    $sql = "UPDATE equipmenttype SET QuantityOnHire = QuantityOnHire + 1 WHERE EquipmentTypeID=$itemTypeID;";
    if (!mysqli_query($con, $sql)) {
        die("An error in the SQL Query: " . mysqli_error($con));
    }

    // Attempt to add the price of hire onto customers balance, die if unsuccessful
    $sql = "UPDATE customer SET Balance=$newBalance WHERE CustomerID=$custID;";
    if (!mysqli_query($con, $sql)) {
        die("An error in the SQL Query: " . mysqli_error($con));
    }

    // Echo a message confirming details of the transaction
    echo "<br><br>A record has been added for " . $custID . ": " . $_SESSION['customer'][2] . " "
          . $_SESSION['customer'][1] . ". Hired item: " . $itemID . ", " . $_SESSION['itemType'][1] . " at a price of "
          . $price . " euro. Due date: " . date('d/m/Y', $dueDate);

    ?>
    <br><br>
<!--    Buttons to hire again or exit the transaction  -->
    <button onclick="menuButton('hireequipment.html.php')">Hire Again</button>
    <button onclick="menuButton('mainmenu.html.php')">Finished</button>
  </div>
</body>
</html>