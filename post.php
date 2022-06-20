<?php
    require('dbconnect.php');
    include 'layout/header.php';

    $sql = "
        SELECT * FROM posts
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $post = $stmt->fetch();
?>

<style>
    <?php include 'css/style.css'; ?>
</style>

<title>Post</title>

<body>

    <div class="posts-container">
        <div class="wrapper-single-post">
            <h1 class="title"><?=$post['title']?></h1>
            <h3 class="author"><?=$post['author']?></h3>
            <h4 class="date"><?=$post['published_date']?></h4>
            <p class="content-full"><?=$post['content']?></p>
            <a class="link link-single-post" href="index.php">Tillbaka</a>
        </div>
    </div>
     
</body>
</html>