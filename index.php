<?php
    require('dbconnect.php');
    include 'layout/header.php';

    $sql = "SELECT * FROM posts";
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll();
?>

<style>
    <?php include 'css/style.css'; ?>
</style>

<title>Inlägg</title>

<body>
    <div class="posts-container">
        <?php foreach($posts as $post){ ?>
            <div class="posts-wrapper">
                <h1 class="title"><?=$post['title']?></h1>
                <h3 class="author"><?=$post['author']?></h3>
                <h4 class="date"><?=$post['published_date']?></h4>
                <p class="content"><?=substr($post['content'], 0, 100) ?></p>
                <a class="link" href="post.php?id=<?=$post['id']?>">Läs mer...</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>