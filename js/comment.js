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
            toggleReplyForm(replyForm);
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

//implementa il controllo dello scroll memorizzato