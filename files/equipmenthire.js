/**
 * Author: Evin Darling (C00144257)
 * Date: March 2017
 * Description: Javascript file containing all functions used in the equipment hire web app
 */

// Global variables
// Array containing the max characters allowed to be input in the various fields through out the app
var maxChars = {description:100, brand:30, category:30, supplier:30, SCC:6, rental:5, qtyItems:5, qtyHired:5,
                cost:5, condition:15, status:11, surname:20, firstName:20, street:30, town:30, county:15,
                phone:20, creditLimit: 10, balance: 10, price:6, jobTitle:30, loginName:20, password:20};

// Error strings used in validation throughout the app
var errorLong      = "Invalid input - Acceptable characters: English letters, digits 0-9, special characters"
                     + " ,./-_+#*'\"() and spaces. Max characters: ";
var errorShort     = "Invalid input - Acceptable characters: English letters, digits 0-9, special characters"
                     + " ,./-_&*() and spaces. Max characters: ";
var errorCatCode   = "Invalid input - Supplier Catalogue Code must be of the format: AAA123";
var errorDigits    = "Invalid input - Acceptable characters: digits 0-9.  Max digits: ";
var errorNoOfDays  = "Invalid input - Please enter a positive number of days between 1 and 30";
var errorLowCredit = "Error: Customer does not have enough credit";

/**
 * Populates equipment type form elements based on listbox selection
 */
function populateEquipTypeForm() {
    var sel = document.getElementById("listboxEquipTypeForm");
    var result;
    result = sel.options[sel.selectedIndex].value;
    var details = result.split(',');
    var amendView = !!document.getElementById("amendViewButton");

    if (amendView) { resetLock(); }     // Reset lock if user changes listbox selection while editing
    document.getElementById("typeID").value = details[0];
    document.getElementById("description").value = details[1];
    document.getElementById("brand").value = details[2];
    document.getElementById("category").value = details[3];
    document.getElementById("supplier").value = details[4];
    document.getElementById("supplierCatalogueCode").value = details[5];
    document.getElementById("rentalCostPerDay").value = details[6];
    document.getElementById("quantityOfItems").value = details[7];
    document.getElementById("quantityOnHire").value = details[8];
}

/**
 * Populate custDetailsReport element to display details about the customer
 * selected in the listbox
 */
function populateCustDetails() {
    var sel = document.getElementById("listboxCustDetails");
    var result;
    result = sel.options[sel.selectedIndex].value;
    var details = result.split(',');
    document.getElementById("custDetailsReport").innerHTML = "Details: " +
        details[0] + ", " + details[2] + " " + details[1] + ", " +
        details[3] + ", " + details[4] + ", " + details[5] + ".<br>";
}

/**
 * Populate equipTypeDetailsReport element to display details about the
 * equipment type selected in the listbox
 */
function populateEquipTypeDetails() {
    var sel = document.getElementById("listboxEquipType");
    var result;
    result = sel.options[sel.selectedIndex].value;
    var details = result.split(',');
    document.getElementById("equipTypeDetailsReport").innerHTML = "Details: " +
        details[0] + ", " + details[2] + " " + details[1] + ", " +
        details[3] + ", " + details[4] + ", " + details[5] + ".<br>";
}

/**
 * Swap the order of equipment report table to order by hire ID
 */
function dateOrder() {
    document.reportForm.choice.value = "hireDate";
    document.reportForm.submit();
}

/**
 * Swap the order of equipment report table to order by customer ID
 */
function customerIDOrder() {
    document.reportForm.choice.value = "customerID";
    document.reportForm.submit();
}

/**
 * Toggles disabled status of input fields to allow amendments
 */
function toggleLock() {
    if (document.getElementById("amendViewButton").value == "Amend Details") {
        document.getElementById("description").disabled = false;
        document.getElementById("brand").disabled = false;
        document.getElementById("category").disabled = false;
        document.getElementById("supplier").disabled = false;
        document.getElementById("supplierCatalogueCode").disabled = false;
        document.getElementById("rentalCostPerDay").disabled = false;
        document.getElementById("amendViewButton").value = "View Details";
    }
    else {
        document.getElementById("description").disabled = true;
        document.getElementById("brand").disabled = true;
        document.getElementById("category").disabled = true;
        document.getElementById("supplier").disabled = true;
        document.getElementById("supplierCatalogueCode").disabled = true;
        document.getElementById("rentalCostPerDay").disabled = true;
        document.getElementById("amendViewButton").value = "Amend Details";
    }
}

function resetLock() {
    document.getElementById("description").disabled = true;
    document.getElementById("brand").disabled = true;
    document.getElementById("category").disabled = true;
    document.getElementById("supplier").disabled = true;
    document.getElementById("supplierCatalogueCode").disabled = true;
    document.getElementById("rentalCostPerDay").disabled = true;
    document.getElementById("amendViewButton").value = "Amend Details";
}

function menuButton(webpage) {
    window.open(webpage, "_self");
}

/**
 * Display a confirm window with details of the hire
 * @returns {boolean}
 */
function confirmCheckHire() {
    var response;
    var daysToRent = document.getElementById("daysToRent").value;
    var price = document.getElementById("price").innerHTML;
    var dateDue = document.getElementById("dateDue").innerHTML;

    var confirmMsg = "Confirm this hire?\n"
                     + "Days to rent: " + daysToRent + "\n"
                     + "Price: " + price + "\n"
                     + "Date due: " + dateDue;
    response = confirm(confirmMsg);
    return !!response;
}

function confirmCheckWithDetails() {
    var response;
    response = confirm('Are you sure you want to save these changes?');
    if (response) {
        document.getElementById("typeID").disabled = false;
        document.getElementById("description").disabled = false;
        document.getElementById("brand").disabled = false;
        document.getElementById("category").disabled = false;
        document.getElementById("supplier").disabled = false;
        document.getElementById("supplierCatalogueCode").disabled = false;
        document.getElementById("rentalCostPerDay").disabled = false;
        document.getElementById("quantityOfItems").disabled = false;
        document.getElementById("quantityOnHire").disabled = false;
        return true;
    }
    else {
        return false;
    }
}

/**
 * Check if delete is possible for selected equipment. Display confirm window
 * with details of equipment type to be deleted
 * @returns {boolean}
 */
function confirmDelete() {
    var response;
    var id = document.getElementById("typeID").value;
    var desc = document.getElementById("description").value;
    var brand = document.getElementById("brand").value;
    var cat = document.getElementById("category").value;
    var supp = document.getElementById("supplier").value;
    var suppCC = document.getElementById("supplierCatalogueCode").value;
    var rent = document.getElementById("rentalCostPerDay").value;
    var qtyOnHire = document.getElementById("quantityOnHire").value;
    var confirmMsg = "Are you want to delete this equipment type?\n"
        + "ID: "          + id     + "\n"
        + "Description: " + desc   + "\n"
        + "Brand: "       + brand  + "\n"
        + "Category: "    + cat    + "\n"
        + "Supplier: "    + supp   + "\n"
        + "SCC: "         + suppCC + "\n"
        + "Rent / Day: "  + rent   + "\n";
    if (qtyOnHire > 0)              // If there are currently items of this type on hire
    {                               // display error and prevent deletion
        document.getElementById("errDelete").innerHTML = "There are currently items of this type out on hire."
            + " You cannot delete the equipment type until they are returned.";
        return false;
    }
    response = confirm(confirmMsg);
    if (response) {
        document.getElementById("typeID").disabled = false;
        document.getElementById("description").disabled = false;
        document.getElementById("brand").disabled = false;
        document.getElementById("category").disabled = false;
        document.getElementById("supplier").disabled = false;
        document.getElementById("supplierCatalogueCode").disabled = false;
        document.getElementById("rentalCostPerDay").disabled = false;
        document.getElementById("quantityOfItems").disabled = false;
        document.getElementById("quantityOnHire").disabled = false;
        return true;
    }
    else {
        return false;
    }
}

/**
 * Calculate and display price of a hire given a number of days and price per day
 * and also the date the equipment will be due back given the number of days it
 * is to be hired.
 * @param pricePerDay Price to rent selected item per day
 * @param itemsAvailableCheck Check for whether items of this type are available
 * @param customerCredit Customers credit limit
 * @returns {boolean}
 */
function calcPriceAndDate(pricePerDay, itemsAvailableCheck, customerCredit, customerBalance) {
    var daysToRent = document.getElementById("daysToRent").value;
    var price = daysToRent * pricePerDay;
    var day = 86400000;
    var todaysDate = Date.now();
    var balAfter = customerBalance + price;
    if (balAfter > customerCredit)
    {
        document.getElementById("errLowCredit").innerHTML = errorLowCredit;
    }
    else if (balAfter <= customerCredit)
    {
        document.getElementById("errLowCredit").innerHTML = "";
    }
    if (!validateNoOfDaysInput(daysToRent))     // Validate input for no. of days
    {
        disableHireButtons();                   // Disable hire buttons if invalid input
        document.getElementById("errNoOfDays").innerHTML = errorNoOfDays; // Display error message
        return false;
    }
    else if (itemsAvailableCheck === 1 && balAfter < customerCredit)
    {
        enableHireButtons();                    // If items are available, enable hire buttons
    }
    document.getElementById("errNoOfDays").innerHTML = "";
    var dateDue = new Date(todaysDate + (daysToRent * day));
    var dateDueString = dateDue.getDate() + "/" + (dateDue.getMonth() + 1) + "/" + dateDue.getFullYear();
    document.getElementById("price").innerHTML = price + " euro";
    document.getElementById("dateDue").innerHTML = dateDueString;
    document.getElementById("paymentPrice").value = price;
    document.getElementById("paymentNoOfDays").value = daysToRent;
    document.getElementById("balancePrice").value = price;
    document.getElementById("balanceNoOfDays").value = daysToRent;
    document.getElementById("balAfter").innerHTML = balAfter;
}

/**
 * Validate no. of days input is a number between 1 and 30
 * @param daysToRent No. of days selected for hire
 * @returns {boolean}
 */
function validateNoOfDaysInput(daysToRent) {
    return !(daysToRent === "" || checkForError(daysToRent, 1) || daysToRent < 1 || daysToRent > 30);
}

/**
 * Enables the hire buttons
 */
function enableHireButtons() {
    document.getElementById("makeAPayment").disabled = false;
    document.getElementById("hireWithBalance").disabled = false;
}

/**
 * Disables the hire buttons
 */
function disableHireButtons() {
    document.getElementById("makeAPayment").disabled = true;
    document.getElementById("hireWithBalance").disabled = true;
}

/**
 * Check if character is an English letter
 * @param c Character to be validated
 * @returns Null if not a character
 */
function checkLetter(c) {
    c = c.toUpperCase();

    return c.match(/[A-Z]/i);
}

/**
 * Check if character is a digit between 0-9
 * @param c Character to be validated
 * @returns Null if not a digit
 */
function checkDigit(c) {
    return c.match(/[0-9]/i)
}

/**
 * Check if character is one of the specified
 * @param c Character to be validated
 * @param field Switch Case to use
 * @returns Null if character does not match any specified
 */
function checkSpecialChar(c, field) {
    switch (field) {
        case 0:         // equipment type/item: description.
            return c.match(/[ ,./-_+#*()'"]/i);
        case 1:         // Add equipment type: brand, category, supplier
            return c.match(/[ ,./-_&*()]/i);
        case 2:         // customer: street/town/county
            return c.match(/[ .,#]/i);
        case 3:         // customer: phone no
            return c.match(/[ -()+]/i);
    }
}

/**
 * Check whether a character is at least an English letter, digit or
 * specified special character
 * @param c Character to be validated
 * @param field Switch Case to use in checkSpecialChar
 * @returns {boolean} True if is at least one of the three types
 */
function checkAll(c, field) {
    
    var fail = 0;

    if (checkLetter(c) === null) { fail++; }
    if (checkDigit(c) === null) { fail++; }
    if (checkSpecialChar(c, field) === null) { fail++; }
    return fail != 3;
}

/**
 * Validates a variety of input types used in forms throughout
 * the web app.
 * @param str String to validate
 * @param checkType Switch Case to use
 * @param type Switch Case to use in checkAll()
 * @returns {boolean} True if invalid
 */
function checkForError(str, checkType, type) {
    var fail = 0;

    switch (checkType) {
        case 0:
            for (var i = 0; i < str.length; i++)
            {
                if (!checkAll(str.charAt(i), type))
                {
                    return true;
                }
            }
            return false;
        case 1:
            for (var i = 0; i < str.length; i++)
            {
                if (checkDigit(str.charAt(i)) === null)
                {
                    fail++;
                }
            }
            return (fail > 0);
        case 2:
            for (var i = 0; i < (maxChars['SCC'] / 2); i++)
            {
                if (checkLetter(str.charAt(i)) === null)
                {
                    fail++;
                }
            }
            for (i === i; i < maxChars['SCC']; i++)
            {
                if (checkDigit(str.charAt(i)) === null)
                {
                    fail++;
                }
            }
            return (fail > 0);
    }
}

/**
 * Validate length of a string is withing allowed character limit
 * @param str String to validate
 * @param maxLen Length to validate string against
 * @returns {boolean} True if less than max characters allowed
 */
function validateLength(str, maxLen) {
    return str.length <= maxLen;
}

/**
 * Validate length of Supplier Catalogue Code
 * @param str String to validate
 * @param maxLen Length to validate string against
 * @returns {boolean} True if string equals specified length
 */
function validateLengthSCC(str, maxLen) {
    return (str.length === maxLen);
}

/**
 * Runs validation tests for entire add/amend equipment type form
 * and updates HTML elements as relevant. Displays confirm window
 * for user if all inputs are valid.
 * @returns {boolean}
 */
function confirmCheckAddEquipType() {
    var response;
    var id = document.getElementById("typeID").value;
    var desc = document.getElementById("description").value;
    var brand = document.getElementById("brand").value;
    var cat = document.getElementById("category").value;
    var supp = document.getElementById("supplier").value;
    var suppCC = document.getElementById("supplierCatalogueCode").value;
    var rent = document.getElementById("rentalCostPerDay").value;
    var error = false;
    var confirmMsg = "Are you want to add these details?\n"
                     + "ID: "          + id     + "\n"
                     + "Description: " + desc   + "\n"
                     + "Brand: "       + brand  + "\n"
                     + "Category: "    + cat    + "\n"
                     + "Supplier: "    + supp   + "\n"
                     + "SCC: "         + suppCC + "\n"
                     + "Rent / Day: "  + rent   + "\n";

    if (checkForError(desc, 0, 0) === true || validateLength(desc, maxChars["description"]) === false)
    {
        document.getElementById("errDesc").innerHTML = errorLong + maxChars["description"];
        error = true;
    } else { document.getElementById("errDesc").innerHTML = ""; }

    if (checkForError(brand, 0, 1) === true || validateLength(brand, maxChars["brand"]) === false)
    {
        document.getElementById("errBrand").innerHTML = errorShort + maxChars["brand"];
        error = true;
    } else { document.getElementById("errBrand").innerHTML = ""; }

    if (checkForError(cat, 0, 1) === true || validateLength(cat, maxChars["category"]) === false)
    {
        document.getElementById("errCat").innerHTML = errorShort + maxChars["category"];
        error = true;
    } else { document.getElementById("errCat").innerHTML = ""; }

    if (checkForError(supp, 0, 1) === true || validateLength(supp, maxChars["supplier"]) === false)
    {
        document.getElementById("errSupp").innerHTML = errorShort + maxChars["supplier"];
        error = true;
    } else { document.getElementById("errSupp").innerHTML = ""; }

    if (checkForError(suppCC, 2) === true || validateLengthSCC(suppCC, maxChars["SCC"]) === false)
    {
        document.getElementById("errSCC").innerHTML = errorCatCode;
        error = true;
    } else { document.getElementById("errSCC").innerHTML = ""; }

    if (checkForError(rent, 1) === true || validateLength(rent, maxChars["rental"]) === false)
    {
        document.getElementById("errRent").innerHTML = errorDigits + maxChars["rental"];
        error = true;
    } else { document.getElementById("errRent").innerHTML = ""; }

    if (!error)
    {
        response = confirm(confirmMsg);
        if (response) {
            document.getElementById("typeID").disabled = false;
            document.getElementById("description").disabled = false;
            document.getElementById("brand").disabled = false;
            document.getElementById("category").disabled = false;
            document.getElementById("supplier").disabled = false;
            document.getElementById("supplierCatalogueCode").disabled = false;
            document.getElementById("rentalCostPerDay").disabled = false;
            return true;
        }
        else {
            return false;
        }
    }
    else
    {
        return false;
    }
}