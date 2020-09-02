<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Image</title>
</head>
<body>
    <form action="index.php?action=insert" method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" id="nom" placeholder="Nom du produits"><br>
        <input type="file" name="image" id="image">
        <input type="submit" name="submit">
    </form>
    <h1>Liste des images</h1>
    <?php 
        foreach ($images as $i) {
    ?>
            <p><?= $i->id." ".$i->nom; ?></p>
            <img src="././public/img/<?= $i->fichier; ?>" alt="Image">
            <a href="?action=delete&id=<?= $i->id; ?>">Supprimer</a>
    <?php
        }
    ?>
</body>
</html>
