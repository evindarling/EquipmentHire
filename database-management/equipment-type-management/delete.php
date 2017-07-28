<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Attempt to delete the selected equipment type from the table by updating its DeleteFlag to true (1).
             Confirms for the user what changes were made, if any.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <title>Delete an Equipment Type</title>
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
      <a class="tree" href="delete.html.php">Delete Equipment Type</a> <b>></b>
    </p><br>
    <?php
    include "../../files/db.inc.php";             // Database connection

    // Attempt to update the table row of the selected equipment type to set its DeleteFlag to true (1)
    $sql = "UPDATE equipmenttype SET DeleteFlag = true WHERE EquipmentTypeID = '$_POST[typeID]'";
    if (!mysqli_query($con,$sql))                 // In case of error
    {
        echo "Error " . mysqli_error($con);
    }
    else {
        if (mysqli_affected_rows($con) != 0) {    // Print confirmation if records were changed
            echo "The record for " . $_POST['typeID'] . " " . $_POST['brand'] . " " . $_POST['description'] .
                 " has been deleted.";
        }
        else {                                    // Print confirmation that no records were changed
            echo "No records were changed.";
        }
    }
    mysqli_close($con);                           // Close database connection
    ?>
    <form action="delete.html.php" method="post">
      <br><br>
      <input class="btn" type="submit" value="Return" />
    </form>
  </div>
</body>
</html>