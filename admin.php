<?php
require('dbconnect.php');
include 'layout/header.php';

if(isset($_POST['deletePostBtn'])){
    $sql = "
        DELETE FROM posts
        WHERE id= :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_POST['postId']);
    $stmt->execute();
}

$message = "";
if(isset($_POST['addPostBtn'])) {

    if($_POST['title'] === "" ){
        $message = '
            <div class="error-msg"> 
                Vänligen fyll i alla fält!
            </div>
        ';   
    } else if($_POST['content'] === "" ){
        $message = '
            <div class="error-msg"> 
                Vänligen fyll i alla fält!
            </div>
        ';
    } else if($_POST['author'] === "" ){
        $message = '
            <div class="error-msg"> 
                Vänligen fyll i alla fält!
            </div>
        ';
    } else{
        $sql = "
            INSERT INTO posts (title, content, author)
            VALUES (:title, :content, :author)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':content', $_POST['content']);
        $stmt->bindParam(':author', $_POST['author']);
        $stmt->execute();

        $message = '
            <div class="success-msg"> 
                Nytt inlägg är skapat!
            </div>
        ';
    }
}

$sql = "SELECT * FROM posts";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll();
?>


<style>
    <?php include 'css/style.css'; ?>
</style>

<title>Admin</title>

<body>
    <div class="container">
        <div class="row">
            <div class="offset-3 col-6">
                <div class="new-post-form">
                    <h3 class="rubrik">Skapa nytt inlägg</h3>

                    <?=$message ?>

                    <!-- nytt posts steg 2 -->
                    <form action="" method="POST">
                        <div>
                            <input type="text" class="form-control inputfield" name="title" placeholder="Title" aria-label="Recipient's title">
                            <!-- <input type="text" class="form-control" name="content" placeholder="Content" aria-label="Recipient's content"> -->
                            <textarea name="content" class="form-control inputfield" placeholder="Content" aria-label="Recipient's content" cols="30" rows="6"></textarea>
                            <input type="text" class="form-control inputfield" name="author" placeholder="Author" aria-label="Recipient's author">
                            <input class="btn btn-secondary add-btn" type="submit" name="addPostBtn" id="button-addon2" value="Add">
                        </div>
                    </form>
                </div>
                

                <h3 class="rubrik">Posts List</h3>
                <ul class="list-group">
                    <!-- visar alla posts steg 1 -->
                    <?php foreach($posts as $post) : ?> 
                        <li class="list-group-item list-admin">
                            <p class="info-admin">
                                <?=htmlentities($post['title'])?> -
                                <?=htmlentities($post['published_date'])?> 
                            </p>
                            
                            
                            <!-- update button steg 4 (gör enligt vecka fyra inspelning)-->
                            <form action="update-post.php" method="GET" class="update">
                                <input name="postId" type="hidden" value="<?=htmlentities($post['id'])?>">
                                <input class="btn btn-danger" type="submit" value="Update">
                            </form>

                            <!-- delete button steg 3 --> 
                            <form action="" method="POST">
                                <input name="postId" type="hidden" value="<?=htmlentities($post['id'])?>">
                                <input name="deletePostBtn" type="submit" value="Delete" class="btn btn-warning">
                            </form>

                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>
</body>
</html>