<?php


include 'config.php';



// Assume customerId is passed as a parameter (replace it with your actual logic)
$customerId = $_GET['customerId'];

// Prepare and execute a SQL query
$sql = "SELECT * FROM customer_information1 WHERE customer_id = $customerId";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $row = $result->fetch_assoc();

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // No data found
    echo json_encode(['error' => 'No data found']);
}

// Close the database connection
$conn->close();
?>
