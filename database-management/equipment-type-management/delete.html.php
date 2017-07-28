<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Display a listbox of all non-deleted equipment types and their details once selected, posts the
             the selected equipment type to the next page to confirm deletion. Error checking via javascript
             confirmDelete function makes sure that the equipment type cannot be deleted while an equipment
             item of the selected type is currently on hire.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="../../files/equipmenthire.js"></script>
  <title>Delete an Equipment Type</title>
</head>

<body>
  <?php include "../../menubar.php"; ?>
<!--Main panel that will hold the web apps content  -->
  <div class="panel">
<!--p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
      <a class="tree" href="delete.html.php">Delete Equipment Type</a> <b>></b>
    </p><br>
    <h1>Delete an Equipment Type</h1>
    <h4>Please select an equipment type to delete</h4>
<!--Listbox to select equipment type to delete  -->
    <div class="listboxAmendDelete">
      <?php include "../../files/listboxEquipTypeForm.php" ?>
    </div>
<!--Form to display the details of the selected equipment type before deletion  -->
    <form name="deleteForm" action="delete.php" onsubmit="return confirmDelete()" method="post">
      <label for="typeID" class="justify">Equipment Type ID:
        <input type="text" name="typeID" id="typeID" disabled>
      </label>
      <label for="description" class="justify">Description:
        <input type="text" name="description" id="description" disabled>
      </label>
      <label for="brand" class="justify">Brand:
        <input type="text" name="brand" id="brand" disabled>
      </label>
      <label for="category" class="justify">Category:
        <input type="text" name="category" id="category" disabled>
      </label>
      <label for="supplier" class="justify">Supplier:
        <input type="text" name="supplier" id="supplier" disabled>
      </label>
      <label for="supplierCatalogueCode" class="justify">Supplier Category Code:
        <input type="text" name="supplierCatalogueCode" id="supplierCatalogueCode" disabled>
      </label>
      <label for="rentalCostPerDay" class="justify">Rental Cost Per Day:
        <input type="text" name="rentalCostPerDay" id="rentalCostPerDay" disabled>
      </label>
      <label for="quantityOfItems" class="justify">Quantity Of Items:
        <input type="text" name="quantityOfItems" id="quantityOfItems" disabled>
      </label>
      <label for="quantityOnHire" class="justify">Quantity On Hire:
        <input type="text" name="quantityOnHire" id="quantityOnHire" disabled>
      </label>
      <p class="error" id="errDelete"></p>
      <br><br>
      <div class="deleteButton">
        <input type="submit" class="btn" value="Delete the record">
        <button type="button" id="cancelDeleteEquipmentType"
                onclick="menuButton('equipmenttypemanagement.html.php')">Cancel</button>
      </div>
      <br>
    </form>
  </div>
</body>
</html>