<!DOCTYPE html>
<html lang="en">
<!--
Author: Evin Darling (C00144257)
Date: March 2017
Description: Display a listbox of non-deleted equipment types from the database. Displays details
             of the selected equipment type and provides the user with and Amend button to enable
             the inputs for change. Posts these changes on submit.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="../../files/equipmenthire.js"></script>
  <title>Amend/View and Equipment Type</title>
</head>

<body>
  <?php include "../../menubar.php"; ?>
<!--Main panel that will hold the web apps content  -->
  <div class="panel">
<!-- p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../../databasemanagement.html.php">Database Management</a> <b>></b>
      <a class="tree" href="equipmenttypemanagement.html.php">Manage Equipment Type</a> <b>></b>
      <a class="tree" href="amendview.html.php">Amend/View Equipment Type</a> <b>></b>
    </p>
    <br><h1> Amend/View an Equipment Type</h1>
    <h4> Please select an equipment type to view/amend</h4>
<!-- Listbox to select equipment type to amend/view  -->
    <div class="listboxAmendDelete">
      <?php include '../../files/listboxEquipTypeForm.php' ?>
    </div>
<!-- Form to display the details of the selected equipment type and allow user to input amendments.
     Each input is followed by an initially empty <p> that will be used to display an error message
     if necessary.  -->
    <div class="amendForm">
      <form name="myForm" action="amendview.php" onsubmit="return confirmCheckAddEquipType()" method="post">
        <label class="justify" for="typeID">Equipment Type ID:
          <input type="text" name="typeID" id="typeID" disabled>
        </label>

        <label class="justify" for="description">Description:
          <input type="text" name="description" id="description" disabled required>
        </label>
        <p class="error" id="errDesc"></p>

        <label class="justify" for="brand">Brand:
          <input type="text" name="brand" id="brand" disabled required>
        </label>
        <p class="error" id="errBrand"></p>

        <label class="justify" for="category">Category:
          <input type="text" name="category" id="category" disabled required>
        </label>
        <p class="error" id="errCat"></p>

        <label class="justify" for="supplier">Supplier:
          <input type="text" name="supplier" id="supplier" disabled required>
        </label>
        <p class="error" id="errSupp"></p>

        <label class="justify" for="supplierCatalogueCode">Supplier Catalogue Code:
          <input type="text" name="supplierCatalogueCode" id="supplierCatalogueCode" disabled required>
        </label>
        <p class="error" id="errSCC"></p>

        <label class="justify" for="rentalCostPerDay">Rental Cost Per Day:
          <input type="text" name="rentalCostPerDay" id="rentalCostPerDay" disabled required>
        </label>
        <p class="error" id="errRent"></p>

        <label class="justify" for="quantityOfItems">Quantity Of Items:
          <input type="text" name="quantityOfItems" id="quantityOfItems" disabled required>
        </label>
        <label class="justify" for="quantityOnHire">Quantity On Hire:
          <input type="text" name="quantityOnHire" id="quantityOnHire" disabled required>
        </label>
        <br><br>
<!--    Confirm and cancel buttons.
        Button that sets the input fields disables property to false so that amendments can be input.  -->
        <div class="amendButton">
          <input type="submit" class="btn" value="Save Changes">
          <input type="button" class="btn" value="Amend Details" id="amendViewButton" onclick="toggleLock()">
          <button type="button" id="cancelAmendViewEquipmentType"
                  onclick="menuButton('equipmenttypemanagement.html.php')">Cancel</button>
        </div><br>
      </form>
    </div>
  </div>
</body>
</html>