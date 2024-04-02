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
    }
}
