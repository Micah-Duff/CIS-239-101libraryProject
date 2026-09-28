<?php
// File Created by Micah Duff

// convert user input to timestamps
function convertDates($returnString, $dueString)
{
    return [
        'return' => strtotime($returnString),
        'due' => strtotime($dueString)
    ];
}

// use date_diff to compare and return due date info
function compareDates($returnString, $dueString)
{
    $returnDate = date_create($returnString);
    $dueDate = date_create($dueString);
    $finalDate = date_diff($returnDate, $dueDate);
    return date_interval_format($finalDate, '%y years, %m months, and %d days');
}

// use if statement to change context based on returned book due date info
function checkBook($returnString, $dueString)
{
    $timestamps = convertDates($returnString, $dueString);

    if ($timestamps['return'] > $timestamps['due']) {
        return "This book is overdue by " . compareDates($returnString, $dueString) . ".";
    } elseif ($timestamps['return'] < $timestamps['due']) {
        return "This book is due in " . compareDates($returnString, $dueString) . ".";
    } else {
        return "This book is due today.";
    }
}
// if statement to change alert context
if (!empty($_GET['returnDate']) && !empty($_GET['dueDate'])) {
    $returnDate = $_GET['returnDate'];
    $dueDate    = $_GET['dueDate'];
    $timestamps = convertDates($returnDate, $dueDate);

    if ($timestamps['return'] > $timestamps['due']) {
        $alertClass = 'alert-danger';
    } elseif ($timestamps['return'] < $timestamps['due']) {
        $alertClass = 'alert-success';
    } else {
        $alertClass = 'alert-warning';
    }

    echo '<div class="container mt-4">';
    echo '  <div class="row justify-content-center">';
    echo '    <div class="col-md-6">';
    echo '      <div class="alert ' . $alertClass . ' shadow">';
    echo '        <p class="mb-1">Return Date: ' . date('F j, Y', $timestamps['return']) . '</p>';
    echo '        <p class="mb-1">Due Date: ' . date('F j, Y', $timestamps['due']) . '</p>';
    echo '        <hr>';
    echo '        <p class="mb-0 fw-bold">' . checkBook($returnDate, $dueDate) . '</p>';
    echo '      </div>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
}
