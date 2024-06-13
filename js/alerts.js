document.addEventListener("DOMContentLoaded", function() {
    var lastSeenAlertsCount = 0; 

    showAlerts();
    var alertsContainer = document.getElementById("alertsContainer");
    alertsContainer.addEventListener("click", function(event) {
        clickAlert(event);
    });

    function clickAlert(event) {
        if (event.target.tagName === 'A' && event.target.classList.contains('deleteBtn')) {
            event.preventDefault(); 
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
                var alertsContainer = document.getElementById("alertsContainer");
                alertsContainer.innerHTML = this.responseText;

                updateNotificationBadge();
            }
        };
        xmlhttp.open("GET", "api/get_alerts.php", true);
        xmlhttp.send();
    }

    function updateNotificationBadge() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var newAlertsCount = parseInt(this.responseText.trim()); 

                var badge = document.querySelector(".notification-badge");
                badge.textContent = newAlertsCount;
                
                if (newAlertsCount > lastSeenAlertsCount) {
                    badge.style.display = "block";
                } else {
                    badge.style.display = "none";
                }

                lastSeenAlertsCount = newAlertsCount;
            }
        };
        xmlhttp.open("GET", "api/get_alerts.php", true); // Endpoint per ottenere il conteggio delle nuove notifiche
        xmlhttp.send();
    }
    
    setInterval(showAlerts, 5000); // Aggiorna le notifiche ogni 5 secondi
});
