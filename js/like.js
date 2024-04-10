$(document).ready(function() {
    // Gestisci il click sul pulsante di like
    $(".like-button").click(function() {
        var postId = $(this).data("post-id");
        likePost(postId);
    });

    // Gestisci il click sul pulsante di unlike
    $(".unlike-button").click(function() {
        var postId = $(this).data("post-id");
        unlikePost(postId);
    });
});

// Funzione per inviare una richiesta AJAX per like
function likePost(postId) {
    $.ajax({
        type: "POST",
        url: "api/like.php",
        data: { type: "post", id: postId },
        success: function(response) {
            // Aggiorna l'interfaccia utente o esegui altre azioni necessarie dopo il like
            var likeButton = $(".like-button[data-post-id='" + postId + "']");
            var likeCountText = likeButton.text().split(":")[1];
            if (likeCountText !== undefined) {
                var likeCount = parseInt(likeCountText.trim());
                if (likeButton.hasClass("liked")) {
                    likeCount--;
                    likeButton.removeClass("liked");
                } else {
                    likeCount++;
                    likeButton.addClass("liked");
                }
                likeButton.text("Like: " + likeCount);
                console.log("Like completato con successo");
            }
        },
        error: function(xhr, status, error) {
            // Gestisci gli errori se ci sono stati problemi con la richiesta AJAX
            console.error("Errore durante il like:", error);
        }
    });
}

// Funzione per inviare una richiesta AJAX per unlike
function unlikePost(postId) {
    $.ajax({
        type: "POST",
        url: "api/unlike.php",
        data: { type: "post", id: postId },
        success: function(response) {
            // Aggiorna l'interfaccia utente o esegui altre azioni necessarie dopo l'unlike
            var likeButton = $(".like-button[data-post-id='" + postId + "']");
            var likeCountText = likeButton.text().split(":")[1];
            if (likeCountText !== undefined) {
                var likeCount = parseInt(likeCountText.trim()) - 1;
                likeButton.removeClass("liked");
                likeButton.text("Like: " + likeCount);
                console.log("Unlike completato con successo");
            }
        },
        error: function(xhr, status, error) {
            // Gestisci gli errori se ci sono stati problemi con la richiesta AJAX
            console.error("Errore durante l'unlike:", error);
        }
    });
}
