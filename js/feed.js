function loadMorePosts() {
    // Controlla se ci sono già post presenti nella pagina
    var existingPosts = $('.post');
    if (existingPosts.length === 0) {
        // Se non ci sono post, carica i primi post senza specificare lastPostId
        var lastPostId = 0; // O qualsiasi altro valore che indica al server di restituire i primi post
    } else {
        // Se ci sono già post presenti, ottieni l'ultimo ID di post visibile nella pagina
        var lastPostId = existingPosts.last().attr('data-post-id');
    }

    // Effettua la richiesta AJAX per caricare i post
    $.ajax({
        url: 'api/load_more_post.php',
        method: 'GET',
        data: { lastPostId: lastPostId },
        dataType: 'json',
        success: function(response) {
            console.log("Ultimo ID di post:", lastPostId);

            console.log(response);
            // Aggiungi i nuovi post al container
            response.forEach(function(post) {
                $('#postsContainer .post-container').append('<div class="post" data-post-id="' + post.id + '">' + post.content + '</div>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Errore nella richiesta AJAX:', status, error);
        }
    });
}


// Carica più post quando l'utente raggiunge il fondo della pagina
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        loadMorePosts();
    }
});

