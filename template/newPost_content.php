<a href="feed.php" class="btn-annulla">Annulla</a>

<div class="newPost">
    <form action="api/create_post.php" method="POST" enctype="multipart/form-data">
        <div class="foto">
            <!-- Aggiungi l'input per caricare la foto -->
            <label for="image-upload">Choose image:</label>
            <input type="file" id="image-upload" name="image-upload" accept="image/*">
        </div>
        <div class="textarea">
            <!-- Aggiungi la textarea per il commento -->
            <label for="didascalia">Add description:</label>
            <textarea id="didascalia" name="didascalia" placeholder="Add description..." rows="1"></textarea>
        </div>
        <div class="btn-invio">
            <!-- Aggiungi il pulsante di invio -->
            <input type="submit" value="load foto">
        </div>
    </form>
</div>


