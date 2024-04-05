document.addEventListener("DOMContentLoaded", function() {
    var followBtn = document.getElementById("followButton");
    followBtn.addEventListener("click", function(event) {
        pressFollowBtn(event);
    });
});

function pressFollowBtn(event) {
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

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "api/following.php?user=" + user+"&request=" + typeRequest, true);
    xmlhttp.send();
}