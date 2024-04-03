//show/hide comment
document.addEventListener("DOMContentLoaded", function() {
    var toggleButton = document.getElementById("toggle-comments");
    toggleButton.addEventListener("click", function() {
        var commentsSection = document.getElementById("commentSection");
        toggleCommentShow(commentsSection);
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