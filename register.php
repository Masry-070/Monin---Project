<?php
    $message = "";
    try {
        $db=new PDO("mysql:host=localhost;dbname=mon-in","root","");
    } catch(PDOException $e) {
        die("Error:".$e->getMessage());
    }

    if (isset($_POST["register"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cPassword = $_POST["cPassword"];

        if ($password != $cPassword) {
            $message = "Passwords don't match!";
        } else if(strlen($password) < 6){
            $message = "Password needs to be atleast 6 characters long!";
        } else {
            $verify = $db->prepare("INSERT INTO `users`(`name`, `email`, `password`) VALUES (?,?,?)");
            $verify->execute([$name, $email, $password]);
            $message = "You can now Login through the login page!";
            header(header:"Location: login.php");
        }
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    };
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
<body class="reg-body">

    <div class="login-container">
        <div class="login-header">
            <button id="switch-btn"><h1>MonIn</h1></button>
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
                <h2>Join LinkedPro</h2>
                <p>Create your professional profile</p>
                <p><?php echo $message ?></p>
            </div>
            <div class="login-form">
                <form method="POST" action="">
                    <label for="fName">Full Name *</label>
                    <input type="text" id="fName" name="name" required>

                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" required>

                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" minlength="6" required>

                    <label for="cPassword">Confirm Password *</label>
                    <input type="password" id="cPassword" name="cPassword" required>
                    
                    <button name="register" type="submit">Create Account</button>
                </form>
            </div>
            <hr>
            <div class="login-bottom">
                <h4>Already have an account? <a href="login.php">Sign Up</a></h4>
            </div>
        </div>
        <div class="login-right"></div>
    </div>
    <script src="js/posts.js" defer></script>
</body>
</html>