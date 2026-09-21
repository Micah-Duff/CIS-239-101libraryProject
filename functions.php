<!-- File Created by: Micah Duff  -->
<?php
$returnDate = $_GET['returnDate'];
$dueDate = $_GET['dueDate'];

// convert user input to timestamps
function convertDates($returnDate,$dueDate) {
    $returnDate = strtotime($returnDate);
    $dueDate = strtotime($dueDate);
    // echo($returnDate . $dueDate); - echo to test values
}

convertDates($returnDate,$dueDate);
?>