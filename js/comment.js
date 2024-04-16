document.addEventListener("DOMContentLoaded", function() {
    var toggleButtons = document.querySelectorAll(".comment-button");
    var replyButtons = document.querySelectorAll(".respond-button");

    toggleButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            var postId = this.getAttribute("data-post-id");
            var commentsSection = document.querySelector("#commentSection-" + postId);
            toggleCommentShow(commentsSection);
        });
    });

    replyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            var commentId = this.getAttribute("data-comment-id");
            var userName = this.closest(".comment").querySelector(".userInfo a").textContent;
            var replyForm = document.querySelector("#reply-" + commentId);
            toggleReplyForm(replyForm, userName);
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
    var currentDisplayStyle = window.getComputedStyle(reply).display;
    if (currentDisplayStyle === "none" || currentDisplayStyle === "") {
        reply.style.display = "block";
        reply.querySelector('textarea').value = "@" + userName + " ";
    } else {
        reply.style.display = "none";
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

function addComment(postId, commentText) {
    $.ajax({
        type: "POST",
        url: "api/create_comment.php?idPost=" + postId,
        data: { "write-comment": commentText },
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                console.log("Commento aggiunto con successo.");
                window.location.reload();
            } else {
                console.error("Errore durante l'aggiunta del commento:", jsonResponse.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Errore durante l'invio del commento:", error);
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
            var userName = this.getAttribute("data-username"); // Ottenere il nome utente dal pulsante di risposta
            console.log("Username:", userName); // Aggiungi questo log per verificare se il valore di userName è corretto
            var text = document.getElementById("replyForm-" + commentId).value;
            console.log("Comment text:", text); // Aggiungi questo log per verificare il testo del commento
            addReplyComment(postId, commentId, text, userName);
        });
    });
});


function addReplyComment(postId, parentCommentId, commentText, userName) {
    // Verifica se il commento è vuoto o contiene solo il tag dell'utente seguito da spazi o caratteri di spaziatura
    if (commentText.trim().length === 0 || commentText.trim() === "@" + userName) {
        console.error("Il commento di risposta non può essere vuoto.");
        return;
    }

    $.ajax({
        type: "POST",
        url: "api/create_replies.php?idPost=" + postId + "&parent_comment=" + parentCommentId,
        data: { "write-reply": commentText },
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                console.log("Risposta aggiunta con successo.");
                window.location.reload();
            } else {
                console.error("Errore durante l'aggiunta della risposta:", jsonResponse.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Errore durante l'invio della risposta:", error);
        }
    });
}
