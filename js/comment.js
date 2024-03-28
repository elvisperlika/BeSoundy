// Attendiamo che il documento sia completamente caricato
document.addEventListener("DOMContentLoaded", function() {
    // Aggiungi un event listener al link "Commenti" per gestire il click
    document.getElementById('toggle-comments').addEventListener('click', toggleComments);
});

function toggleComments() {
    // Trova l'elemento con l'id "toggle-comments"
    var toggleButton = document.getElementById('toggle-comments');

    // Trova il genitore che contiene sia il link "Commenti" che la sezione dei commenti
    var parent = toggleButton.closest('.post');

    // Trova la sezione dei commenti all'interno del genitore
    var commentsSection = parent.querySelector('.comments-section');

    // Mostra o nascondi la sezione dei commenti a seconda del suo stato attuale
    if (commentsSection.style.display === 'none') {
        print(helo);
        commentsSection.style.display = 'block';
    } else {
        commentsSection.style.display = 'none';
    }
}