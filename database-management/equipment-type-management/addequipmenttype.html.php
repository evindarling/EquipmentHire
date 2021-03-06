<!DOCTYPE html>
<html lang="en">

<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Display a form for the user to input the required details to add a new equipment type to the table.
             Submit that data via $_POST to the next page, addequipmenttype.php.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="../../files/equipmenthire.js"></script>
  <title>Add an Equipment Type</title>
</head>

<body>
  <?php include "../../menubar.php";      // Include the sites menubar
  include "../../files/db.inc.php";       // Database connection

  // Query database for all rows of the equipmenttype table, die if there's an error
  $sql = "SELECT * FROM equipmenttype ORDER BY EquipmentTypeID DESC";
  if (!$result = mysqli_query($con, $sql))
  {
      die("An error in the SQL Query: " . mysqli_error($con));
  }

  // Get the highest ID currently in the table and increment it by 1 to create the next ID
  $row = mysqli_fetch_array($result);
  $highestID = $row['EquipmentTypeID'];
  $newID = $highestID + 1;
  ?>
<!--Main panel that will hold the web apps content  -->
  <div class="panel">
<!--p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
      <a class="tree" href="addequipmenttype.html.php">Add Equipment Type</a> <b>></b>
    </p>
    <h1>Add an Equipment Type</h1>
    <h4>Please fill in all fields</h4>
    <br>
<!--    Form for inputting data about a new equipment type  -->
    <div class="addForm">
      <form action="addequipmenttype.php" onsubmit="return confirmCheckAddEquipType()" method="post">
        <label class="justify" for="typeID"> Equipment Type ID:
          <input type="text" name="typeID" id="typeID" value="<?php echo $newID; ?>" required disabled>
        </label>

        <label class="justify" for="description"> Description:
          <input type="text" name="description" id="description" placeholder="Description" autocomplete="off" required>
        </label>
        <p class="error" id="errDesc"></p>

        <label class="justify" for="brand"> Brand:
          <input type="text" name="brand" id="brand" placeholder="Brand" autocomplete="off" required>
        </label>
        <p class="error" id="errBrand"></p>

        <label class="justify" for="category"> Category:
          <input type="text" name="category" id="category" placeholder="Category" autocomplete="off" required>
        </label>
        <p class="error" id="errCat"></p>

        <label class="justify" for="supplier"> Supplier:
          <input type="text" name="supplier" id="supplier" placeholder="Supplier" autocomplete="off" required>
        </label>
        <p class="error" id="errSupp"></p>

        <label class="justify" for="supplierCatalogueCode"> Supplier Code:
          <input type="text" name="supplierCatalogueCode" id="supplierCatalogueCode" placeholder="ABC123"
          autocomplete="off" required>
        </label>
        <p class="error" id="errSCC"></p>

        <label class="justify" for="rentalCostPerDay"> Rental Cost / Day:
          <input type="text" name="rentalCostPerDay" id="rentalCostPerDay" placeholder="Cost" autocomplete="off"
          required/>
        </label>
        <p class="error" id="errRent"></p>
        <br>
        <div class="addButton">
          <input type="submit" class="btn" value="Submit">
        <button type="button" onclick="menuButton('equipmenttypemanagement.html.php')">Cancel</button>
        </div><br>
      </form>
    </div>
  </div>
  </body>
</html>
