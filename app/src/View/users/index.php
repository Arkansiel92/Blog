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
    <h1 class = "my-3 text-center">Liste utilisateur(s)</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user) { ?>
            <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>