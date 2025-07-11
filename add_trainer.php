<?php
$conn = mysqli_connect("localhost", "root", "", "project");

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];

    if (!empty($name) && !empty($email) && !empty($password) && !empty($username)) {
        $check = mysqli_query($conn, "SELECT * FROM trainers WHERE email = '$email'");
        if (mysqli_num_rows($check) > 0) {
            $message = "❌ Email already exists.";
        } else {
            $query = "INSERT INTO trainers (name, email, username, password) 
                      VALUES ('$name', '$email', '$username', '$password')";
            if (mysqli_query($conn, $query)) {
                $message = "✅ Trainer added successfully! Redirecting...";
                $success = true;
                echo "<script>
                        setTimeout(function() {
                          window.location.href = 'admin.php';
                        }, 3000);
                      </script>";
            } else {
                $message = "❌ Error adding trainer.";
            }
        }
    } else {
        $message = "❌ All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Trainer</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    input[type="submit"] {
      background: linear-gradient(to right, #4facfe, #00f2fe);
      border: none;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }

    .message {
      text-align: center;
      margin-top: 15px;
      color: <?= $success ? 'green' : 'red' ?>;
      font-weight: 500;
    }
  </style>
</head>
<body>

  <form class="form-card" method="POST">
      <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover; margin-left:180px">

    <h2>Add Trainer</h2>

    <input type="text" name="name" placeholder="Trainer Name" required />
    <input type="text" name="username" placeholder="Trainer Username" required />
    <input type="email" name="email" placeholder="Trainer Email" required />
    <input type="text" name="password" placeholder="Password" required />

    <input type="submit" value="Add Trainer" />
    <div class="message"><?= $message ?></div>
  </form>

</body>
</html>
