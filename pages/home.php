
<?php 
// on récupère tous les articles que l'on stock dans '$post', et on donne en 2e parametre la classe à charger
foreach ($db->query('SELECT * FROM articles', 'App\Table\Article') as $post):
?>
<!--on fait un echo de '$post' et des variables inconnues 'url' et 'extrait', à voir dans 'Article.php' -->
  <h2><a href="<?= $post->url ?>"><?= $post->titre; ?></a></h2>

 <p><?= $post->extrait; ?></p>

<?php endforeach; ?>




<?php
// execute une requête sql et retourne le nombre de lignes affectées
//$count=$pdo->exec('INSERT INTO articles SET titre="Mon titre", date="' .date('Y-m-d H:i:s') . '" ');

//var_dump($count);

?> 