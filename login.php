<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

  
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;

            echo "<script>
                alert('Login successful!');
                window.location.href='index.html';
            </script>";
        } else {
            echo "<script>
                alert('Incorrect password!');
                window.location.href='login.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('No account found with that email!');
            window.location.href='login.html';
        </script>";
    }

    $stmt->close();
}
$conn->close();
?>
