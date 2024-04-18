function loadMorePosts() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "api/load_more_post.php", true);
    xmlhttp.send();
    console.log("more post");
}

// Carica più post quando l'utente raggiunge il fondo della pagina
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        loadMorePosts();
    }
});

