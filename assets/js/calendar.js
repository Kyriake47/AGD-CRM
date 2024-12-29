function generateCalendar(year, month) {
    const $monthday = $('.monthdays');
    const $monthName = $('.month-name');
    $monthday.empty();
    const date = new Date(year, month);
    const firstDay = date.getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    $monthName.text(date.toLocaleString('pl-PL', { month: 'long', year: 'numeric' }));

    const adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;

    for (let i = 0; i < adjustedFirstDay; i++) {
        $('<div>').addClass('day').appendTo($monthday);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        $('<div>')
            .addClass('day')
            .html(`<span class="day-number">${day}</span>`)
            .appendTo($monthday);
    }
}

$(document).ready(function () {
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();
    generateCalendar(currentYear, currentMonth);

    $('#prev-month').click(function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    });
    
    $('#next-month').click(function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    });
    
});
