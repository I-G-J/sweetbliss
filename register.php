<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. <a href='login.php'>Login Now</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "sweetbliss");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Account created successfully!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('❌ Error: " . $conn->error . "');</script>";
    }
}
$conn->close();
?>
