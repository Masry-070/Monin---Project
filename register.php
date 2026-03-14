<?php ?>

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
            <h1>MonIn</h1>
            <div class="header-nav">
                <a href="posts.php"><i class="bi bi-house"></i> Home</a>
                <a href="profile.php"><i class="bi bi-person"></i> Profile</a>
                <a href="login.php"><i class="bi bi-box-arrow-in-left"></i> Login</a>
            </div>
        </div>
        <div class="login-left"></div>
        <div class="login-body">
            <div class="login-top">
                <img src="img/IN.jpg" alt="IN">
                <h2>Join LinkedPro</h2>
                <p>Create your professional profile</p>
            </div>
            <div class="login-form">
                <form action="">
                    <label for="fName">Full Name *</label>
                    <input type="text" id="fName" name="name" required>

                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" required>

                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required>

                    <label for="cPassword">Confirm Password *</label>
                    <input type="password" id="cPassword" name="password" required>
                    
                    <button type="submit">Create Account</button>
                </form>
            </div>
            <hr>
            <div class="login-bottom">
                <h4>Already have an account? <a href="login.php">Sign Up</a></h4>
            </div>
        </div>
        <div class="login-right"></div>
    </div>
    
</body>
</html>