const postsContainer = document.getElementById("postsContainer");
const sentinel = document.querySelector(".space");
let index = 0;

function getPostsFromServer(n) {
    return $.ajax({
        type: 'POST',
        url: 'api/load_more_posts.php',
        data: { 
            index: n,
            queryName: page,
            categoryID: categoryID
        },
        dataType: 'json',
    })
    .then(function(data) {
        if (data.status === "error") {
            return Promise.reject(new Error(data.message));
        } else {
            //console.log(data);
            return Promise.resolve(data.posts);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        return Promise.reject(new Error(`Errore nella richiesta AJAX: ${textStatus} - ${errorThrown}`));
    });
}

function loadMorePosts() {
    getPostsFromServer(index)
        .then(posts => {
            if(posts){
                posts.forEach(element => {
                    let datiJSON = JSON.stringify(element);
                    page === 'home' ? viewFullPost(datiJSON) : viewImg(datiJSON);
            });
            index+=5;
            } else {
                console.log(page);
                console.log("nessun altro post disponibile.");
            }
        })
        .catch(error => {
            console.error(error);
        });
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
            url: 'carica_post.php', // Percorso del file PHP per caricare i post
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
