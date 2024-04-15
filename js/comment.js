//funzioni per hide/show commenti/risposte
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
            var userName = this.closest(".comment").querySelector(".userInfo a").textContent; // Ottieni il nome dell'utente a cui si sta rispondendo
            var replyForm = document.querySelector("#reply-" + commentId); // Seleziona il form di risposta corrispondente
            toggleReplyForm(replyForm, userName); // Mostra/nascondi il form di risposta
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

function toggleReplyForm(reply, userName) {
    if (reply.style.display === "none") {
        reply.style.display = "block";
        // Aggiungi il nome dell'utente a cui si sta rispondendo al form di risposta
        reply.querySelector('textarea').value = "@" + userName + " ";
        
    } else {
        reply.style.display = "none";
    }
}

//funzioni per aggiungere commenti/risposte
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

document.addEventListener("DOMContentLoaded", function() {
    var addReplyButtons = document.querySelectorAll(".reply-form-button");

    addReplyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            var postId = this.getAttribute("data-post-id");
            var commentId = this.getAttribute("data-comment-id");
            var text = document.getElementById("replyForm-" + commentId).value;
            addReplyComment(postId, commentId, text); // Passa entrambi gli ID come parametri
        });
    });
});

// Funzione per inviare una richiesta AJAX per aggiungere un commento di risposta
function addReplyComment(postId, parent_comment, commentText) {
    // Effettua la richiesta AJAX
    $.ajax({
        type: "POST",
        url: "api/create_comment.php?idPost=" + postId + "&parent_comment=" + parent_comment,
        data: { "write-comment": commentText },
        success: function(response) {
            // Gestisci la risposta dal server
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                // Il commento è stato aggiunto con successo, aggiorna l'interfaccia utente se necessario
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
