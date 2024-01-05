<?php
// Include the database configuration file
include 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve data from the form
$email = $_POST['echeck'];
$prescriptionDate = date('Y-m-d');

// Check if the file field is set and not empty
if (isset($_FILES['prescriptionPhoto']) && $_FILES['prescriptionPhoto']['error'] == UPLOAD_ERR_OK) {
    // Get the uploaded file information
    $fileName = $_FILES['prescriptionPhoto']['name'];
    $fileTmpName = $_FILES['prescriptionPhoto']['tmp_name'];
    $fileSize = $_FILES['prescriptionPhoto']['size'];
    $fileType = $_FILES['prescriptionPhoto']['type'];

    // Validate the file type (optional)
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
        exit;
    }

    // Move the uploaded file to the desired directory
    $targetDir = "uploads/"; // Specify your upload directory here
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        // File uploaded successfully

        // Step 1: Get Customer ID based on Email
        $query = "SELECT id FROM customer_information1 WHERE email = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("s", $email);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($customerID);

        // Fetch the result
        if ($statement->fetch()) {
            // Step 2: Insert data into the prescription_records table
            $insertSQL = "INSERT INTO prescription_records1(prescription_date, customer_id, image) VALUES (?, ?, ?)";
            $insertStatement = $connection->prepare($insertSQL);
            $insertStatement->bind_param("sis", $prescriptionDate, $customerID, $fileName); // Bind the file name

            if ($insertStatement->execute()) {
                echo "Prescription record inserted successfully!";
            } else {
                echo "Error inserting prescription record: " . $insertStatement->error;
            }

            $insertStatement->close();
        } else {
            echo "Customer not found";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Please select a prescription photo to upload.";
}

// Close the database connection
$statement->close();
$connection->close();
?>
