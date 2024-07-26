document.addEventListener('DOMContentLoaded', () => {
    const submitBtn = document.getElementById('submitBtn');
    
    submitBtn.addEventListener('click', async(e)=>{
        e.preventDefault();
        const form = document.getElementById('searchForm');
        const formData = new FormData(form);
        const searchParams = {};
        
        formData.forEach((value, key)=>{
            if(value.trim !== ''){
                searchParams[key] = value.trim();
            }
        })
        
        const res = await fetch('./public/includes/search_Results.inc.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(searchParams)
        })
        
        const data = await res.json();
        // console.log(data);

        if(data.status === 'success'){
            const display_Result_Container = document.querySelector('.display_Result_Container');
            display_Result_Container.style.display = 'flex';
            const results = data.results[0];

            const course_Codes = JSON.parse(results.course_Codes);
            const scores = JSON.parse(results.scores);
            const grades = JSON.parse(results.grades);

            const resultContainer = document.querySelector('.display_Result_Container .result .table');
            const tableHead = document.createElement('thead');
            tableHead.classList.add('text-center')
            const tableRow = document.createElement('tr');

            const S_N = document.createElement('th');
            S_N.innerHTML = "#";

            const name = document.createElement('th');
            name.innerHTML = "Name";

            const matricNumber = document.createElement('th');
            matricNumber.innerHTML = "Matric Number";

            const cgpColumn = document.createElement('th');
            cgpColumn.innerHTML = "CGP";

            tableRow.appendChild(S_N);
            tableRow.appendChild(name);
            tableRow.appendChild(matricNumber);

            course_Codes.forEach((course_Code) => {
                const course_code_th = document.createElement('th');
                course_code_th.innerHTML = course_Code;
                tableRow.appendChild(course_code_th);
            });
            tableRow.appendChild(cgpColumn);
            tableHead.appendChild(tableRow);
            resultContainer.appendChild(tableHead);

            const tableBody = document.createElement('tbody');
            tableBody.classList.add('text-center')
            const resultRow = document.createElement('tr');

            // Add SN, Name, and Matric Number
            const snCell = document.createElement('td');
            snCell.innerHTML = "1";
            resultRow.appendChild(snCell);

            const nameCell = document.createElement('td');
            nameCell.innerHTML = results.student_Name;
            resultRow.appendChild(nameCell);

            const matricNumberCell = document.createElement('td');
            matricNumberCell.innerHTML = results.student_Matric_Number;
            resultRow.appendChild(matricNumberCell);
            // Concatenate scores and grades and add them to the table
            for (let i = 0; i < scores.length; i++) {
                const scoreGradeCell = document.createElement('td');
                scoreGradeCell.innerHTML = scores[i] + grades[i];
                resultRow.appendChild(scoreGradeCell);
            }

            // Add CGP
            const cgpCell = document.createElement('td');
            cgpCell.innerHTML = results.cgp;
            resultRow.appendChild(cgpCell);

            tableBody.appendChild(resultRow);
            resultContainer.appendChild(tableBody);

        }else{
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger', 'text-center');
            alert.innerHTML = `
                <i class="fa-solid fa-exclamation-triangle"></i>
                <strong>Error!</strong>
                <span id="alertMessage">${data.message}</span>
            `;
            alertContainer.appendChild(alert);

            setTimeout(()=>{
                alert.remove();
            }, 3000);

        }
    })
    

})