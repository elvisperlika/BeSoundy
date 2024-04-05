document.addEventListener("DOMContentLoaded", function() {
    var inputElement = document.getElementById("searchBar");
    inputElement.addEventListener("keyup", function(event) {
        var inputValue = event.target.value;
        showHint(inputValue);
    });
    
});

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
            event.preventDefault(); // Previeni il comportamento predefinito del link
            
            pressFollowBtn(event);
        });
    }
    
}

function pressFollowBtn(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('followButton')) {
        var user = event.target.getAttribute('data-user');
        console.log(user);
        var typeRequest = "";
        if(event.target.textContent === "Follow"){
            typeRequest = "follow";
            event.target.textContent="Unfollow";
        } else {
            typeRequest = "unfollow";
            event.target.textContent="Follow";
        }
        console.log(typeRequest);

        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "api/following.php?user=" + user+"&request=" + typeRequest, true);
        xmlhttp2.send();
    }
}