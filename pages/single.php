<?php

//on envoie les parametres de la fonction prepare : la requête + l'id passé en GET, le nom de la classe à utiliser et 'true' pour dire que l'on veut qu'un seul résultat
$post = $db->prepare('SELECT * FROM articles WHERE id = ?', [$_GET['id']], 'App\Table\Article', true);

?>

<h1><?= $post->titre; ?></h1>

<p><?= $post->contenu; ?></p>
