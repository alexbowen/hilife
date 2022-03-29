document.addEventListener('DOMContentLoaded', function () {
  Array.from(document.getElementsByClassName('confirm-action')).forEach(function (el) {
    el.addEventListener('click', function (e) {
      if (!confirm(e.target.dataset['confirmMessage'])) {
        e.preventDefault();
      }
    });
  });
});