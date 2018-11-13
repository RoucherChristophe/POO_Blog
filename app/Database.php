<?php

namespace App;

//pour pouvoir utiliser PDO on doit retourner à la racine, car PDO ne fait pas partie du namespace 'APP', il faut mettre un '\' devant. on utilise un 'use' pour que tout les PDO soit affectés
use \PDO;

class Database{

// on créer les propriétés, des variables privées 

private $db_name;

private $db_user;

private $db_pass;

private $db_host;

private $pdo;


// la class prend les identifiants de connexion à la BDD pour initialiser les différents parametres
  public function __construct( $db_name, $db_user = 'root', $db_pass ='',$db_host = 'localhost'){

    // on  initialise les champs dans le constructeur 
    $this->db_name  = $db_name;

    $this->db_user  = $db_user;

    $this->db_pass  = $db_pass;

    $this->db_host  = $db_host;
  }
  
//on doit générer le PDO, on évite de le faire dans le constructeur, car on peut construire l'objet et ne jamais l'utiliser, ça ne sert à rien de se connecter à la BDD si on ne fait pas de requête SQL.
// on créer une méthode séparer, en private car on ne va pas l'utiliser en dehors, pour gérer PDO et le stocker dans les propriétés
  private function getPDO(){
    // pour ne pas se connecter à la base à chaque requête on met une condition 
    // si l'objet 'database' n'a pas de propriété PDO  
    if ($this->pdo === null){

      // On se connecte à MySQL
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=grafikart-blog;chartset=utf8", "root", "");

    // on affiche les erreurs 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // on stock le résultat dans l'instance
    $this->pdo = $pdo;

    }
    
    // et chaque fois que PDO est défini, on retourne PDO
    return $this->pdo;

  }

  // on créer la méthode public pour récupérer le résultat qui prend en parametre la requête et la classe à utiliser
public function query($statement, $class_name){
  // on récupère la connexion PDO avec 'getPDO', et on récupère la requête passée en parametre dans '$req'
  $req = $this->getPDO()->query($statement);
 // on execute la requête avec le 'fetchAll'.
 // on utilise 'FETCH_CLASS' qui permet de charger une classe, avec un 2e parametre qui est la classe à utiliser ('FETCH_OBJ' permet un meilleur affichage avec un var_dump)
  $datas = $req->fetchAll(PDO::FETCH_CLASS,$class_name);
  // on retourne les données
  return $datas;

}

// on créer une fonction prepare pour sécuriser les requêtes, qui prend en parametre la requête, les valeurs, le nom de la classe à utiliser, et si on veut un ou plusieurs articles
public function prepare($statement, $attributes, $class_name, $one = false){
  // on se connecte à la BDD et on passe la requête
  $req = $this->getPDO()->prepare($statement);
  // on envoie les valeurs dans la requête
  $req->execute($attributes);
 
  // on créer les parametres des 'fetch', car 'fetch' ne peut pas recevoir de classe directement
  $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
  //on récupère le résultat
  // si on ne veut qu'un seul article on fait un 'fetch()'
  if($one) {

    $datas = $req->fetch();

  } else {

     // sinon on fait un 'fetchAll()'
    $datas = $req->fetchAll();

  }

  // on retourne les objets par rapport au nombre de classe
  return $datas;

  
 
  
}

}

?>