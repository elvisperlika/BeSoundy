//show/hide comment
document.addEventListener("DOMContentLoaded", function() {
    var toggleButton = document.getElementById('toggle-comments');
    toggleButton.addEventListener('click', function() {
        var commentsSection = document.querySelector('.comments-section');
        toggleCommentShow(commentsSection);
    });
});

function toggleCommentShow(commentSection) {
    if (commentSection.style.display === 'none') {
        commentSection.style.display = 'block';
    } else {
        commentSection.style.display = 'none';
    }
}

//write comment
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('comment-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevents the default form submission behavior

        var formData = new FormData(this);

        fetch(this.action, {
            method: this.method,
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Successfully submitted the comment via AJAX
            // Update the comments section to display the new comment
            var commentsSection = document.querySelector('.comments-section');
            commentsSection.innerHTML = data; // Assuming the server returns updated HTML for comments section
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error if needed
        });
    });
});
