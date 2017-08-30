addClient = document.querySelector('.show');
clientForm = document.querySelector('.clientForm');
processForm = document.querySelector('#addClient');
search = document.querySelector(".search");
toggle = true;

function process(){
  if(toggle===true){
    clientForm.classList.remove('addForm');
    toggle = false;
  }else{
    clientForm.classList.add('addForm');
    toggle = true;
  }
}
function hideForm(){
  clientForm.classList.add('addForm');
}

function showSearch(str) {
    if (str.length == 0) {
        document.querySelector("#txtSearch").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector("#txtSearch").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getsearch.php?q=" + str, true);
        xmlhttp.send();
    }
}

addClient.addEventListener('click', process);
processForm.addEventListener('click', hideForm);
search.addEventListener('keyup', showSearch(this.value));
