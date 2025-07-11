

<?php
$conn = mysqli_connect("localhost", "root", "", "project");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$success = false;

if (isset($_GET['email']) && isset($_GET['token'])) {
  $email = $_GET['email'];
  $token = $_GET['token'];

  $result = mysqli_query($conn, "SELECT * FROM trainers WHERE email='$email' AND verify_token='$token'");
  if (mysqli_num_rows($result) === 1) {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $newPassword = $_POST['new_password'];
      $confirmPassword = $_POST['confirm_password'];

      if ($newPassword === $confirmPassword) {
        $update = "UPDATE trainers SET password='$newPassword', verify_token='' WHERE email='$email'";
        if (mysqli_query($conn, $update)) {
          $message = "✅ Password reset successfully! Redirecting to login...";
          $success = true;
          echo "<script>
                  setTimeout(function() {
                    window.location.href = 'index.php';
                  }, 3000);
                </script>";
        } else {
          $message = "❌ Error updating password. Please try again.";
        }
      } else {
        $message = "❌ Passwords do not match.";
      }
    }

  } else {
    $message = "❌ Invalid or expired reset link.";
  }

} else {
  header("Location: forgot_password.php");
  exit;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-card {
      background: white;
      border-radius: 12px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2a5298;
    }
    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      width: 100%;
      background: linear-gradient(to right, #4facfe, #00f2fe);
      border: none;
      padding: 12px;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
    }
    .message {
      margin-top: 15px;
      text-align: center;
      color: <?= $success ? 'green' : 'red' ?>;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <form class="login-card" method="POST" onsubmit="return validatePassword()">
    <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover; margin-left:170px;">

    <h2>Reset Password</h2>

    <input type="password" name="new_password" id="new_password" placeholder="New Password" required />
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required />

    <button type="submit">Reset Password</button>

    <?php if (!empty($message)): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
  </form>

  <script>
    function validatePassword() {
      const newPass = document.getElementById("new_password").value;
      const confirmPass = document.getElementById("confirm_password").value;

      // if (newPass.length < 6) {
      //   alert("❌ Password should be at least 6 characters.");
      //   return false;
      // }

      if (newPass !== confirmPass) {
        alert("❌ Passwords do not match.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
