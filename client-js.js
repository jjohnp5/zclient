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



addClient.addEventListener('click', process);
processForm.addEventListener('click', hideForm);
