<?php
    class DB
    {
        private static $connexion=null;
        private static $host="localhost",$dbname="simple_upload",$username="root",$mdp="";

        public static function seConnecter()
        {
            try
            {
                self::$connexion=new PDO("mysql:host=".self::$host.";dbname=".self::$dbname,self::$username,self::$mdp);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e)
            {
                echo "Erreur de connexion" .$e->getMessage();
            }
            return self::$connexion;
        }
    }
?>