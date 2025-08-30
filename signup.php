<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='index.php';</script>";
    } else {
        // hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            // set session so user is logged in immediately
            $_SESSION['username'] = $name;

            // redirect to main page
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
