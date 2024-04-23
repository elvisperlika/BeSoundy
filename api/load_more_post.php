<?php
require("api.php");

if (isset($_GET['lastPostId'])) {
    $lastPostId = $_GET['lastPostId'];
    $user = $_SESSION['username'];
    $morePosts = $dbh->getMorePosts($lastPostId, $user);
    
    // Prepara un array per memorizzare i post
    $postsArray = array();
    
    // Itera sui risultati ottenuti dall'oggetto mysqli_result
    while ($post = $morePosts->fetch_assoc()) {
        // Aggiungi ciascun post all'array
        $postsArray[] = $post;
    }
    
    // Restituisci i post come dati JSON
    echo json_encode($postsArray);
} else {
    // Se il parametro lastPostId non è stato fornito, restituisci un messaggio di errore
    echo json_encode(array('error' => 'Parametro lastPostId non fornito.'));
}
?>
