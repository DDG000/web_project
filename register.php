<?php

include 'config.php';

$first_Name = $_POST['Fname'];
$last_Name = $_POST['Lname'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$street_Address = $_POST['sadd'];
$city = $_POST['city'];
$userPassword = $_POST["password"];


$emailCheckSQL = "SELECT password FROM customer_information1 WHERE email = '$email'";
$emailCheckResult = $connection->query($emailCheckSQL);

if ($emailCheckResult->num_rows > 0) {
    echo '<script>alert("This Email is already in use. Please try again with a different email.");</script>';
    echo '<script>window.location.href = "login.html";</script>';
    exit();
}



// Hash the password
$hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);


$insertSQL = "INSERT INTO customer_information1 (first_Name, last_Name, telephone, email, street_Address, city, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
$insertStatement = $connection->prepare($insertSQL);
$insertStatement->bind_param("sssssss", $first_Name, $last_Name, $telephone, $email, $street_Address, $city, $hashedPassword);

if ($insertStatement->execute()) {
    
    echo '<script>alert("Account Create Successfully. Please use Alredy User Menu For loging the web page");</script>';
    echo '<script>window.location.href = "login.html";</script>';

} else {
    echo "Insert Data Error: " . $insertStatement->error;
}

$insertStatement->close();
$connection->close();
?>
