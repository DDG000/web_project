
<?php
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
  // Get the email address from the form input
  $email = $_POST['email'];

  // Prepare the query with a placeholder for the email
  $sql = "SELECT id, first_Name, last_Name, telephone, email, street_Address, city 
          FROM customer_information1 
          WHERE email = ?"; // Use a question mark placeholder
  $stmt = $connection->prepare($sql);

  // Bind the email value to the placeholder
  $stmt->bind_param("s", $email); // Bind the single variable to the placeholder

  // Execute the query
  $stmt->execute();

  // Rest of the code remains the same
  // ...
    // Check if there are results
    if ($stmt->num_rows > 0) {
        // Fetch the single row of data
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Output the data in an HTML table
        echo '<html>';
        echo '<head><title>Customer Information</title></head>';
        echo '<body>';
        echo '<table>';
        echo '<tr><th>ID</th><td>' . $row['id'] . '</td></tr>';
        echo '<tr><th>First Name</th><td>' . $row['first_Name'] . '</td></tr>';
        echo '<tr><th>Last Name</th><td>' . $row['last_Name'] . '</td></tr>';
        echo '<tr><th>Telephone</th><td>' . $row['telephone'] . '</td></tr>';
        echo '<tr><th>Email</th><td>' . $row['email'] . '</td></tr>';
        echo '<tr><th>Street Address</th><td>' . $row['street_Address'] . '</td></tr>';
        echo '<tr><th>City</th><td>' . $row['city'] . '</td></tr>';
        echo '</table>';
        echo '</body>';
        echo '</html>';
    } else {
        echo "No results found for email: " . $email;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$connection->close();



?>
