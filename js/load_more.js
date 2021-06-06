var loaded = 0;
var allLoaded = false;

function loadMore(load, toLoad) {
    if (!allLoaded) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != '') {
                    loaded += toLoad;
                    $('#btn-loadMore').before(this.responseText);
                } else {
                    allLoaded = true;
                    $('#btn-loadMore').html('Alle Beitäge sind geladen').delay(3000).fadeOut(500);
                }
            }
        }
        xmlhttp.open("GET", "include/load_more.php?loaded=" + load + "&toLoad=" + toLoad, true);
        xmlhttp.send();
    }
}

$(document).ready(function() {
    loadMore(loaded, 5);
});
