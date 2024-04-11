document.addEventListener("DOMContentLoaded", function() {
    var deleteButtons = document.querySelectorAll(".deleteButton");
    deleteButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            deletePost(event);
        });
    });
});

function deletePost(event) {
    var postId = event.target.getAttribute("data-post-id");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "api/deletePost.php?post-id=" + postId, true);
    xmlhttp.send();
    event.target.parentNode.parentNode.remove();
}
$(document).ready(function() {
    var isLoading = false;
    
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() && !isLoading) {
            // L'utente ha raggiunto il fondo della pagina
            isLoading = true;
            loadMorePosts();
        }
    });
    
    function loadMorePosts() {
        var lastPostId = $('.post:last').attr('id'); // Ottieni l'ID dell'ultimo post visualizzato
        // Esegui una chiamata AJAX per ottenere i prossimi 10 post dal server
        $.ajax({
            url: 'load_more_post.php', // Percorso del file PHP per caricare i post
            method: 'GET',
            data: { lastPostId: lastPostId }, // Invia l'ID dell'ultimo post visualizzato
            success: function(response) {
                // Aggiungi i nuovi post alla pagina
                $('.post-container').append(response);
                isLoading = false;
            },
            error: function() {
                // Gestisci eventuali errori
                isLoading = false;
            }
        });
    }
});
