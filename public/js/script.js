document.addEventListener('DOMContentLoaded', ()=>{
    const eyeIcon = document.getElementById('eye-icon');
    eyeIcon.addEventListener('click', ()=>{
        const passwordInput = document.getElementById('password');
        passwordInput.type = passwordInput.type === 'password'? 'text' : 'password';
        if(passwordInput.type === 'password'){
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }else{
            eyeIcon.classList.add("fa-eye-slash");
            eyeIcon.classList.remove("fa-eye");
        }
    });
})
