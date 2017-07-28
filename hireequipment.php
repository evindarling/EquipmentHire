<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: Displays details of customer and equipment type selected on the previous page.
               Also displays details of all available items, if any, there are of the selected
               equipment type.
-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="/files/stylesheet.css">
  <script language="JavaScript" type="text/javascript" src="files/equipmenthire.js"></script>
  <title>Hire Equipment</title>
</head>

<body>
  <?php
  include "files/db.inc.php";          // Database connection
  include "menubar.php";               // Include the sites menubar
  date_default_timezone_set('UTC');    // Set default timezone

  // Set up necessary variables in $_SESSION
  $_SESSION['customer']            = explode(",", $_POST['listboxCustDetails']);   // Selected customer details
  $_SESSION['customerID']          = $_SESSION['customer'][0];
  $_SESSION['itemType']            = explode(",", $_POST['listboxEquipType']);     // Selected equipment type details
  $_SESSION['equipmentTypeID']     = $_SESSION['itemType'][0];
  $_SESSION['pricePerDay']         = $_SESSION['itemType'][6];
  $_SESSION['quantityOfItems']     = $_SESSION['itemType'][7];
  $_SESSION['quantityOnHire']      = $_SESSION['itemType'][8];
  $_SESSION['itemsAvailableCheck'] = 1;
  $_SESSION['customerCredit']      = $_SESSION['customer'][7];
  $_SESSION['customerBalance']     = $_SESSION['customer'][8];

  calcHireID($con);
  ?>
<!--  Main panel that will hold the web apps content  -->
  <div class="panel">
<!--    p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="mainmenu.html.php">Home </a> <b>></b>
      <a class="tree" href="hireequipment.html.php">Hire Equipment </a> <b>></b>
    </p>
    <br>
    <h1>Hire Out Equipment</h1>
    <h4>Please enter the number of days to hire then select Pay Now or Hire With Balance</h4>
    <?php
    // Display selected customer details in a table
    echo "<p>Customer Details: </p>";
    echo "<div class='hireEquipTable'><table><tr><th>ID</th><th>Name</th><th>Address</th><th>Phone No</th>
          <th>Credit Limit</th><th>Balance</th></tr>";
    echo "<tr><td>" . $_SESSION['customer'][0] . "</td>"
           . "<td>" . $_SESSION['customer'][2] . " "  . $_SESSION['customer'][1] . "</td>"
           . "<td>" . $_SESSION['customer'][3] . ", " . $_SESSION['customer'][4] . ", " . $_SESSION['customer'][5] . "</td>"
           . "<td>" . $_SESSION['customer'][6] . "</td><td>" . $_SESSION['customer'][7] . "</td>"
           . "<td>" . $_SESSION['customer'][8] . "</td></tr></table></div><br>";

    // Display selected equipment type details in a table
    echo "<p>Equipment Type Details:</p>";
    echo "<div class='hireEquipTable'><table><tr><th>ID</th><th>Description</th><th>Brand</th><th>Category</th>
          <th>Supplier</th><th>SCC</th><th>Cost</th><th>Quantity</th><th>On Hire</th></tr>";
    echo "<tr><td>" . $_SESSION['itemType'][0] . "</td>"
           . "<td>" . $_SESSION['itemType'][1] . "</td>"
           . "<td>" . $_SESSION['itemType'][2] . "</td>"
           . "<td>" . $_SESSION['itemType'][3] . "</td>"
           . "<td>" . $_SESSION['itemType'][4] . "</td>"
           . "<td>" . $_SESSION['itemType'][5] . "</td>"
           . "<td>" . $_SESSION['itemType'][6] . "</td>"
           . "<td>" . $_SESSION['itemType'][7] . "</td>"
           . "<td>" . $_SESSION['itemType'][8] . "</td></tr></table></div><br>";

    $sql = "SELECT * FROM equipmentitem WHERE DeleteFlag = FALSE AND EquipmentTypeID = " . $_SESSION['equipmentTypeID']
            .  " ORDER BY Status ASC, EquipmentItemID ASC";

    if (!$result = mysqli_query($con, $sql))      // If SQL query results in an error, print a message and end script
    {
        die('Error in querying the database' . mysqli_error($con));
    }

    produceReport($result);

    if ($_SESSION['itemType'][7] == 0)            // If QuantityOfItems is 0 set a check to 0, print error message
    {
        $_SESSION['itemsAvailableCheck'] = 0;
        echo "<p id='warning' style='color: #c00000;'><b>There are no items of the selected equipment type in stock.</b></p>";
    }
    ?>
<!--    Container allowing user to input number of days the customer wants to rent the equipment for
        then displays and updates information about the transaction  -->
    <div class="daysToRentClass">
      <label for="daysToRent">Days to Rent: <input type="text" id="daysToRent"
        oninput="calcPriceAndDate(<?php echo $_SESSION['pricePerDay'] . ", " . $_SESSION['itemsAvailableCheck'] . ", "
        . $_SESSION['customerCredit'] . ", " . $_SESSION['customerBalance']; ?>)">
      </label>

<!--      Initially empty p where error message will be displayed once input is made to daysToRent  -->
      <p class="error" id="errNoOfDays"></p><br>
      <p class="error" id="errLowCredit"></p><br>

<!--      Display price  -->
      <label for="price">
        Total Price: <p class="price" id="price">0</p>
      </label>
<!--      Display customer's credit limit  -->
      <label for="custCredit">
        / Credit Limit: <p class="price" id="custCredit"><?php echo $_SESSION['customerCredit']; ?></p>
      </label><br>
<!--      Display date the equipment will be due back  -->
      <label for="dateDue">
        Due Date: <p class="price" id="dateDue"></p>
      </label>
<!--      Display what customer's balance will be if the transaction is carried out  -->
      <label for="balAfter">
        / Balance After Transaction: <p class="price" id="balAfter"></p>
      </label><br><br>
    </div>

<!--    Buttons offering functionality for the user to complete the transaction wither by making a payment or
        using the customer's credit. Make a Payment button is a fake link as this functionality was not
        implemented by another group member.  -->
    <div class="hireButton2">
<!--      Make a Payment button that would allow the used to complete the transaction by making a payment  -->
      <form action='makepayment.html.php' onsubmit="return confirmCheckHire()" method='post'>
<!--        2 hidden inputs that would hold price and no. of days data to be posted to make a payment page  -->
        <input type='text' name='paymentPrice' id='paymentPrice' value='' hidden>
        <input type='text' name='paymentNoOfDays' id='paymentNoOfDays' value='' hidden>
        <input type='submit' class="btn" id="makeAPayment" value='Hire And Pay Now' disabled>
      </form>

<!--      Hire with Balance button allows the user to complete the transaction using the customers credit limit  -->
      <form action='hireequipmentconfirmation.php' onsubmit="return confirmCheckHire()" method='post'>
<!--        2 hidden inputs that will hold price and no. of days data to be posted to hire with balance page  -->
        <input type='text' name='balancePrice' id='balancePrice' value='' hidden>
        <input type='text' name='balanceNoOfDays' id='balanceNoOfDays' value='' hidden>
        <input type='submit' class="btn" id="hireWithBalance" value='Hire With Balance' disabled>
      </form>
      <button onclick="menuButton('hireequipment.html.php')">Cancel</button>
    </div>
    <?php
    /**
     * Produce a table containing all non-deleted entries in equipmentitem table that are of the equipmenttype
     * selected in the previous page's equipment type listbox.
     *
     * @param $result A mysql_query object
     */
    function produceReport($result)
    {
        $qty = mysqli_num_rows($result);
        $unavailable = 0;                   // Counter for no. of items that are unavailable
        $firstLoopCheck = true;

        echo "<p>Equipment Items of Selected Type:</p>";
        echo "<div class='hireEquipTable'><table><thead><tr><th>ID</th><th>Description</th>
        <th>Status</th></tr></thead><tbody>";

        // loop through each row of data passed in through $result, echo to rows of a table
        while ($row = mysqli_fetch_array($result))
        {
            $itemID          = $row['EquipmentItemID'];
            $typeID          = $row['EquipmentTypeID'];
            $description     = $row['Description'];
            $dateOfPurchase  = date_create($row['DateOfPurchase']);
            $fdateOfPurchase = date_format($dateOfPurchase, "d/m/y");
            $costPrice       = $row['CostPrice'];
            $status          = $row['Status'];

            echo "<tr><td>" . $itemID      . "</td>"
            . "<td>" . $description . "</td>"
            . "<td>" . $status      . "</td></tr>";

            if ($status == "Unavailable") { $unavailable++; }
            if ($firstLoopCheck) {                              // Store the first item available to be hired
                $_SESSION['firstAvailableItemID'] = $itemID;
                $firstLoopCheck = false;
            }
        }
        echo "</tbody></table></div><br>";

        // If quantity of items is equal to no. of unavailable items, there are none available for hire. Print error msg
        if ($qty == $unavailable) {
            $_SESSION['itemsAvailableCheck'] = 0;
            echo "<p style='color: #c00000;'><b>There are no items of the selected type available for hire.</b></p>";
        }
    }

    /**
     * Generate a new HireID to be used if the transaction is completed. Retrieves the highest current HireID
     * from the table then increments by 1.
     *
     * @param $con Connection to the MySQL server database
     */
    function calcHireID($con)
    {
        // Query hire table for all entries sorted by highest HireID descending, with error check
        $sql = "SELECT * FROM hire ORDER BY HireID DESC";
        if (!$result = mysqli_query($con, $sql))
        {
            die("An error in the SQL Query: " . mysqli_error($con));
        }

        $row = mysqli_fetch_array($result);
        if($row != null)                      // If data exists in table, add 1 to the highest current ID
        {
            $_SESSION['newHireID'] = $row['HireID'] + 1;
        }
        else {
            $_SESSION['newHireID'] = 5000;    // Default HireID if no data exists in table
        }
    }

    mysqli_close($con);                       // close MySQL connection
    ?>
    </div>
</body>
</html>
