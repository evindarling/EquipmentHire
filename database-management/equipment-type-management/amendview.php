<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Attempt to update the selected equipment type data with input posted by the user form
             the previous page.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <title>Amend/View an Equipment Type</title>
</head>
<body>
  <?php include "../../menubar.php"; ?>
<!--Main panel that will hold the web apps content  -->
  <div class='panel'>
<!--p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
      <a class="tree" href="amendview.html.php">Amend/View Equipment Type</a> <b>></b>
    </p><br>
    <?php
    include '../../files/db.inc.php';   // Database connection

    // Attempt to update the selected equipment type table with the new data in $_POST
    $sql = "UPDATE equipmenttype SET Description = '$_POST[description]', Brand = '$_POST[brand]',
            Category = '$_POST[category]', Supplier = '$_POST[supplier]', SupplierCatalogueCode = 
            '$_POST[supplierCatalogueCode]', RentalCostPerDay = '$_POST[rentalCostPerDay]'
            WHERE EquipmentTypeID = '$_POST[typeID]'";
    if (!mysqli_query($con, $sql))          // In case of error, print error message
    { echo "Error: " . mysqli_error($con); }
    else {                                  // Print confirmation of update, if any
      if (mysqli_affected_rows($con) != 0)
      {
          echo mysqli_affected_rows($con) . " record(s) updated <br>";
          echo "Equipment Type ID: " . $_POST['typeID'] . ", " . $_POST['brand'] . " "
          . $_POST['description'] . " " . " has been updated.";
      }
      else { echo "No records were changed."; }
    }
    mysqli_close($con);       // Close database connection
    ?>
    <form action="amendview.html.php" method="post">
      <input class="btn" type="submit" value="Return">
    </form>
  </div>
</body>
</html>