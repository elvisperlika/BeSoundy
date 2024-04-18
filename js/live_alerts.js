function myFunction() {
    console.log("Checking for new alerts...");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "api/get_num_new_alerts.php", true);
    xmlhttp.send();



    var x = document.getElementById("snackbar");
    x.className = "show";
    x.className = x.className.replace("show", ""); 
}

setInterval(myFunction, 1000);