<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Blog - Accueil</title>
</head>
<body>
    <div class="container">
        <h1 class="my-5 border-bottom">Articles</h1>
        <?php foreach($articles as $article): ?>
            <div class="my-5 card">
                <div class="card-header">
                    <h2><?= $article['title'] ?></h2>
                </div>
                <div class="card-body">
                    <p><?= $article['content'] ?></p>
                </div>
            </div>
        <?php endforeach; ?> 
    </div>   
    </body>
<script src="assets/js/index.js"></script>
</html>