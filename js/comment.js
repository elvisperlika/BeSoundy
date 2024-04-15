document.addEventListener("DOMContentLoaded", function() {
    var toggleButtons = document.querySelectorAll(".comment-button");
    var replyButtons = document.querySelectorAll(".respond-button");

    toggleButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            var postId = this.getAttribute("data-post-id"); // Ottieni l'ID del post associato al pulsante
            var commentsSection = document.querySelector("#commentSection-" + postId); // Seleziona la sezione dei commenti corrispondente
            toggleCommentShow(commentsSection);
        });
    });

    replyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            var commentId = this.getAttribute("data-comment-id"); // Ottieni l'ID del commento associato al pulsante
            var replyForm = document.querySelector("#replyForm-" + commentId); // Seleziona il form di risposta corrispondente
            toggleReplyForm(replyForm); // Mostra/nascondi il form di risposta
        });
    });

    // Gestisci il click sul pulsante di invio del commento di risposta
    document.querySelectorAll(".reply-form button").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del pulsante
            var postId = this.getAttribute("data-post-id"); // Ottieni l'ID del post
            var parentCommentId = this.closest(".comment").getAttribute("data-comment-id"); // Ottieni l'ID del commento genitore
            var commentText = this.previousElementSibling.value; // Ottieni il testo del commento di risposta
            // Invia la richiesta AJAX per aggiungere il commento di risposta
            addReplyComment(postId, parentCommentId, commentText);
        });
    });
});


function toggleCommentShow(commentSection) {
    if (commentSection.style.display === "none") {
        commentSection.style.display = "block";
    } else {
        commentSection.style.display = "none";
    }
}

function toggleReplyForm(replyForm) {
    if (replyForm.style.display === "none") {
        replyForm.style.display = "block";
    } else {
        replyForm.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var addCommentButtons = document.querySelectorAll(".add-comment-button");

    addCommentButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var postId = this.getAttribute("data-post-id");
            var text = document.getElementById("comment-text-" + postId).value;
            addComment(postId, text);
        });
    });
});

// Funzione per inviare una richiesta AJAX per aggiungere un commento
function addComment(postId, commentText) {
    $.ajax({
        type: "POST",
        url: "api/create_comment.php?idPost=" + postId,
        data: { "write-comment": commentText },
        success: function(response) {
            // Gestisci la risposta dal server
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                // Il commento è stato aggiunto con successo, puoi aggiornare l'interfaccia utente o fare altre azioni necessarie
                console.log("Commento aggiunto con successo.");
                // Esempio: ricarica la pagina per aggiornare i commenti
                window.location.reload();
            } else {
                // Si è verificato un errore durante l'aggiunta del commento
                console.error("Errore durante l'aggiunta del commento:", jsonResponse.message);
                // Gestisci l'errore nell'interfaccia utente se necessario
            }
        },
        error: function(xhr, status, error) {
            // Gestisci gli errori se ci sono stati problemi con la richiesta AJAX
            console.error("Errore durante l'invio del commento:", error);
            // Gestisci l'errore nell'interfaccia utente se necessario
        }
    });
}

// Gestisci il submit del form per l'aggiunta di un commento
$("form[action^='api/create_comment.php']").submit(function(event) {
    event.preventDefault(); // Previeni il comportamento predefinito del form
    var postId = $(this).data("post-id"); // Ottieni l'ID del post associato al form
    var commentText = $(this).find("textarea[name='write-comment']").val(); // Ottieni il testo del commento
    if (commentText.trim() !== "") {
        // Se il commento non è vuoto, invia la richiesta AJAX per aggiungere il commento
        addComment(postId, commentText);
    } else {
        // Il commento è vuoto, gestisci l'errore nell'interfaccia utente se necessario
        console.error("Il commento non può essere vuoto.");
    }
});
