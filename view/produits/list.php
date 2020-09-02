<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produits</title>
</head>
<body>
    <form action="index.php?action=insert" method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" id="nom" placeholder="Nom du produits"><br>
        <input type="file" name="image" id="image">
        <input type="submit" name="submit">
    </form>
    <h1>Liste des produits</h1>
    <?php 
        foreach ($produits as $p) {
    ?>
            <p><?= $p->id." ".$p->nom; ?></p>
            <img src="././public/img/<?= $p->fichier; ?>" alt="Image">
            <a href="?action=delete&id=<?= $p->id; ?>">Supprimer</a>
    <?php
        }
    ?>
</body>
</html>