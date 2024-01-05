<?php

include 'config.php';

$userEmail = $_POST["regemail"];
$userPassword = $_POST["regpassword"];

$sql = "SELECT password FROM customer_information1 WHERE email = '$userEmail'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedHashedPassword = $row["password"];

    if (password_verify($userPassword, $storedHashedPassword)) {

        // Extract the username part of the email address
        $username = strstr($userEmail, '@', true);

        switch ($username) {
            case 'Manager':
                header("Location: Manager.html");
                exit();
            case 'Admin':
                header("Location: Admin.html");
                exit();
            case 'employee':
                header("Location: employee.html");
                exit();

            default:
            header("Location: customer.html");;
                exit();
        }
    } else {
        echo '<script>alert("Incorrect password. Please try again.");</script>';
        echo '<script>window.location.href = "login.html";</script>';
        exit();

    }
} else {

    echo '<script>alert("Incorrect password. Please try again.");</script>';
    echo '<script>window.location.href = "login.html";</script>';
    exit();


}

?>
