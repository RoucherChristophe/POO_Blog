<?php

namespace App;
// pour avoir des variables avec une grande portabilité on créer une classe static qui peut être appelée partout

class App{

  //on créer des constantes pour la connexion BDD

  const DB_NAME = 'grafikart-blog';
  const DB_USER = 'root';
  const DB_PASS = '';
  const DB_HOST = 'localhost';


  // variable qui sauvegarde la connexion à la BDD
  private static $database;

  // on créer le getteur, fonction qui initialise la connexion à la BDD que l'on sauvegarde dans la variable '$database'
  public static function getDb(){

    // si 'self::$database n'à  pas déjà été défini on le fait 1 fois
    if(self::$database === null){

      self::$database = new Database(self::DB_NAME,self::DB_USER, self::DB_PASS,self::DB_HOST);

    }

    return self::$database;

  }

}



?>