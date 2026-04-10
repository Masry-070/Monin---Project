<?php
session_start();
    try {
        $db=new PDO("mysql:host=localhost;dbname=mon-in","root","");
    } catch(PDOException $e) {
        die("Error:".$e->getMessage());
    }

    $id = null;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    }

    $q=$db->prepare("SELECT * FROM posts WHERE user_id=:id");
    $q->bindParam(':id',$_GET['id']);
    $q->execute();
    $posts=$q->fetchAll(PDO::FETCH_ASSOC);

    function getUser($id,$db)
    {
         $q=$db->prepare("SELECT * FROM users WHERE id=$id");
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    $user= getUser($id,$db);

    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $headline = $_POST['headline'];
        $about = $_POST['about'];
        $skills = $_POST['skills'];
        $interests = $_POST['interests'];

        $update = $db->prepare("UPDATE users SET name = ?, headline = ?, about = ?, skills = ?, interests = ? WHERE id = ?");
        $update->execute([$name, $headline, $about, $skills, $interests, $id]);

        header(header:"Location: profile.php");
    }

    if (isset($_POST['delBtn'])) {
        $delPostId = $_POST['post_id'];

        $delPost = $db->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
        $delPost->execute([$delPostId, $_SESSION['user_id']]);
        header("Location: profile.php?id=" . $id);
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
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="profile-body">
    <div class="profile-container">
        <div class="profile-header">
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
        <div class="profile-left"></div>
        <div class="profile-body-container">
            <div class="profile-info">
                <div class="profile-top"></div>
                <div class="profile-content">
                    <img src="<?= $user['avatar'] ?>" class="profile-picture">
                    <h3><?= $user['name'] ?></h3>
                    <p><?= $user['headline'] ?></p>
                    <button id="editBtn" ><i class="bi bi-pencil"></i> Edit Profile</button>
                    <div class="profile-about">
                        <h4>About</h4>
                        <hr>
                        <h5><?= $user['about'] ?></h5>
                    </div>
                </div>
            </div>
            <div class="skills">
                <h3><i class="bi bi-tools"></i> Skills</h2>
                <hr>
                <?php
                $skills=explode(',',$user['skills']);
                ?>
                <div class="skill-container">
                    <?php foreach($skills as $skill):?>
                        <div class="skill"><?= $skill ?></div>
                        <?php endforeach?>
                    
                    
                </div>
            </div>
            <div class="interests">
                <h3><i class="bi bi-heart"></i> Interests</h3>
                <hr>
                <?php
                $interests=explode(',',$user['interests']);
                ?>
                <div class="interests-container">
                    <?php foreach($interests as $interest):?>
                    <div class="interest"><?= $interest ?></div>
                    <?php endforeach?>
                </div>
            </div>
            <div class="posts">
                <h3><i class="bi bi-file-post"></i> Posts</h3>
                 <?php foreach($posts as $post):
                $user=getUser($post['user_id'],$db)?>
                <hr>
                <div class="post">
                    <p><?=$post['created_at'] ?></p>
                    <h4 id="post-text"><?php echo $post['content']?></h4>
                </div>
                <div class="likesp">
                    <button class="like-btn"><i class="bi bi-hand-thumbs-up"></i></button>
                    <p>5</p>
                    <form method="POST" action="">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <button name="delBtn" class="del-btn"><i class="bi bi-trash"></i> Delete</button>
                    </form>
                </div>
                <?php endforeach?>
            </div>
        </div>
        <div class="profile-right"></div>
    </div>

    <div id="formPopup">
        <h1 id="form-h1">Edit Your Profile</h1>
        <hr>
        <form class="updateForm" method="POST" action="">
            <label for="name">Name</label>
            <input id="inputName" type="text" name="name" placeholder="Johannes Willem">

            <label for="headline">Headline</label>
            <input type="text" name="headline" placeholder="Product Manager; ex-Google">

            <label for="about">About</label>
            <input type="text" name="about" placeholder="I own google">

            <label for="about">Skills (gescheiden door komma's)</label>
            <input type="text" name="skills" placeholder="PHP">
            
            <label for="about">Interests (gescheiden door komma's)</label>
            <input type="text" name="interests" placeholder="Fishing">

            <button type="submit" name="save">Save</button>
            <button id="closeBtn">Close</button>
        </form>
    </div>

    <script src="js/profile.js"></script>
    <script src="js/posts.js"></script>
</body>
</html>