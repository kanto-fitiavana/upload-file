<?php
    require_once 'DB.php';
    class Fichiers
    {
        private $connexion=null;
        function __construct()
        {
            $this->connexion=DB::seConnecter();
        }
        private function getCountOfFile()
        {
            $sql= $this->connexion->prepare("SELECT COUNT(*) as nb FROM produits");
            $sql->setFetchMode(PDO::FETCH_OBJ);
            $sql->execute();
            return ($sql->fetch()->nb+1);
        }
        private function isUploaded()
        {
            if(isset($_FILES['image']) && isset($_POST['nom']))
            {
                //ny chemin hampidirana azy
                $this->nom=$_POST['nom'];
                $directory = "public/img/";
                $file = $directory . basename($_FILES["image"]["name"]);
                $status = 1;
                $type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
                if(isset($_POST["submit"])) {
                    //ampidirina ao anaty fichier temporaire
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check !== false) {
                        //echo "type -" . $check["mime"];
                        $status = 1;
                    } else {
                        //echo "Format non prise en charge.";
                        $status = 0;
                    }
                }
                if (file_exists($file)) {
                    //echo "Image existe deja";
                    $status = 0;
                }
                if ($_FILES["image"]["size"] > 500000000) {
                    //echo "Fichier trop volumineux";
                    $status = 0;
                }
                if($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) {
                    //echo "désolé, seulement JPG, JPEG, PNG, GIF.";
                    $status = 0;
                }
                if ($status == 0) {
                    //echo "Erreur de téléchargement des fichiers.";
                } 
                else 
                {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
                        rename("public/img/".basename( $_FILES["image"]["name"]),"public/img/".$this->getCountOfFile()."-".strtolower(join("-",explode(" ",$this->nom)).".".$type));
                        $this->file=$this->getCountOfFile()."-".strtolower(join("-",explode(" ",$this->nom))).".".$type;
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
        private function isDeleted($chemin,$file)
        {
            if (unlink($chemin.$file))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        private function getNameOfFile($id)
        {
            $sql= $this->connexion->prepare("SELECT * FROM produits where id=:id");
            $sql->bindParam(':id',$id);
            $sql->setFetchMode(PDO::FETCH_OBJ);
            $sql->execute();
            return $sql->fetch();
        }
        public function list()
        {
            $data=array();
            try{
                $sql=$this->connexion->prepare("select * from produits");
                $sql->setFetchMode(PDO::FETCH_OBJ);
                $sql->execute();
                foreach($sql->fetchAll() as $p)
                {
                    array_push($data,$p);
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
            return $data;
        }
        public function insert($data)
        {
            if($this->isUploaded())
            {
                $sql= $this->connexion->prepare("INSERT INTO produits(nom,fichier) VALUES(:nom,:fichier)");
                $sql->bindParam(':nom',$data['nom']);
                $sql->bindParam(':fichier',$this->file);
                $sql->execute();
            }
        }
        public function delete($id)
        {
            if($this->isDeleted("./public/img/",$this->getNameOfFile($id)->fichier))
            {
                $sql= $this->connexion->prepare("DELETE FROM produits where id=:id");
                $sql->bindParam(':id',$id);
                $sql->execute();
            }
        }
    }
?>