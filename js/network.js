document.addEventListener("DOMContentLoaded", function() {
    var inputElement = document.getElementById("usersContainer");
    inputElement.addEventListener("click", function(event) {
        pressFollowBtn(event);
    });
});

function pressFollowBtn(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('followBtn') ){
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