document.addEventListener('DOMContentLoaded', function () {
  Array.from(document.getElementsByClassName('print-action')).forEach(function (el) {
    el.addEventListener('click', function () {
      window.print();
    });
  });
});
