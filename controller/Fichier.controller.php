<?php
    require_once './model/Fichier.model.php';
    class Fichier
    {
        private $fichiers=null;
        function __construct()
        {
            $this->fichiers=new Fichiers();
        }

        public function index()
        {
            $images= $this->fichiers->list();
            include_once './view/produits/list.php';
        }
        public function insert()
        {
            $data=array();
            $data['nom']=$_POST['nom'];
            $this->fichiers->insert($data);
            $this->index();
        }
        public function delete()
        {
            $this->fichiers->delete($_GET['id']);
            $this->index();
        }
    }
?>
