<?php
session_start();


if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}


include 'db_connect.php';
$email = $_SESSION['email'];


$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personalized Study Planner</title>
  <link rel="stylesheet" href="style.css"> <!-- your CSS file -->
</head>
<body>
  <header>
    <h1>Welcome to Your Personalized Study Planner</h1>
    <p>Hello, <strong><?php echo htmlspecialchars($user['name'] ?? $email); ?></strong> 👋</p>
    <a href="logout.php">Logout</a>
  </header>

  <main>
    <section>
      <h2>Your Planner</h2>
      <p>Start organizing your subjects, schedule, and study goals here.</p>
      
    </section>
  </main>
</body>
</html>
