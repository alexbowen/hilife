document.addEventListener('DOMContentLoaded', function () {
  Array.from(document.getElementsByClassName('toggle-control')).forEach(function (toggle) {
    toggle.addEventListener('click', function (e) {
      Array.from(document.getElementsByClassName('toggle-control')).forEach(function (reset) {
        if (reset.dataset.contentId !== e.target.dataset.contentId) {
          reset.classList.remove('toggle-control--show');
        }
      });
      Array.from(document.getElementsByClassName('toggle-content')).forEach(function (content) {
        if (content.id !== e.target.dataset.contentId) {
          content.classList.add('toggle-content--hidden');
        }
      });
      document.getElementById(e.target.dataset.contentId).classList.toggle('toggle-content--hidden');
      toggle.classList.toggle('toggle-control--show');
    });
  });
});