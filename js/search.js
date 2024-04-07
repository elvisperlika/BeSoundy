/**
 * This function is called when the page is loaded
 * and add an event listener to the search bar to get the text inside.
 */
document.addEventListener("DOMContentLoaded", function() {
    var inputElement = document.getElementById("searchBar");
    inputElement.addEventListener("keyup", function(event) {
        var inputValue = event.target.value;
        showHint(inputValue);
    });
});

/**
 * This function is called when the user types in the search bar
 * and send a request to the server to get the users that match the search query.
 * @param {str} str is the text that is typed in the search bar
 * @returns 
 */
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "api/gethint.php?str=" + str, true);
        xmlhttp.send();

        var usersContainer = document.getElementById("txtHint");
        usersContainer.addEventListener("click", function(event) {
            pressFollowBtn(event);
        });
    }
    
}

/**
 * This function is called when the follow button is clicked
 * and change the text of the button to follow or unfollow
 * and send a request to the server to follow or unfollow a user.
 * @param {event} event is the event that is triggered when the follow button is clicked
 */
function pressFollowBtn(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('followButton')) {
        event.preventDefault(); // Prevent the default action of the link
        var user = event.target.getAttribute('data-user'); 
        
        var typeRequest = "";
        if(event.target.textContent === "Follow"){
            typeRequest = "follow";
            event.target.textContent="Unfollow";
        } else {
            typeRequest = "unfollow";
            event.target.textContent="Follow";
        }

        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "api/following.php?user=" + user+"&request=" + typeRequest, true);
        xmlhttp2.send();
    }
}