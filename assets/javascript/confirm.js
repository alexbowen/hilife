document.addEventListener('DOMContentLoaded', function () {
  Array.from(document.getElementsByClassName('confirm-action')).forEach(function (el) {
    el.addEventListener('click', function (e) {
      if (!confirm('Are you sure you want to do this?')) {
        e.preventDefault();
      }
    });
  });
});