document.addEventListener("DOMContentLoaded", function() {
    var toggleButtons = document.querySelectorAll(".comment-button");
    toggleButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            var postId = this.getAttribute("data-post-id"); // Ottieni l'ID del post associato al pulsante
            var commentsSection = document.querySelector("#commentSection-" + postId); // Seleziona la sezione dei commenti corrispondente
            toggleCommentShow(commentsSection);
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


//implementa il controllo dello scroll memorizzato