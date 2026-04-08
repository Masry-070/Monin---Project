<?php
session_start();
    try {
        $db=new PDO("mysql:host=localhost;dbname=mon-in","root","");
    } catch(PDOException $e) {
        die("Error:".$e->getMessage());
    }

    $q=$db->prepare("SELECT * FROM posts ORDER BY created_at DESC");
    $q->execute();
    $posts=$q->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    };

    if (isset($_POST['newPost'])) {
        $postTxt = $_POST['newPostTxt'];
        $userId = $_SESSION['user_id'];

        $newPost = $db->prepare("INSERT INTO posts (user_id, content, created_at) VALUES (?,?,NOW())");
        $newPost->execute([$userId, $postTxt]);

        header(header:"Location: posts.php");
    }

    $user = null;
    if (isset($_SESSION['user_id'])) {
        $user = getUser($_SESSION['user_id'], $db);
    }

    function getUser($id,$db)
    {
         $q=$db->prepare("SELECT * FROM users WHERE id=$id");
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="js/posts.js" defer></script>
</head>
<body>
    <div class="posts-container">
        <div class="posts-header">
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
        <div class="posts-topbody">
            <form method="POST" action="">
                <input type="text" name="newPostTxt" required placeholder="Type here your post:">
                <button type="submit" name="newPost">Submit</button>
            </form>
            <h2 id="topH2">Recent Posts</h2>
        </div>
        <div class="posts-body">

            <?php foreach($posts as $post):
                $user=getUser($post['user_id'],$db)?>

            <div id="posts" class="post-1">
                <div class="pfp-info">
                    <a href="profile.php?id=<?= $post['user_id'] ?>">
                        <img src="<?=$user['avatar'] ?>" alt="profilePicture">
                    </a>
                    <div class="profile-text">
                        <h3><?= $user['name'] ?></h3>
                        <p><?=$user['headline'] ?></p>
                        <p><?= date('d-m-Y H:i', strtotime($post['created_at'])) ?></p>
                    </div>
                </div>
                <div class="post-info">
                
                <h4 id="post-text"><?php echo $post['content']?></h4>
                <div class="likes">
                    <button><i class="bi bi-hand-thumbs-up"></i></button>
                    <p>5</p>
                </div>
                </div>
            </div>
                <?php endforeach?>
        </div>
    </div>


</body>
</html>