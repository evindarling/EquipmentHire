<!--
  Author: Evin Darling (C00144257)
  Date: March 2017
  Description: HTML for the menubar used throughout the site
-->
<link rel="stylesheet" type="text/css" href="/files/mainmenu.css">
<!--Unordered list of links with dropdowns  -->
<ul>
  <li><a href="/hireequipment.html.php">Hire Equipment</a></li>
  <li><a href="#">Return Equipment</a></li>
  <li class="dropdown">
  <a href="/databasemanagement.html.php" class="dropbtn">Database Management</a>
  <div class="dropdown-content">
    <a href="/database-management/equipment-type-management/equipmenttypemanagement.html.php">
       Manage Equipment Type</a>
    <a href="#">Manage Equipment Items</a>
    <a href="#">Manage Customers</a>
    <a href="#">Manage Staff</a>
    <a href="#">Manage Suppliers</a>
  </div>
  </li>
  <li><a href="#">Stock Control</a></li>
  <li><a href="#">Make a Payment</a></li>
  <li class="dropdown">
  <a href="/reportsmenu.html.php" class="dropbtn">Reports Menu</a>
  <div class="dropdown-content">
    <a href="/reports/equipmenthiredreport.html.php">
    Equipment Hired Report</a><a href="#">Payments Received Report</a>
  </div>
  </li>
</ul>



