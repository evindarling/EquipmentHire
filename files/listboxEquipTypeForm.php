<?php
/**
 * Author: Evin Darling (C00144257)
 * Date: March 2017
 * Description: Create a listbox for equipment type details. Use javascript function on click to populate the listbox
 *              and the forms on the pages that call it.
 */
include "db.inc.php";   // Database connection

// Attempt to query MySQL database equipmenttype table for non-deleted data
$sql = "SELECT * FROM equipmenttype WHERE DeleteFlag = FALSE";
if (!$result = mysqli_query($con, $sql))        // In case of error, print error message
{
    die('Error in querying the database' . mysqli_error($con));
}
echo "<br><select name='listboxEquipTypeForm' id='listboxEquipTypeForm' onclick='populateEquipTypeForm()'>";
while ($row = mysqli_fetch_array($result))      // Loop through all non-deleted rows in equipment type
{                                               // table and assign them to variables
    $id                    = $row['EquipmentTypeID'];
    $description           = $row['Description'];
    $brand                 = $row['Brand'];
    $category              = $row['Category'];
    $supplier              = $row['Supplier'];
    $supplierCatalogueCode = $row['SupplierCatalogueCode'];
    $rentalCostPerDay      = $row['RentalCostPerDay'];
    $quantityOfItems       = $row['QuantityOfItems'];
    $quantityOnHire        = $row['QuantityOnHire'];
    $deleteFlag            = $row['DeleteFlag'];
    $allText               = "$id,$description,$brand,$category,$supplier,$supplierCatalogueCode,"
                              . "$rentalCostPerDay,$quantityOfItems,$quantityOnHire,$deleteFlag";
    echo "<option value = '$allText'>$description</option>";
}
echo "</select>";
mysqli_close($con);     // Close database connection