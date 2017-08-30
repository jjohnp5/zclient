var search = document.querySelector(".search");
var searchList = document.querySelector(".txtSearch");
var str = "";
function showSearch() {
  str = search.value;
    if (str == undefined || str.length == 0) {
        searchList.innerHTML = "";
        return;
    } else {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                searchList.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","mysql/getsearch.php?q="+str,true);
        xmlhttp.send();
    }
}

search.addEventListener('change', showSearch);
search.addEventListener('keyup', showSearch);
