document.addEventListener('DOMContentLoaded', ()=>{
    const submitBtn = document.getElementById('submit');
    submitBtn.addEventListener('click', async(e) => {
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
            updateToastSuccess(message);
            submitBtn.innerHTML = initialText;
        }else{
            const message = data.message;
            updateToastError(message);
            submitBtn.innerHTML = initialText;
        }
        
    })

    function updateToastSuccess(message){

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
        setTimeout(()=>{
            window.location.href = "/srms/";
        }, 2000)
    }

    function updateToastError(message){
        

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
        }, 3000);
        
    }


})