<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Execute the SQL to insert a new row into the equipment type table. Print confirmation if successful
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <title>Add an Equipment Type</title>
</head>

<body>
  <?php include '../../menubar.php'; ?>
  <!--Main panel that will hold the web apps content  -->
  <div class='panel'>
    <!--  p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
      <a class="tree" href="addequipmenttype.html.php">Add Equipment Type</a> <b>></b>
    </p><br>
    <?php
    include '../../files/db.inc.php';   // Database connection

    // Print the details, posted from the previous page, to be inserted
    echo "Details: <br>";
    echo "ID: " . $_POST['typeID'] . "<br>";
    echo "Description: " . $_POST['description'] . "<br>";
    echo "Brand: " . $_POST['brand'] . "<br>";
    echo "Category: " . $_POST['category'] . "<br>";
    echo "Supplier: " . $_POST['supplier'] . "<br>";
    echo "Supplier Catalogue Code: " . $_POST['supplierCatalogueCode'] . "<br>";
    echo "Rental Cost Per Day: " . $_POST['rentalCostPerDay'] . "<br>";

    $sql = "INSERT INTO equipmenttype (EquipmentTypeID, Description, Brand, Category, Supplier, SupplierCatalogueCode,
              RentalCostPerDay, QuantityOfItems, QuantityOnHire) VALUES ('$_POST[typeID]', '$_POST[description]',
              '$_POST[brand]', '$_POST[category]', '$_POST[supplier]', '$_POST[supplierCatalogueCode]',
              '$_POST[rentalCostPerDay]', 0, '0')";

    if (!mysqli_query($con, $sql))        // Attempt to insert new row of data into the table, confirm if successful
    {
        die("An error in the SQL Query: " . mysqli_error($con));
    }
    echo "<br>A record has been added for " . $_POST['brand'] . " " . $_POST['description'] . "  from "
          . $_POST['supplier'] . ".";

    mysqli_close($con);                   // Close database connection
    ?>

    <form action = "addequipmenttype.html.php" method="post"><br>
      <input class="btn" type="submit" value="Return"/>
    </form>
  </div>
</body>
</html>