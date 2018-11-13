<?php  // 31 mn

namespace App\Table;

class Article{

  // 'fonction magique' qui permet de définir des variables inconnues 
  public function __get($key){

    $method = 'get' . ucfirst($key); // on récupère url que l'on transforme en 'getUrl' et extrait en 'getExtrait' (ucfirst : pour mettre le 1er caractère en majuscule)
   
    // on transforme en méthode 'getUrl()' et 'getExtrait()' 
    // on stock en variable d'instance pour éviter que la méthode ne soit appelée a chaque fois que l'on retrouve la même variable inconnues 
    //'$this de la key est = au retour de la méthode'
    // si la variable inconnue n'a pas été transformée on passe par '$this->$method()', si elle est connue on passe par '$this->$key'
    $this->$key = $this->$method();  
  
    // on retourne la variable d'instance '$this->$key'
    return $this->$key;
  }

  
  // permet de récupérer l'url, $this correspond à 1 article
  public function getUrl(){
    
    return 'index.php?p=article&id=' .$this->id;
  }

  // permet de retourner le contenu d'un article
  public function getExtrait(){
    // pour le contenu de l'article, on récupère les 100 premiers caractères avec 'substr'
    $html = '<p>' . substr($this->contenu, 0, 100) . '</p>';
    // pour le lien, avec concaténation de '$html': '.='
    $html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';

    return $html;
  }

}



?>