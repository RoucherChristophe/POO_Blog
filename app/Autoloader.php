<?php
// on met autoloader.php dans le namespace
namespace App;

// on créer une classe pour l'autoloader pour remplacer tous les 'require'
class Autoloader {
// fonction en static car pas besoin de les instensier


  static function register(){
// 'spl_autoload_register' prend en parametre ce que l'on veut enregistrer pour créer l'autoloader
// soit une fonction 
  //spl_autoload_register('autoload');
// soit un tableau avec en parametre le nom de la classe(__CLASS__ permet de récupérer le nom de la classe courante) et la fonction à appeler)
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }


// on créer la fonction qui prend en parametre le nom de la class et qui dit à php comment la charger (require + nom du fichier à charger)
// pour ne pas que l'on autoload tous on met une condition
  static function autoload($class){
    // si le nom de la classe commence par Tutoriel on peut l'autoloader
    if (strpos($class, __NAMESPACE__ .'\\') === 0){ // il faut que la classe et le NAMESPACE soit en position zéro
    // on supprime 'Tutoriel\' du chemin d'acces (on l'appel par la constante NAMESPACE)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

      // on charge le dossier dynamiquement avec '__DIR__' (constante qui contient le nom du dossier parent : app)
        require __DIR__ . '/' . $class . '.php'; 
    }
    
  }
}

?>