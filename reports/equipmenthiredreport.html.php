<!DOCTYPE html>
<html lang="en">
<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: Simple menu with link for the report parts of the app
-->
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../files/stylesheet.css">
<script language="JavaScript" type="text/javascript" src="../files/equipmenthire.js"></script>
<title>Equipment Hired Report</title>
</head>

<body>
  <?php
  include "../menubar.php";       // Include site menubar
  include "../files/db.inc.php";  // Database connection

  // Attempt to query hire database for active hires
  $sql = "SELECT * FROM hire WHERE Returned = 0 ORDER BY HireDate DESC";
  if (!$result = mysqli_query($con, $sql))
  {
      die('Error in querying the database' . mysqli_error($con));
  }
  ?>
<!--Main panel that will hold the web apps content  -->
  <div class="panel">
<!-- p class that allows the user to identify where on the website they are and trace back their steps  -->
    <p class="tree">
      <a class="tree" href="../mainmenu.html.php">Home</a> <b>></b>
      <a class="tree" href="../reportsmenu.html.php">Reports Menu</a> <b>></b>
      <a class="tree" href="equipmenthiredreport.html.php">Equipment Hired Report</a> <b>></b>
    </p><br>
    <h1> Equipment Hired Report</h1>
<!--Buttons to change the order of the report table  -->
    <input class="btn" type="button" id="dateButton" value="Order by Hire Date" onclick="dateOrder()"
    title="Click here to see data in reverse date of hire order">
    <input class="btn" type="button" id="custButton" value="Order by Customer ID" onclick="customerIDOrder()"
    title="Click here to see data in customer ID order">
    <br><br>
    <?php
    $choice = "hireDate";             // Default choice
    if (ISSET($_POST['choice']))      // If a new choice is posted, update $choice
    {
        $choice = $_POST['choice'];
    }
    if ($choice == "customerID") {    // Sort report table by customer ID
        ?>
        <script>
          document.getElementById("custButton").disabled = true;
          document.getElementById("dateButton").disabled = false;
        </script>
        <?php
        $sql = "SELECT * FROM hire WHERE Returned = FALSE ORDER BY CustomerID ASC";
        produceReport($con, $sql);
    }
    else {                            // Sort report table by hire date
        ?>
        <script>
          document.getElementById("dateButton").disabled = true;
          document.getElementById("custButton").disabled = false;
        </script>
        <?php
        $sql = "SELECT * FROM hire WHERE Returned = FALSE ORDER BY HireDate DESC";
        produceReport($con, $sql);
    }

    /**
     * Produces a report table of equipment items current out on hire
     *
     * @param $con Database connection
     * @param $sql SQL command to be executed
     */
    function produceReport($con, $sql)
    {
        // Attempt to query hire database for hire details
        if (!$result = mysqli_query($con, $sql)) {
            die("An error in the SQL Query: " . mysqli_error($con));
        }

        echo "<div class='reportsTable'><table><tr><th class='hireReportHead'>Hire ID</th><th>Item ID</th><th>Hire Date</th><th>Customer ID</th>
        <th>Price</th><th>Date Due</th></tr>";

        // Loop through result all current hires and print them in a row in the table
        while ($row = mysqli_fetch_array($result))
        {
            $hireID          = $row['HireID'];
            $equipmentItemID = $row['EquipmentItemID'];
            $hireDate        = $row['HireDate'];
            $customerID      = $row['CustomerID'];
            $dateDue         = date_create($row['DateDue']);
            $dateDueF        = date_format($dateDue, "d/m/y");
            $price           = $row['Price'];

            echo "<tr class='hireReportRow'><td>" . $hireID . "</td>"
            . "<td>" . $equipmentItemID . "</td>"
            . "<td>" . $hireDate        . "</td>"
            . "<td>" . $customerID      . "</td>"
            . "<td>" . $price           . "</td>"
            . "<td>" . $dateDueF        . "</td></tr>";
        }
        echo "</table></div><br>";
    }
    mysqli_close($con);     // Close database connection
    ?>
    <form action="equipmenthiredreport.html.php" method="post" name="reportForm">
    <input type="hidden" name="choice">
    </form>
    <form action = "../reportsmenu.html.php" method="post">
    <input type="submit" class="btn" value="Back"/>
    </form>
  </div>
</body>
</html>

