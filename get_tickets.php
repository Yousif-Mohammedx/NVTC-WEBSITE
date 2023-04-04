<?php
session_start();

// Retrieve ticket data from session
$tickets = isset($_SESSION['tickets']) ? $_SESSION['tickets'] : array();

// Check if a ticket ID was provided in the request
if (isset($_GET['id'])) {
    // Find the ticket with the matching ID
    $id = $_GET['id'];
    $index = array_search($id, array_column($tickets, 'id'));

    if ($index !== false) {
        // Remove the ticket from the array
        array_splice($tickets, $index, 1);

        // Update session with modified ticket data
        $_SESSION['tickets'] = $tickets;
    }
}

// Return ticket data as JSON
header('Content-Type: application/json');
echo json_encode($tickets);
?>
