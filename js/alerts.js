document.addEventListener("DOMContentLoaded", function() {
    var alertsConatainer = document.getElementById("alertsContainer");
    alertsConatainer.addEventListener("click", function(event) {
        clickAlert(event);
    });
});

function clickAlert(event) {
    if (event.target.tagName === 'A' && event.target.classList.contains('deleteBtn')){
        event.preventDefault(); // Prevent the default action of the link
        var alert_id = event.target.getAttribute('alert-id'); 
        var alert_receiver = event.target.getAttribute('alert-receiver');
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.open("GET", "api/deleteAlert.php?alert-id=" + alert_id + "&alert-receiver=" + alert_receiver, true);
        xmlhttp2.send();
        event.target.parentNode.remove();
    }
}