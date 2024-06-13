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
                    // Rimuovi il like
                    unlikePost(postId); // Richiama la funzione unlikePost
                } else {
                    likeCount++;
                    likeButton.addClass("liked");
                    likeButton.text("Like: " + likeCount);
                    console.log("Like completato con successo");
                }
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
            var likeButton = $(".unlike-button[data-post-id='" + postId + "']");
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

$(document).ready(function() {
    // Gestisci il click sul pulsante di like per i commenti
    $(".like-comment-button").click(function() {
        var commentId = $(this).data("comment-id");
        likeComment(commentId);
    });

    // Gestisci il click sul pulsante di unlike per i commenti
    $(".unlike-comment-button").click(function() {
        var commentId = $(this).data("comment-id");
        unlikeComment(commentId);
    });
});

// Funzione per inviare una richiesta AJAX per like ai commenti
function likeComment(commentId) {
    $.ajax({
        type: "POST",
        url: "api/like.php",
        data: { type: "comment", id: commentId },
        success: function(response) {
            // Aggiorna l'interfaccia utente o esegui altre azioni necessarie dopo il like
            var likeButton = $(".like-comment-button[data-comment-id='" + commentId + "']");
            var likeCountText = likeButton.text().split(":")[1];
            if (likeCountText !== undefined) {
                var likeCount = parseInt(likeCountText.trim());
                if (likeButton.hasClass("liked")) {
                    // Rimuovi il like
                    unlikeComment(commentId); // Richiama la funzione unlikePost
                } else {
                    likeCount++;
                    likeButton.addClass("liked");
                    likeButton.text("Like: " + likeCount);
                    console.log("Like completato con successo");
                }
            }
        },
        error: function(xhr, status, error) {
            // Gestisci gli errori se ci sono stati problemi con la richiesta AJAX
            console.error("Errore durante il like del commento:", error);
        }
    });
}

// Funzione per inviare una richiesta AJAX per unlike ai commenti
function unlikeComment(commentId) {
    $.ajax({
        type: "POST",
        url: "api/unlike.php",
        data: { type: "comment", id: commentId },
        success: function(response) {
            // Aggiorna l'interfaccia utente o esegui altre azioni necessarie dopo l'unlike
            var likeButton = $(".like-comment-button[data-comment-id='" + commentId + "']");
            var likeCountText = likeButton.text().split(":")[1];
            if (likeCountText !== undefined) {
                var likeCount = parseInt(likeCountText.trim()) - 1;
                likeButton.removeClass("liked"); // Rimuovi la classe liked
                likeButton.text("Like: " + likeCount); // Aggiorna il testo con il nuovo conteggio dei like
                console.log("Unlike al commento completato con successo");
            }
        },
        error: function(xhr, status, error) {
            // Gestisci gli errori se ci sono stati problemi con la richiesta AJAX
            console.error("Errore durante l'unlike del commento:", error);
        }
    });
}
