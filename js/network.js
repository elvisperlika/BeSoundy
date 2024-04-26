document.addEventListener("DOMContentLoaded", function() {
    var inputElement = document.getElementById("usersContainer");
    inputElement.addEventListener("click", function(event) {
        pressFollowBtn(event);
    });
});

function pressFollowBtn(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('followBtn') ){
        console.log("btn");
        event.preventDefault(); // Prevent the default action of the link

        

        // var xmlhttp2 = new XMLHttpRequest();
        // xmlhttp2.open("GET", "api/following.php?user=" + user+"&request=" + typeRequest, true);
        // xmlhttp2.send();
    }
}