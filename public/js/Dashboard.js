document.addEventListener("DOMContentLoaded", function () {
    let currentDate = new Date();
    const mobileMenu = document.querySelector(".mobile-Sidebar-Container");
    const toggleMenu = document.getElementById("menuBtn");
    const closeMenu = document.getElementById("closeMenu");

    toggleMenu.addEventListener('click', ()=>{
        mobileMenu.classList.add('show');
        document.body.style.overflow = 'hidden';
    })

    closeMenu.addEventListener('click', ()=>{
        mobileMenu.classList.remove('show');
        document.body.style.overflow = 'scroll';
    })

    function drawCalendar(year, month) {
        const firstDay = new Date(year, month).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const tbl = document.getElementById("calendar-body"); // body of the calendar
        tbl.innerHTML = "";

        // filling data about month and in the page via DOM.
        document.getElementById("month-year").innerHTML =
        months[month] + " " + year;

        // creating all cells
        let date = 1;
        for (let i = 0; i < 6; i++) {
        let row = document.createElement("tr");

        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
            let cell = document.createElement("td");
            let cellText = document.createTextNode("");
            cell.appendChild(cellText);
            row.appendChild(cell);
            } else if (date > daysInMonth) {
            break;
            } else {
            let cell = document.createElement("td");
            let cellText = document.createTextNode(date);
            if (
                date === currentDate.getDate() &&
                year === currentDate.getFullYear() &&
                month === currentDate.getMonth()
            ) {
                cell.classList.add("bg-info");
            }
            cell.appendChild(cellText);
            row.appendChild(cell);
            date++;
            }
        }

        tbl.appendChild(row);
        }
    }

    function previous() {
        currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
        currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
        drawCalendar(currentYear, currentMonth);
    }

    function next() {
        currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
        currentMonth = currentMonth === 11 ? 0 : currentMonth + 1;
        drawCalendar(currentYear, currentMonth);
    }

    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    let months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    document.getElementById("prev-month").addEventListener("click", previous);
    document.getElementById("next-month").addEventListener("click", next);

    drawCalendar(currentYear, currentMonth);

    const getStudentCount = async() =>{

        const res = await fetch('./public/includes/countStudent.inc.php')
        const data = await res.json();
        console.log(data)
        if(data.error){
            console.log('Error Fetching data: ', data.error)
        }else{
            document.getElementById('studentCount').innerText = data.totalStudents;
        }

    }

    getStudentCount();
    setInterval(getStudentCount, 2000);
    
});
