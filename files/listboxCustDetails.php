<?php
/**
 * Author: Evin Darling (C00144257)
 * Date: March 2017
 * Description: Create a listbox for customer details. Use javascript function on click to populate the listbox
 */
include "db.inc.php";   // Database connection

// Attempt to query MySQL database customer table with non-deleted data
$sql = "SELECT * FROM customer WHERE DeleteFlag = FALSE";
if (!$result = mysqli_query($con, $sql))        // In case of error, print error message
{
    die('Error in querying the database' . mysqli_error($con));
}
echo "<br><select name='listboxCustDetails' id='listboxCustDetails' onclick='populateCustDetails()'>";
while ($row = mysqli_fetch_array($result))      // Loop through all non-deleted rows in customer table
{                                               // and assign them to variables
    $customerID  = $row['CustomerID'];
    $surname     = $row['Surname'];
    $firstName   = $row['FirstName'];
    $street      = $row['Street'];
    $town        = $row['Town'];
    $county      = $row['County'];
    $phoneNo     = $row['PhoneNo'];
    $creditLimit = $row['CreditLimit'];
    $balance     = $row['Balance'];
    $deleteFlag  = $row['DeleteFlag'];
    $allText     = "$customerID,$surname,$firstName,$street,$town,$county,$phoneNo,$creditLimit,
                    $balance,$deleteFlag";
    // If a customerID has recently been used set that customer to be selected in the listbox
    // then destroy the session
    if (ISSET($_SESSION['customerID']))
    {
        if ($_SESSION['customerID'] == $customerID)
        {
            echo "<option value = '$allText' selected>$surname, $firstName</option>";
            session_destroy();
        }
        else { echo "<option value = '$allText'>$surname, $firstName</option>"; }
    }
    else { echo "<option value = '$allText'>$surname, $firstName</option>"; }
}
echo "</select>";

mysqli_close($con);     // Close the datbase connection