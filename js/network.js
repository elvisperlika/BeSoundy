document.addEventListener("DOMContentLoaded", function() {
    var inputElement = document.getElementById("usersContainer");
    inputElement.addEventListener("click", function(event) {
        pressFollowBtn(event);
    });
});

function pressFollowBtn(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('followBtn') ){

        event.preventDefault(); // Prevent the default action of the link

        var type = event.target.getAttribute("data-type");
        var user = event.target.getAttribute("data-user");

        if(type == "follow"){
            event.target.setAttribute("data-type", "unfollow");
            event.target.innerHTML = "unfollow";
        } else if (type == "unfollow"){
            event.target.setAttribute("data-type", "follow");
            event.target.innerHTML = "follow";
        }

        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "api/following.php?user=" + user+"&request=" + type, true);
        xmlhttp2.send();
    }
}