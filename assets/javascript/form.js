document.addEventListener('DOMContentLoaded', () => {
  Array.from(document.querySelectorAll('[data-auto-submit="true"]')).forEach((form) => {
    form.addEventListener('change', (e) => {
      e.target.closest('form').submit();
    });
  });

  Array.from(document.getElementsByClassName('needs-activation')).forEach(function (el) {
    el.addEventListener('change', function (e) {
      el.querySelector('.active-element').setAttribute('disabled', true)
      Array.from(el.querySelectorAll('input[type="checkbox"]')).forEach(function(cb) {
        if (cb.checked) {
          el.querySelector('.active-element').removeAttribute('disabled')
        }
      })
    });
  });
});