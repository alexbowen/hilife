document.addEventListener('DOMContentLoaded', () => {
  Array.from(document.querySelectorAll('[data-auto-submit="true"]')).forEach((form) => {
    form.addEventListener('change', (e) => {
      e.target.closest('form').submit();
    });
  });
});