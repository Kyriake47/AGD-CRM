function generateCalendar(year, month) {
    const $monthday = $('.monthdays');
    const $monthName = $('.month-name');
    $monthday.empty();
    const date = new Date(year, month);
    const firstDay = date.getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const today = new Date();
    const todayYear = today.getFullYear();
    const todayMonth = today.getMonth();
    const todayDate = today.getDate();

    $monthName.text(date.toLocaleString('pl-PL', { month: 'long', year: 'numeric' }));

    const adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;

    for (let i = 0; i < adjustedFirstDay; i++) {
        $('<div>').addClass('day').appendTo($monthday);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const currentDate = new Date(year, month, day);
        const currentDayOfWeek = currentDate.getDay();
        const $dayElement = $('<div>')
            .addClass('day')
            .html(`<span class="day-number">${day}</span>`);
        if (currentDayOfWeek === 0 || currentDayOfWeek === 6) {
            $dayElement.addClass('weekend');
        }
        if (year === todayYear && month === todayMonth && day === todayDate) {
            $dayElement.addClass('today');
        }
        $dayElement.appendTo($monthday);
    }
    fetchTasks(year, month);
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

function fetchTasks(year, month) {
    const url = 'handling/get-tasks.php';
    const formData = { year: year, month: month };
    //console.log('Base page URL:', window.location.href);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
            try {
                //console.log('Raw response:', response);
                const tasks = JSON.parse(response);
                tasks.forEach(task => {
                    const taskDate = new Date(task.task_date);
                    const taskDay = taskDate.getDate();

                    const $dayElement = $('.monthdays .day').filter(function () {
                        return $(this).find('.day-number').text() == taskDay;
                    });

                    if ($dayElement.length > 0) {
                        $('<div>')
                            .addClass('task')
                            .text(task.title)
                            .appendTo($dayElement);
                    }
                });
            } catch (error) {
                console.error('Błąd parsowania odpowiedzi JSON:', error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Błąd AJAX:', textStatus, errorThrown);
        }
    });
}
