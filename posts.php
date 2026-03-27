<?php
    try {
        $db=new PDO("mysql:host=localhost;dbname=mon-in","root","");
    } catch(PDOException $e) {
        die("Error:".$e->getMessage());
    }

    $q=$db->prepare("SELECT * FROM posts");
    $q->execute();
    $posts=$q->fetchAll(PDO::FETCH_ASSOC);

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
</head>
<body>
    <div class="posts-container">
        <div class="posts-header">
                <h1>MonIn</h1>
            <div class="header-nav">
                <a href="posts.php"><i class="bi bi-house"></i> Home</a>
                <a href="profile.php"><i class="bi bi-person"></i> Profile</a>
                <a href="login.php"><i class="bi bi-box-arrow-in-left"></i> Login</a>
            </div>
        </div>
        <div class="posts-topbody">
            <h2>Recent Posts</h2>
        </div>
        <div class="posts-body">

            <?php foreach($posts as $post):
                $user=getUser($post['user_id'],$db)?>

            <div class="post-1">
                <div class="pfp-info">
                    <a href="profile.php?id=<?= $post['user_id'] ?>">
                        <img src="<?=$user['avatar'] ?>" alt="profilePicture">
                    </a>
                    <div class="profile-text">
                        <h3><?= $user['name'] ?></h3>
                        <p><?=$user['headline'] ?></p>
                        <p><?=$post['created_at'] ?></p>
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


    <script src="js/script.js"></script>
</body>
</html>