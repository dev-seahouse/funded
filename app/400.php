<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  <style>
    /* ---- reset ---- */

    body {
      font:normal 75% Arial, Helvetica, sans-serif;
    }
    h1,h2{
      background:transparent;
    }

    canvas {
      display: block;
      vertical-align: bottom;
    }

    /* ---- particles.js container ---- */

    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: #FFA500;
      background-image: url("");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: 50% 50%;
    }

    #particles-js h1, #particles-js h2{
      z-index: 9999;
      color:white;
    }

    /* ---- stats.js ---- */

    .count-particles{
      background: #000022;
      position: absolute;
      top: 48px;
      left: 0;
      width: 80px;
      color: #13E8E9;
      font-size: .8em;
      text-align: left;
      text-indent: 4px;
      line-height: 14px;
      padding-bottom: 2px;
      font-family: Helvetica, Arial, sans-serif;
      font-weight: bold;
    }


  </style>
  <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

</head>
<body>

<div id="particles-js">

  <h1 class="display-2">We searched and search but </h1>
  <h2 class="display-5">The page does not wish to be found.</h2>
</div>

<script>
  /* ---- particles.js config ---- */

  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 380,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#ffffff"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#000000"
        },
        "polygon": {
          "nb_sides": 5
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.5,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "value": 3,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 6,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "bounce": false,
        "attract": {
          "enable": false,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": true,
          "mode": "grab"
        },
        "onclick": {
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 140,
          "line_linked": {
            "opacity": 1
          }
        },
        "bubble": {
          "distance": 400,
          "size": 40,
          "duration": 2,
          "opacity": 8,
          "speed": 3
        },
        "repulse": {
          "distance": 200,
          "duration": 0.4
        },
        "push": {
          "particles_nb": 4
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true
  });


</script>
</body>
</html>

