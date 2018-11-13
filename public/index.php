<?php
// on charge l'autoloader 
require '../app/Autoloader.php';

// attention si un namespace est déclarer au dessus mettre '\' devant App : \App\
App\Autoloader::register();


// si il y a une page qui est envoyée en GET
if (isset($_GET['p'])) {
  // on stock la valeur de la page passée en GET dans une variable 
  $p = $_GET['p'];

} else {
  // sinon p vaut la page 'home'
  $p = 'home';
}

// initialisation des objets, connexion BDD
$db = new App\Database('grafikart-blog');



ob_start(); //permet de stocker dans une variable tout ce qui est affiché, avec 'ob_get_clean()'

// si on veut acceder à une page, on fait un 'require'. les '===' sont une vérification stricte si c'est bien 'home' et si c'est une chaine de caractère, plus stricte que '=='
if ($p === 'home') {  

  require '../pages/home.php';

} elseif ($p === 'article') {
  require '../pages/single.php';
}

$content = ob_get_clean();  // stocke l'affichage dans la variable '$content'

// on affiche la structure HTML, avec la variable $content qui contient la page sélectionnée
require '../pages/templates/default.php';

?>
