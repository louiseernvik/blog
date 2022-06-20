<?php
require('dbconnect.php');
include 'layout/header.php';


$message = "";
if (isset($_POST['updatePostBtn'])){
    
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
        UPDATE posts
        SET title = :title, content = :content, author = :author
        WHERE id =:id
        ";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['postId']);
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':content', $_POST['content']);
        $stmt->bindParam(':author', $_POST['author']);
        $stmt->execute();

        $message = '
            <div class="success-msg"> 
                Uppdatering gjord!
            </div>
        ';
    }
}

$sql = "
    SELECT * FROM posts
    WHERE id =:id
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['postId']);
$stmt->execute();
$post = $stmt->fetch();

?>

<style>
    <?php include 'css/style.css'; ?>
</style>

<title>Update</title>

<div class="container">
    <div class="row">
        <div class="offset-3 col-6">
            
            <div class="new-post-form">
                <h3 class="rubrik">Uppdatera inlägg</h3>

                <form action="" method="POST">
                    <div>
                        <?=$message ?>

                        <label for="input1">Title:</label> <br>
                        <input type="text" class="form-control inputfield" name="title" placeholder="Title" aria-label="Recipient's title"  value="<?=htmlentities($post['title'])?>">
                        
                        <label for="input1">Content:</label> <br>
                        <textarea name="content" class="form-control inputfield" placeholder="Content" aria-label="Recipient's content" cols="30" rows="6"><?=htmlentities($post['content'])?></textarea>
                        
                        <label for="input1">Author:</label> <br>
                        <input type="text" class="form-control inputfield" name="author" placeholder="Author" aria-label="Recipient's author" value="<?=htmlentities($post['author'])?>">
                        <div class="buttons">
                            <input type="submit" name="updatePostBtn" value="Uppdatera"class="btn btn-warning update-btn"> 
                            <a class="back-link" href="admin.php">Tillbaka</a>
                        </div>  
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>