

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$conn = mysqli_connect("localhost", "root", "", "project");

$message = "";
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if email exists
    $result = mysqli_query($conn, "SELECT * FROM trainers WHERE email = '$email'");
    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(16));
        mysqli_query($conn, "UPDATE trainers SET verify_token='$token' WHERE email='$email'");
        $resetLink = "http://localhost/project1/reset_password.php?token=$token&email=$email";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username =  'pintooprajapati027@gmail.com';// ✅ Replace
            $mail->Password =    'mekp ztuy rcmg bjkt';  // ✅ Replace
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('pintooprajapati027@gmail.com', 'Smart Calendar');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body = "
                <h3>Hello,</h3>
                <p>Click below to reset your password:</p>
                <a href='$resetLink'>$resetLink</a>
                <p>This link is valid for one-time use.</p>
            ";

            $mail->send();
            $success = true;
            $message = "✅ Reset link sent! Please check your email.";
        } catch (Exception $e) {
            $message = "❌ Mail send failed. Try again later.";
        }
    } else {
        $message = "❌ Email not found in our records.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
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
      margin: 8px 0;
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
    }
  </style>
</head>
<body>

  <form class="login-card" method="POST" onsubmit="return validateEmail()">
    <img src="download.png" alt="Anudeep Logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover; margin-left:170px;">

    <h2>Forgot Password</h2>

    <input type="email" name="email" id="email" placeholder="Enter your email" required />
    <button type="submit">Send Reset Link</button>

    <?php if ($message): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>
  </form>

  <script>
    function validateEmail() {
      const email = document.getElementById("email").value.trim();
      if (!email) {
        alert("❌ Please enter your email.");
        return false;
      }
      // Email format validation
      const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!pattern.test(email)) {
        alert("❌ Please enter a valid email.");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
