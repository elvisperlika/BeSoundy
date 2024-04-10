document.addEventListener("DOMContentLoaded", function() {
    var deleteButtons = document.querySelectorAll(".deleteButton");
    deleteButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Previeni il comportamento predefinito del link
            deletePost(event);
        });
    });
});

function deletePost(event) {
    var postId = event.target.getAttribute("data-post-id");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "api/deletePost.php?post-id=" + postId, true);
    xmlhttp.send();
    event.target.parentNode.parentNode.remove();
}