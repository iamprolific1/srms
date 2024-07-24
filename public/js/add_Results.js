document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('addFieldsBtn');
    const search_Student_Btn = document.querySelector(".search_student_btn");
    const alert_Container = document.getElementById("alert_container");
    const nextBtn = document.getElementById('nextBtn');

    //function to add event listeners to all the grade inputs
    function addGradeListener(input) {
        input.addEventListener('input', () => {
            const score = parseInt(input.value);
            let grade = '';

            if (score >= 0 && score <= 39) {
                grade = 'F';
            } else if (score >= 40 && score <= 44) {
                grade = 'E';
            } else if (score >= 45 && score <= 49) {
                grade = 'D';
            } else if (score >= 50 && score <= 59) {
                grade = 'C';
            } else if (score >= 60 && score <= 69) {
                grade = 'B';
            } else if (score >= 70 && score <= 100) {
                grade = 'A';
            }

            const gradeInput = input.closest('.row').querySelector('.grade');
            if (gradeInput) {
                gradeInput.value = grade;
            }

            
            const newGradePointInput = input.closest('.row').querySelector('.gradePoint');
            if(gradeInput.value === 'A'){
                newGradePointInput.value = 5;
            }
            else if(gradeInput.value === 'B'){
                newGradePointInput.value = 4;
            }
            else if(gradeInput.value === 'C'){
                newGradePointInput.value = 3;
            }
            else if(gradeInput.value === 'D'){
                newGradePointInput.value = 2;
            }
            else if(gradeInput.value === 'E'){
                newGradePointInput.value = 1;
            }
            else if(gradeInput.value === 'F'){
                newGradePointInput.value = 0;
            }
        });

    }

    //functions to remove unwanted rows in the container
    function remove_row(input){
        input.closest('.row').remove();
        // calculateGradePoints();
    }

    //event listener that creates another row of input fields in the container
    btn.addEventListener('click', () => {
        const container = document.querySelector('#fieldsContainer .container');
        var newRow = document.createElement('div');
        newRow.className = "row no_gutters text-center mt-1";

        newRow.innerHTML = `
            <div class="col-3"><input type="text" class="form-control courseCode text-center" placeholder="Course Code"></div>
            <div class="col-2"><input type="text" class="form-control courseUnit text-center" placeholder="Course Unit"></div>
            <div class="col-2"><input type="number" class="form-control score text-center" placeholder="Score"></div>
            <div class="col-2"><input type="text" class="form-control grade text-center" placeholder="Grade" readonly></div>
            <div class="col-2"><input type="text" class="form-control gradePoint text-center" placeholder="Grade Points" readonly></div>
            <div class="col-1 d-flex align-items-center justify-content-center"><i class="fa-solid fa-times text-danger fs-5 remove_row"></i></div>
        `;

        container.appendChild(newRow);

        // Add event listener to the new score input field
        const newScoreInput = newRow.querySelector('.score');
        addGradeListener(newScoreInput);
        // Add event listener to the new grade point input field

        const remove_row_btn = newRow.querySelector('.remove_row');
        remove_row_btn.addEventListener('click', () => {
            remove_row(remove_row_btn);
        });
        
    });


    //search student with ease using their matric number
    search_Student_Btn.addEventListener('click', async () => {
        let initialBtnText = search_Student_Btn.innerHTML;
        search_Student_Btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Please Wait..';

        let searchInput = document.getElementById("searchInput");
        let searchValue = searchInput.value.trim();

        if (searchValue === '') {
            const alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger', 'text-center');
            alert.innerHTML = `
                <i class="fa-solid fa-exclamation-triangle"></i>
                <strong>Error!</strong>
                <span id="alertMessage">Please enter a matriculation number to be searched !</span>
            `;
            alert_Container.appendChild(alert);
            setTimeout(() => {
                alert.remove();
            }, 3000);
            search_Student_Btn.innerHTML = initialBtnText;
        } else {
            const data = {
                matricNumber: searchValue
            };
            const response = await fetch('./public/includes/search_student_by_matric.inc.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (result.status === 'success') {
                const alert = document.createElement('div');
                alert.classList.add('alert', 'alert-success', 'text-center');
                alert.innerHTML = `
                    <i class="fa-solid fa-check-circle"></i>
                    <strong>Success!</strong>
                    <span id="alertMessage">${result.message}</span>
                `;
                alert_Container.appendChild(alert);
                setTimeout(() => {
                    alert.remove();
                }, 3000);

                const studentData = result.data;

                const nameInput = document.getElementById('studentName');
                const matricNumberInput = document.getElementById("matricNumber");
                const departmentInput = document.getElementById("studentDepartment");
                const facultyInput = document.getElementById("studentFaculty");
                const levelInput = document.getElementById("studentLevel");
                setTimeout(() => {
                    nameInput.value = studentData.fullname;
                    matricNumberInput.value = studentData.matricNumber;
                    departmentInput.value = studentData.department;
                    facultyInput.value = studentData.faculty;
                    levelInput.value = studentData.level;
                }, 2000);
            } else {
                const alert = document.createElement('div');
                alert.classList.add('alert', 'alert-danger', 'text-center');
                alert.innerHTML = `
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <strong>Error!</strong>
                    <span id="alertMessage">${result.message}</span>
                `;
                alert_Container.appendChild(alert);
                setTimeout(() => {
                    alert.remove();
                }, 3000);

                const nameInput = document.getElementById('studentName');
                const matricNumberInput = document.getElementById("matricNumber");
                const departmentInput = document.getElementById("studentDepartment");
                const facultyInput = document.getElementById("studentFaculty");
                const levelInput = document.getElementById("studentLevel");
                setTimeout(() => {
                    nameInput.value = '';
                    matricNumberInput.value = '';
                    departmentInput.value = '';
                    facultyInput.value = '';
                    levelInput.value = '';
                }, 2000);
            }
            search_Student_Btn.innerHTML = initialBtnText;
        }
    });

    // Add initial event listeners to any existing score inputs
    document.querySelectorAll(".score").forEach(addGradeListener);
    // Add initial event listeners to any existing grade inputs
    document.querySelectorAll(".grade").forEach(addGradeListener);

    document.querySelectorAll('.remove_row').forEach((row_button)=>{
        row_button.addEventListener('click', ()=>{
            remove_row(row_button);
        })
    });


    //click to preview data and calculate CGP before saving data.
    nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const data = preview_Result_Data();
        console.log(data);
        
        let cgpValue;
        const cgpButton = document.getElementById("calculateCGP");
        cgpButton.addEventListener("click", ()=>{
            calculateCGP();
            cgpValue = calculateCGP();
        });

        const save_Result_Btn = document.getElementById("save_Results_Btn");
        save_Result_Btn.addEventListener('click', async(e)=>{
            e.preventDefault();
            const cgp = cgpValue.toFixed(1);

            let initialBtnText = save_Result_Btn.innerHTML;
            save_Result_Btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Please Wait..';
            
            const res = await fetch('./public/includes/save_Results.inc.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: data.name,
                    matricNumber: data.matricNumber,
                    department: data.department,
                    faculty: data.faculty,
                    level: data.level,
                    academicSession: data.academicSession,
                    courseCodes: data.courseCodes,
                    courseUnits: data.courseUnits,
                    scores: data.scores,
                    grades: data.grades,
                    cgp: cgp
                }),
            })
            const results = await res.json();
            console.log(results)
            save_Result_Btn.innerHTML = initialBtnText;
            if (results.status ==='success') {
                const alertContainer = document.getElementById('preview_Result_Alert')
                const alert = document.createElement('div');
                alert.classList.add('alert', 'alert-success', 'text-center');
                alert.innerHTML = `
                <i class="fa-solid fa-check-circle"></i>
                <strong>Success!</strong>
                <span id="alertMessage">${results.message}</span>
                `;
                alertContainer.appendChild(alert);
                const preview_result_form = document.querySelector(".preview_result .preview_form");
                if(preview_result_form){
                    preview_result_form.scrollTo({
                        top: 0,
                        behavior: "smooth",
                    })
                }
                setTimeout(() => {
                    alert.remove();
                }, 3000);
                // document.querySelector(".preview_result").style.display = 'none';
            }else{
                const preview_result_form = document.querySelector(".preview_result .preview_form")
                const alertContainer = document.getElementById('preview_Result_Alert')
                const alert = document.createElement('div');
                alert.classList.add('alert', 'alert-danger', 'text-center');
                alert.innerHTML = `
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <strong>Error!</strong>
                    <span id="alertMessage">${results.message}</span>
                `;
                alertContainer.appendChild(alert);
                preview_result_form.scrollTo({
                    top: 0,
                    behavior: "smooth",
                })
                setTimeout(() => {
                    alert.remove();
                }, 3000);
            }
            
            
        })
    });


    //function that preview the data.
    function preview_Result_Data() {
        const nameInput = document.getElementById("studentName");
        const matricNumberInput = document.getElementById("matricNumber");
        const departmentInput = document.getElementById("studentDepartment");
        const facultyInput = document.getElementById("studentFaculty");
        const levelInput = document.getElementById("studentLevel");

        let name = nameInput.value.trim();
        let matricNumber = matricNumberInput.value.trim();
        let department = departmentInput.value.trim();
        let faculty = facultyInput.value.trim();
        let level = levelInput.value.trim();
        let academicSession = document.getElementById("academicSession").value.trim();

        const courseCodes = Array.from(document.querySelectorAll(".courseCode")).map(input => input.value.trim());
        const courseUnits = Array.from(document.querySelectorAll(".courseUnit")).map(input => input.value.trim());
        const scores = Array.from(document.querySelectorAll(".score")).map(input => input.value.trim());
        const grades = Array.from(document.querySelectorAll(".grade")).map(input => input.value.trim());

        const data = {
            name: name,
            matricNumber: matricNumber,
            department: department,
            faculty: faculty,
            level: level,
            academicSession: academicSession,
            courseCodes: courseCodes,
            courseUnits: courseUnits,
            scores: scores,
            grades: grades
        };


        if (nameInput.value === '' || matricNumberInput.value === '' || departmentInput.value === '' || facultyInput.value === '' || levelInput.value === '' || courseCodes.includes('') || courseUnits.includes('' || scores.includes('') || grades.includes(''))) {
            const alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger', 'text-center');
            alert.innerHTML = `
                <i class="fa-solid fa-exclamation-triangle"></i>
                <strong>Error!</strong>
                <span id="alertMessage">Please fill in all required fields!</span>
            `;
            alert_Container.appendChild(alert);

            const main__Container = document.querySelector('main')
            if(main__Container){
                main__Container.scrollTo({
                    top: 0,
                    behavior:'smooth'
                })
            }
            setTimeout(() => {
                alert.remove();

            }, 3000);
            return false;
        }else{
            const preview_result_form = document.querySelector(".preview_result");
            preview_result_form.style.display = 'flex';

            
            const name_Input = document.querySelector('#fullnamePreview')
            const matric_Number_Input = document.querySelector('#matricNumberPreview')
            const department_Input = document.querySelector('#departmentPreview')
            const faculty_Input = document.querySelector('#facultyPreview')
            const level_Input = document.querySelector('#levelPreview')
            const examination_Year_Input = document.querySelector('#examinationYearPreview')

            
            name_Input.value = data.name;
            matric_Number_Input.value = data.matricNumber
            department_Input.value = data.department;
            faculty_Input.value = data.faculty;
            level_Input.value = data.level;
            examination_Year_Input.value = data.academicSession;

            const closePopUpBtn = document.getElementById("closePopUpBtn");
            closePopUpBtn.addEventListener('click', (e) => {
                e.preventDefault();
                preview_result_form.style.display = 'none';

                name_Input.value = '';
                matric_Number_Input.value = '';
                department_Input.value = '';
                faculty_Input.value = '';
                level_Input.value = '';
                examination_Year_Input.value = '';

                const cgpInput = document.getElementById("cgpInput");
                cgpInput.value = '';

                const tableBody = document.querySelector("#table tbody");
                tableBody.innerHTML = '';

            });


            let table_count = 0;
            const table = document.querySelector('#table')
            const tableBody = table.querySelector('tbody')
            for (let i = 0; i < courseCodes.length; i++) {
                const row = document.createElement("tr");
                row.classList.add("table-row", "text-center");


                const S_N = document.createElement("th");
                S_N.textContent = ++table_count;
                S_N.classList.add('index');
                row.appendChild(S_N);

                const courseCodeCell = document.createElement("td");
                courseCodeCell.textContent = courseCodes[i];
                courseCodeCell.classList.add('course__code');
                row.appendChild(courseCodeCell);

                const courseUnitCell = document.createElement("td");
                courseUnitCell.textContent = courseUnits[i];
                courseUnitCell.classList.add('course__unit');
                row.appendChild(courseUnitCell);

                const scoreCell = document.createElement("td");
                scoreCell.textContent = scores[i];
                scoreCell.classList.add('grade__scores')
                row.appendChild(scoreCell);

                const gradeCell = document.createElement("td");
                gradeCell.textContent = grades[i];
                row.appendChild(gradeCell);

                tableBody.appendChild(row);
            }

        }

        return data;
    }

    function calculateCGP(){
        const containerRows = document.querySelectorAll("#fieldsContainer .container .row");
        let totalScore = 0;
        let totalCourseUnit = 0;
        containerRows.forEach((containerRow)=>{
            const courseUnit = parseFloat(containerRow.querySelector(".courseUnit").value);
            const gradePoint = parseFloat(containerRow.querySelector(".gradePoint").value);

            const cummulativeScore = courseUnit * gradePoint;
            totalScore += cummulativeScore
            totalCourseUnit += courseUnit;
        })

        const cgp = parseFloat(totalScore) / parseFloat(totalCourseUnit);
        const cgpInput = document.getElementById('cgpInput');
        cgpInput.value = cgp.toFixed(1);

        return cgp;
    }
});
