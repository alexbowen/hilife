document.addEventListener('DOMContentLoaded', function () {
  Array.from(document.getElementsByClassName('event-date-input')).forEach(function (dateInput) {
    Array.from(dateInput.getElementsByTagName('select')).forEach(function(select) {
      select.addEventListener('change', function () {
        setDisabled(dateInput);
      });
    });
  });
});

function setDisabled(dateInput) {
  const daySelect = dateInput.querySelector('select[data-date-part="day"]');
  const monthSelect = dateInput.querySelector('select[data-date-part="month"]');
  const yearSelect = dateInput.querySelector('select[data-date-part="year"]');
  const daysInMonth = moment(`${yearSelect.value} ${monthSelect.value}`, "YYYY M").daysInMonth();

  Array.from(daySelect.querySelectorAll('option')).forEach(function(dayOption) {

    dayOption.style.display = 'block';

    if (parseInt(yearSelect.value, 10) === moment().year()) {
      if (moment().month() > monthSelect.value - 1) {
        dayOption.style.display = 'none';
      };

      if (moment().month() === monthSelect.value - 1 && dayOption.value < moment().date()) {
        dayOption.style.display = 'none';
      };
    }

    if (dayOption.value > daysInMonth) {
      dayOption.style.display = 'none';
    };
  });

  Array.from(monthSelect.querySelectorAll('option')).forEach(function(monthOption) {
    
    monthOption.style.display = 'block';

    if (parseInt(yearSelect.value, 10) === moment().year()) {
      if (monthOption.value <= moment().month()) {
        monthOption.style.display = 'none';
      };
    }
  });
}