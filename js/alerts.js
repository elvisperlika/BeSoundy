document.addEventListener("DOMContentLoaded", function() {
    showAlerts();
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

function showAlerts() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alertsContainer").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "api/get_alerts.php", true);
    xmlhttp.send();
}

setInterval(showAlerts, 5000);