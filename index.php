<?php
    require_once 'controller/Fichier.controller.php';
    $fichier=new Fichier();
    if(isset($_GET['action']))
    {
        call_user_func(array($fichier,$_GET['action']));
    }
    else
    {
        $fichier->index();
    }
?>