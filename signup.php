<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

  
    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match!'); window.location='signup.html';</script>";
        exit();
    }

    
    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists! Please log in or use another email.'); window.location='signup.html';</script>";
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Sign up successful! You can now log in.'); window.location='login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location='signup.html';</script>";
    }
}
?>
