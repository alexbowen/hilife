// var djs = [
//   {
//         image: "/assets/images/dj/DJ_Chris.png",
//         alt: "DJ Chris Hall of Hi-Life Entertainment",
//         name: "DJ Chris Hall",
//         text:
//           "DJ Chris Hall covers all styles from funk and soul to hip hop and house and works very well with live musicians, like sax and bongo players."
//       },  
   
//       {
//         image: "/assets/images/dj/DJ_Nite_Owl.png",
//         alt: "wedding dj & disco hire DJ Nite Owl",
//         name: "DJ Nite Owl",
//         text:
//           "All things funky. DJ Nite Owl is a fun loving party machine, who can play DJ sets, both retro and current for weddings, parties and club events."
//       },
//       {
//         image: "/assets/images/dj/DJ_Maree.png",
//         alt: "female DJ Maree plays Motown, soul, pop and dance at weddings and parties in Huddersfield Leeds Halifax York and Harrogate",
//         name: "DJ Maree",
//         text:
//           "Motown, disco, chart and R&B. Maree plays weddings and parties, corporate events and theme nights, bringing the floorfillers."
//       },
//     {
//         image: "/assets/images/dj/DJ_Darren.png",
//         alt: "DJ Darren Baxter of Hi-Life Entertainment",
//         name: "DJ Darren Baxter",
//         text:
//           "Darren has been with us since 2006, playing hundreds of weddings and parties in all styles of music. He has great mixing skills and a wide knowledge of music."
//       },
//       {
//         image: "/assets/images/dj/DJ_Rich_Banks.png",
//         alt: "DJ Rich Banks plays northern soul, funk, disco, indie and mod for weddings and party events in Leeds and Yorkshire",
//         name: "DJ Rich Banks",
//         text:
//           "DJ Rich banks, versatile, experienced DJ, who can cover northern soul, motown, funk, indie, rock, and a whole lot more."
//       },
//       {
//         image: "/assets/images/dj/DJ_Mark_Hepworth.png",
//         alt: "DJ Mark Hepworth plays reggae, soul, northern soul, afrobeats, and urban for weddings and bar nights in the Leeds area",
//         name: "DJ Mark Hepworth",
//         text:
//           "Funk, soul, ska, hip hop, r&b, afrobeats, rock, punk, indie, house or electronic music. Vinyl sets also in certain styles of music."
//       },
      
//       {
//         image: "/assets/images/dj/DJ_Dan_De_Lissandri.png",
//         alt: "Experienced DJ and technically a brillinant mixer of house, disco and electronic music",
//         name: "DJ Dan De Lissandri",
//         text:
//           "A very experienced DJ, with very technical mixing skills, that can play all styles of music for weddings or bar events."
//       },
   
//       {
//         image: "/assets/images/dj/DJ_Bryn.png",
//         alt: "DJ Bryn for all things current and classic in DJing in the leeds area",
//         name: "DJ Bryn",
//         text:
//           "Vibrant and popular DJ that has worked in many and different types of event and always gets great feedback from clients, playing popular or eclectic sets."
//       },
//       {
//         image: "/assets/images/dj/DJ_Jonathan_Wright.png",
//         alt: "wedding dj & disco hire in Leeds & Yorkshire DJ Jonathan Wright",
//         name: "DJ Jonathan Wright",
//         text:
//           "Experienced DJ, who can cover many styles from northern soul, salsa and reggae to current chart. A personality style DJ and vast knowledge of music. "
//       },
//     {
//         image: "/assets/images/dj/DJ_Mel.png",
//         alt: "DJ Mel Sear, AKA Mel Low D, plays bar club and private events, dance, R&B & party styles",
//         name: "DJ Mel Low D",
//         text:
//           "A very popular DJ at our club residencies, who can play many styles of music from dance and R&B to retro sets too."
//       },
//     {
//         image: "/assets/images/dj/DJ_Tim.png",
//         alt: "DJ Tim Pinder plays bespoke DJ sets for weddings, parties and corporate events",
//         name: "DJ Tim Pinder",
//         text:
//           "Tim is a versatile, fun and experienced DJ who is drawn to music that has a groove, a good beat, and an innovative sound."
//       },
//    {
//         image: "/assets/images/dj/DJ_Spike_Griffin.png",
//         alt: "DJ Spike Griffin for all things rock, metal, punk, indie and dance",
//         name: "DJ Spike Griffin",
//         text:
//           "Rock, metal, indie, punk, steampunk and more. Spike is a versatile DJ for all types of events."
//       }, 
//     ];

(function() {
  if (!document.getElementById("dj-carousel")) {
    return;
  }
  
  var i = 0;
  var cached = false;
  var container = document.getElementById("dj-carousel");
  var image = document.querySelector(".profile-photo img");
  var name = document.querySelector(".profile-text h3");
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