// Elements
let bannerEl = document.querySelector(".banner");
let sliderEl = document.querySelectorAll(".slider");
let previousEl = document.querySelector(".previous");
let nextEl = document.querySelector(".next");
let linksEl = document.querySelector(".links");
let imgLinks = linksEl.getElementsByTagName("a");

// Data attributes
let height = bannerEl.getAttribute("data-height");
let width = bannerEl.getAttribute("data-width");
let slideSpeed = bannerEl.getAttribute("data-slide-speed");
let autoSlide = bannerEl.getAttribute("data-autoslide");
let nextCursor = nextEl.getAttribute("data-next-cursor");
let previousCursor = previousEl.getAttribute("data-previous-cursor");

// Slider variables
let totalImgs = imgLinks.length;
let currentImgNumber = 1;
let nextImgNumber = currentImgNumber + 1;
let previousImgNumber = totalImgs;
let randomImgNumber = 4;
let currentImg = bannerEl.querySelector('img:nth-of-type(' + currentImgNumber + ')');
let nextImg = bannerEl.querySelector('img:nth-of-type(' + nextImgNumber + ')');
var previousImg = bannerEl.querySelector('img:nth-of-type(' + previousImgNumber + ')');
let randomImg = bannerEl.querySelector('img:nth-of-type(' + randomImgNumber + ')');

// Set CSS to element or elements
function setCSS(styles, elements) {
  if (elements.length > 1) {
    for (let i = 0; i < elements.length; i++) {
      Object.assign(elements[i].style, styles);
    }
  } else {
    Object.assign(elements.style, styles);
  }
}

// Set CSS before elements appear
document.body.style.margin = '0';

setCSS({
  width: width,
  height: height + 'px',
  margin: '0 auto',
  position: 'relative'
}, bannerEl);

setCSS({
  position: 'absolute',
  width: '50%',
  height: height + 'px',
  top: '0'
}, [previousEl, nextEl]);

setCSS({
  cursor: (totalImgs <= 1) ? 'default' : previousCursor ? 'url(' + previousCursor + '), auto' : 'w-resize',
  width: '50%',
  left: '0'
}, previousEl);

setCSS({
  cursor: (totalImgs <= 1) ? 'default' : nextCursor ? 'url(' + nextCursor + '), auto' : 'e-resize',
  right: '0'
}, nextEl);

setCSS({
  'text-align': 'center',
  position: 'relative',
  top: '550px',
  left: '0', 'right': '0',
  margin: 'auto',
  cursor: 'default',
  width: imgLinks.length * 30 + 'px'
}, linksEl);

// For multiple elements of same class
// Iterate over and set individual element's CSS
for (let i = 0; i < sliderEl.length; i++) {
  setCSS({
    width: width, 'height':
    height + 'px', 'margin': '0 auto'
  }, sliderEl[i]);

  setCSS({
    position: 'absolute',
    opacity: '0', 'object-fit': 'cover'
  }, sliderEl[i]);
}

for (let i = 0; i < imgLinks.length; i++) {
  setCSS({
    color: '#000',
    display: 'inline-block',
    'text-decoration': 'none',
    background: '#FFF',
    'border-radius': '50%',
    height: '15px',
    width: '15px',
    margin: '10px 5px',
    transition: 'all 0.5s'
  }, imgLinks[i]);
}

(function() {
  function fadeTo(element, speed, opacity) {
    setCSS({
      transition: 'opacity ' + speed + 'ms',
      opacity: opacity
    }, element);
  }

  function loadImg() {
    fadeTo(currentImg, slideSpeed, 1);
  }

  function nextImgFade() {
    fadeTo(currentImg, slideSpeed, 0);
    fadeTo(nextImg, slideSpeed, 1);
  }

  function previousImgFade() {
    fadeTo(currentImg, slideSpeed, 0);
    fadeTo(previousImg, slideSpeed, 1);
  }

  function randomImgFade() {
    fadeTo(currentImg, slideSpeed, 0);
    fadeTo(randomImg, slideSpeed, 1);
  }

  function boldText() {
    for (let i = 0; i < imgLinks.length; i++) {
        let currentHref = imgLinks[i].getAttribute('href');
        let opacity = currentImgNumber == currentHref ? 0.8 : 0.4;
      setCSS({opacity: opacity}, imgLinks[i]);
    }
  }

  function imgLoop() {
    nextImgNumber = currentImgNumber + 1;
    previousImgNumber = currentImgNumber - 1;

    if (currentImgNumber == totalImgs) {
      nextImgNumber = 1;
    }

    if (currentImgNumber == 1) {
      previousImgNumber = totalImgs;
    }
  }

  function refreshImgs() {
    currentImg = bannerEl.querySelector('img:nth-of-type(' + currentImgNumber + ')');
    nextImg = bannerEl.querySelector('img:nth-of-type(' + nextImgNumber + ')');
    previousImg = bannerEl.querySelector('img:nth-of-type(' + previousImgNumber + ')');
    randomImg = bannerEl.querySelector('img:nth-of-type(' + randomImgNumber + ')');
  }

  function callFunctions() {
    boldText();
    imgLoop();
    refreshImgs();
  }

  function restartInterval() {
    clearInterval(interval);
    interval = setInterval(loopImages, autoSlide);
  }

  function loopImages() {
      let event = document.createEvent('HTMLEvents');
    event.initEvent('click', 1, 0);
    nextEl.dispatchEvent(event);
  }

  // Iterate over all links
  // On link click, restart interval, and fade in that image
  for (let i = 0; i < imgLinks.length; i++) {
    imgLinks[i].onclick = function() {
      restartInterval();
      randomImgNumber = parseInt(this.getAttribute('href'));
      randomImg = bannerEl.querySelector('img:nth-of-type(' + randomImgNumber + ')');
      randomImgFade();
      currentImgNumber = randomImgNumber;
      callFunctions();
      return false;
    };
  }

  // Iterate over previous and next elements
  // On click, check direction, fade next image in and assign current image number
    let previousAndNext = [previousEl, nextEl];
  for (let t = 0; t < previousAndNext.length; t++) {
    if (totalImgs > 1) {
      previousAndNext[t].onclick = function(e) {
          let direction = e.target.getAttribute('class');
        if (direction == "next") {
          nextImgFade();
          currentImgNumber = nextImgNumber;
        } else {
          previousImgFade();
          currentImgNumber = previousImgNumber;
        }
        restartInterval();
        callFunctions();
      };
    }
  }

  boldText();
  loadImg();

  // Only set interval if there is more than 1 image
  if (totalImgs > 1) {
      let interval = setInterval(loopImages, autoSlide);
  }
})();