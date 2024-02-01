$(document).ready(function () {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();
    $("#currentMonth").text(getMonthName(currentMonth) + " " + currentYear);
    generateCalendar(currentMonth, currentYear);
    loadMonths();
});

function getMonthName(month) {
    var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    return monthNames[month];
}

function generateCalendar(month, year) {
    var firstDay = new Date(year, month, 1);
    var lastDay = new Date(year, month + 1, 0);
    var startDate = firstDay.getDate();
    var endDate = lastDay.getDate();

    var calendarBody = $("#calendarBody");
    calendarBody.empty();
    var dayCounter = 1;
    for (var i = 0; i < 6; i++) {
        var row = $("<tr></tr>");
        for (var j = 0; j < 7; j++) {
            if ((i === 0 && j < firstDay.getDay()) || dayCounter > endDate) {
                row.append("<td></td>");
            } else {
                var day = dayCounter;
                var today = new Date();
                if (
                    today.getDate() === day &&
                    today.getMonth() === month &&
                    today.getFullYear() === year
                ) {
                    row.append("<td class='today'>" + day + "</td>");
                } else {
                    row.append("<td>" + day + "</td>");
                }
                dayCounter++;
            }
        }
        calendarBody.append(row);
    }
}

function actualizarReloj() {
    var now = new Date();
    var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    var dayName = days[now.getDay()];
    var dayOfMonth = now.getDate();
    var months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    var monthName = months[now.getMonth()];
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    var timeString = dayName + " " + dayOfMonth + " de " + monthName + " " + hours + ":" + minutes + ":" + seconds;
    $("#clock").text(timeString);
}

$(document).ready(function () {
    actualizarReloj(); 
    setInterval(actualizarReloj, 1000); 
});

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('[data-tab]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const tabName = tab.dataset.tab;
            showTab(tabName);
        });
    });

    function showTab(tabName) {
        const allTabs = document.querySelectorAll('[data-tab]');
        allTabs.forEach(tab => {
            tab.classList.remove('active');
        });

        const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
        activeTab.classList.add('active');
        
        const empleadoRows = document.querySelectorAll('.empleado-row');
        empleadoRows.forEach(row => {
            row.classList.add('d-none');
        });

        const selectedEmpleados = document.querySelectorAll(`.empleado-${tabName}`);
        selectedEmpleados.forEach(row => {
            row.classList.remove('d-none');
        });
    }
});

function loadMonths() {
    var selectMes = document.getElementById('selectMes');
    var currentMonth = new Date().getMonth();

    var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    for (var i = 0; i < 12; i++) {
        var option = document.createElement('option');
        var monthIndex = (currentMonth + i) % 12;
        option.value = monthIndex;
        option.text = monthNames[monthIndex];
        selectMes.add(option);
    }

    selectMes.addEventListener('change', function () {
        var selectedMonth = this.value;
        updateCalendar(selectedMonth);
    });
}

function updateCalendar(selectedMonth) {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    generateCalendar(selectedMonth, currentYear);
    $("#currentMonth").text(getMonthName(selectedMonth) + " " + currentYear);
}

