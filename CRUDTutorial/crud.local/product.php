<?php
    require_once 'config/connect.php';

    $product_id = $_GET['id'];
    $product = mysqli_query($connect, "SELECT * FROM products WHERE id = '$product_id'");
    $product = mysqli_fetch_assoc($product);
    $comments = mysqli_query($connect, "SELECT * FROM comments WHERE comments . product_id = '$product_id'");
    $comments = mysqli_fetch_all($comments); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h2><?= $product['title'] ?></h2>
    <h4><?= $product['price'] ?></h4>
    <p><?= $product['description'] ?></p>
    <br><br>
    <form action="vendor/createComment.php" method='post'>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <textarea name="body"></textarea>
        <button type="submit">Submit</button>
    </form>
    <br><br>
    <h3>Comments</h3>
    <ul>
        <?php foreach($comments as $comment) { ?>
        <li>
            <?= $comment[2] ?>
        </li>
        <?php } ?>
    </ul>
</body>
</html>