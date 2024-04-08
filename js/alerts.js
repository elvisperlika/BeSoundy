document.addEventListener("DOMContentLoaded", function() {
    var alertsConatainer = document.getElementById("alertsContainer");
    alertsConatainer.addEventListener("click", function(event) {
        clickAlert(event);
    });
});

function clickAlert(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('deleteBtn')){
        event.preventDefault(); // Prevent the default action of the link

        var alert = event.target.getAttribute('data-alert'); 
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "api/deleteAlert.php?alert=" + alert, true);
        xmlhttp2.send();
        location.reload();
    }
}