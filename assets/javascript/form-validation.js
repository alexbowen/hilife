(function () {
  'use strict'

  function checkTimeValidity(form) {
    const parts = [];
    Array.from(form.querySelectorAll('.event-time-input')).forEach(function (timeInput) {
      let time = '';
      Array.from(timeInput.getElementsByTagName('select')).forEach(function(select) {
        if (select.value) {
          if (select.value == 0) {
            time += '00';
          } else {
            time += select.value;
          }
      
          parts[timeInput.dataset.order] = parseInt(time, 10);
        }
      });
    });

    if (parts[parts.length - 1] < 700) {
      parts[parts.length - 1] = parts[parts.length - 1] + 2400;
    }

    const parts_filtered = parts.filter(function (el) {
      return el != null;
    });

    return parts_filtered.slice(1).map((e,i) => e > parts_filtered[i]).every(x => x);
  }

  function setValidity(form) {
    let classFn, validity;
    const invalidClass = 'is-invalid';

    if (!checkTimeValidity(form)) {
      classFn = 'add';
      validity = 'invalid';
    } else {
      classFn = 'remove';
      validity = '';
    }

    Array.from(form.querySelectorAll('.event-time-input')).forEach(function (timeInput) {
      Array.from(timeInput.getElementsByTagName('select')).forEach(function(select) {
        select.classList[classFn](invalidClass);
        select.setCustomValidity(validity);
      });
    });
  }

  var forms = document.querySelectorAll('.needs-validation');

  Array.prototype.slice.call(forms)
    .forEach(function (form) {

      Array.from(form.querySelectorAll('.event-time-input')).forEach(function (timeInput) {
        Array.from(timeInput.getElementsByTagName('select')).forEach(function(select) {
          select.addEventListener('change', function () {
            setValidity(form);
          });
        });
      });

      form.addEventListener('submit', function (event) {

        setValidity(form);
    
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      }, false);
    });
})();
