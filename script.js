const toggle = document.querySelector('.auth');
const forms = document.querySelectorAll('.login-form');
const head = document.querySelector('.header');
console.log(head);
function displayForm(){
    if(this.dataset.toggle === "0"){
        forms.forEach(form => {
            form.classList.add('login-form');
            head.innerHTML = "Need an account?"
            if(form.dataset.form === "login"){
                form.classList.remove('login-form');
                this.dataset.toggle = "1";
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
                this.value = "Sign Up"
            }
        });
    }else if(this.dataset.toggle === "1"){
        forms.forEach(form => {
            form.classList.add('login-form');
            head.innerHTML = "Already have an account?"
            if(form.dataset.form === "signup"){
                form.classList.remove('login-form');
                this.dataset.toggle = "0";
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');                
                this.value = "Login"
            }
        });
    }else{
      console.log(this.dataset.toggle);
      alert("wrong");
    }
}

toggle.addEventListener('click', displayForm);
