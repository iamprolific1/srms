document.addEventListener('DOMContentLoaded', ()=>{
    const mobileMenu = document.querySelector(".mobile-Sidebar-Container");
    const toggleMenu = document.getElementById("menuBtn");
    const closeMenu = document.getElementById("closeMenu");
    const submitBtn = document.getElementById("submit");

    toggleMenu.addEventListener('click', ()=>{
        mobileMenu.classList.add('show');
        document.body.style.overflow = 'hidden';
    })

    closeMenu.addEventListener('click', ()=>{
        mobileMenu.classList.remove('show');
        document.body.style.overflow = 'scroll';
    })

    submitBtn.addEventListener('click', async (e)=>{
        e.preventDefault();
        const initialText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
        const form = document.getElementById('form');
        const res = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form)
        })
        const data = await res.json();
        if(data.status === 'success'){
            const message = data.message;
            updateSuccessAlert(message);
            form.reset();
            submitBtn.innerHTML = initialText;
        }else{
            const message = data.message;
            updateErrorAlert(message);
            submitBtn.innerHTML = initialText;
        }
    });

    const updateSuccessAlert = (message) => {
        const alert = document.createElement('div');
        alert.classList.add('alert','alert-success','text-center','mb-4');
        alert.innerHTML = `
            <i class="fa-solid fa-check-circle"></i>
            <strong>Success!</strong>
            <span id="alertMessage">${message || 'Form Submitted Successfully'}</span>
        `;
        document.getElementById('server-response').appendChild(alert);
        setTimeout(()=>{
            alert.remove();
        }, 3000);
    }

    const updateErrorAlert = (message) => {
        const alert = document.createElement('div');
        alert.classList.add('alert','alert-danger','text-center','mb-4');
        alert.innerHTML = `
            <i class="fa-solid fa-exclamation-triangle"></i>
            <strong>Error!</strong>
            <span id="alertMessage">${message || 'Error Submitting Form'}</span>
        `;
        document.getElementById('server-response').appendChild(alert);
        setTimeout(()=>{
            alert.remove();
        }, 5000);
    }
})