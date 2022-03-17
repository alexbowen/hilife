(function() {
  if (!document.getElementById("dj-carousel")) {
    return;
  }
  
  var i = 0;
  var cached = false;
  var container = document.getElementById("dj-carousel");
  var image = document.querySelector(".profile-photo img");
  var name = document.querySelector(".profile-text h4");
  var text = document.querySelector(".profile-text p");

  container.classList.add("initial");

  function loadImage(index) {
    var img = new Image();
    img.src = "/assets/images/dj/" + djs_json[index].image.file;
  }

  function setItem(index) {
    image.src = "/assets/images/dj/" + djs_json[index].image.file;
    image.alt = djs_json[index].image.alt;
    name.innerHTML = djs_json[index].name;
    text.innerHTML = djs_json[index].summary;

    // preload next image
    if (!cached) {
      loadImage(index + 1);
    }
  }

  function carousel() {
    if (container.classList.contains("initial")) {
      container.classList.remove("initial");
      container.classList.add("image-right");
    }

    setItem(i);

    if (i === djs_json.length - 2) {
      i = 0;
      cached = true;
    } else {
      i++;
    }

    container.classList.toggle("image-right");
    container.classList.toggle("image-right");
  }

  loadImage(0);
  setInterval(carousel, 3000);
})();