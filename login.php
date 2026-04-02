<?php
    session_start();
    $message = "";
    try {
        $db=new PDO("mysql:host=localhost;dbname=mon-in","root","");
    } catch(PDOException $e) {
        die("Error:".$e->getMessage());
    }

    if (isset($_POST["login"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        $verify = $db->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $verify->execute([$email, $password]);
        $user=$verify->fetch();
        if ($verify->rowCount() > 0) {
            $message = "Succesfully Loggedin";
            $_SESSION['user_id']=$user['id'];
            header(header:"Location: posts.php");
        } else {
            $message = "Incorrect Email or Password!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="login-container">
        <div class="login-header">
            <a href="posts.php"><h1>MonIn</h1></a>
            <div class="header-nav">
                <a href="posts.php"><i class="bi bi-house"></i> Home</a>
                <a href="profile.php"><i class="bi bi-person"></i> Profile</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="">
                        <button name="logout" class="logout-button"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                <?php else: ?>
                    <a href="login.php"><i class="bi bi-box-arrow-in-left"></i> Login</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="login-left"></div>
        <div class="login-body">
            <div class="login-top">
                <img src="img/IN.jpg" alt="IN">
                <h2>Welcome Back</h2>
                <p>Log in to your account</p>
                <p><?php echo $message ?></p>
            </div>
            <div class="login-form">
                <form method="POST" action="">
                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" required>

                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>

                    <button name="login" type="submit">Sign In</button>
                </form>
            </div>
            <hr>
            <div class="login-bottom">
                <h4>Don't have an account? <a href="register.php">Register</a></h4>
            </div>
        </div>
        <div class="login-right"></div>
    </div>
    
</body>
</html>