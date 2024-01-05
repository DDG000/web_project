<?php
include 'config.php';

// Prepare and execute a SQL query to get prescription data
$sql = "SELECT prescription_id, prescription_date, customerId FROM prescription_records1";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $prescriptions = [];
    while ($row = $result->fetch_assoc()) {
        $prescriptions[] = $row;
    }

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($prescriptions);
} else {
    // No data found
    echo json_encode(['error' => 'No prescriptions found']);
}

// Close the database connection
$conn->close();
?>
