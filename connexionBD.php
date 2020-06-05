<?php
// il s'agit d'un code utilisant une classe comme vu en java avec de la poo car on a  un constructeur et des fonctions avec des arguments 
class connexionDB {
    private $host ='localhost';
    // en dessous nom de bdd  
    private $name='coromasque';
    private $user="root";
    private $pass='';
    private $connexion;
    // au dessus variable d'instance qui seront accessible dans tout le code de la classe 

    function __construct($host=null,$name=null,$user=null,$pass=null){
	if($host != null){
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
	}
	// au dessus il y a un constructeur 
	//Les classes qui possèdent une méthode constructeur appellent cette méthode à chaque création d'une nouvelle instance de l'objet, ce qui est intéressant pour toutes les initialisations dont l'objet a besoin avant d'être utilisé
	try{
            $this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->name,
            $this->user,$this->pass,array(
		PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
		));
		// utilisation du this qui permet à une fonction d'accéder aux propriétés de la classe
	}catch (PDOException $e){
            echo 'Erreur : Impossible de se connecter  à la BDD !';die();
	}
    }
    // le try catch va permet de verifier si cela fonctionne si non cela va etre diriger dans le catch et afficher une erreur 
    
    public function query($sql , $data=array()){
	$req = $this->connexion->prepare($sql);
	$req->execute($data);
        return $req;
    }
    
    
    public function insert($sql, $data=array()) {
        $req=$this->connexion->prepare($sql);
        $req->execute($data);
    }
    public function prepare($sql, $data=array()) {
        $req=$this->connexion->prepare($sql);
        $req->execute($data);
    }

}
?>