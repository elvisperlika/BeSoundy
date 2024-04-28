<a href="feed.php" class="btn-annulla">Annulla</a>

<div class="newPost">
    <form action="api/create_post.php" method="POST" enctype="multipart/form-data">
        <div class="foto">
            <!-- Aggiungi l'input per caricare la foto -->
            <label for="image-upload">Scegli immagine:</label>
            <input type="file" id="image-upload" name="image-upload" accept="image/*">
        </div>
        <div class="textarea">
            <!-- Aggiungi la textarea per il commento -->
            <label for="didascalia">Aggiungi una descrizione:</label>
            <textarea id="didascalia" name="didascalia" placeholder="Aggiungi una descrizione..." rows="1"></textarea>
        </div>
        <div class="saveImg">
            <!-- Aggiungi il pulsante di invio -->
            <button type="submit" id="btn-invio">Carica foto </button>
        </div>
    </form>
</div>


