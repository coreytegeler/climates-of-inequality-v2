(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define("nychvs", [], factory);
	else if(typeof exports === 'object')
		exports["nychvs"] = factory();
	else
		root["nychvs"] = factory();
})(window, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/script.js":
/*!***********************!*\
  !*** ./src/script.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function ($) {
  const html = document.querySelector("html"),
        body = document.querySelector("body"); // require("jquery-ui/draggable");

  /*****************************
  ************HEADER************
  *****************************/

  const burgers = document.querySelectorAll(".burger"),
        mobileNav = document.querySelector("nav#mobile-nav"),
        menuItems = document.querySelectorAll("#main-nav .menu-item-button");

  const onBurgerClick = e => {
    mobileNav.classList.toggle("open");

    if (mobileNav.classList.contains("open")) {
      e.target.setAttribute("aria-expanded", "true");
    } else {
      e.target.setAttribute("aria-expanded", "false");
    }
  };

  burgers.forEach(burger => {
    burger.addEventListener("click", onBurgerClick);
  }); // const skipButton = document.querySelector("#skip-to-content");
  // if(skipButton) {
  // 	skipButton.addEventListener("click", (e) => {
  // 	});
  // }

  /*****************************
  ************FILTERS***********
  *****************************/

  const loop = document.querySelector("#loop"),
        filterSelects = document.querySelectorAll(".select-dropdown select"),
        filterNotice = document.querySelector("#filter-notice"),
        filterList = document.querySelector("#filter-list"),
        filterReset = document.querySelector("#filter-reset");

  const onFilterUpdate = e => {
    const params = {},
          select = e.target,
          selected = select.options[select.selectedIndex],
          label = select.previousElementSibling,
          value = select.value,
          labelText = value ? selected.text : label.dataset.default;
    filterSelects.forEach(select => {
      if (select.value) {
        params[select.id] = select.value;
      }
    });
    label.innerText = labelText; // const newURL = settings.current + paramify(params);

    getLoop(params);
    updateFilterList();
  };

  const onFilterReset = e => {
    filterSelects.forEach(select => {
      const label = select.previousElementSibling,
            labelText = label.dataset.default;
      label.innerText = labelText;
      select.value = '';
    });
    getLoop();
    updateFilterList();
  };

  const updateFilterList = () => {
    filterList.innerHTML = "";
    filterSelects.forEach(select => {
      const selected = select.options[select.selectedIndex];

      if (selected.value) {
        filterList.innerHTML += `<span class="mr-sm">${selected.text}</span>`;
      }
    });
    filterNotice.setAttribute("aria-hidden", !filterList.innerHTML);
  };

  const getLoop = (params = {}) => {
    params.type = loop.dataset.postType;
    const xhttp = new XMLHttpRequest(),
          reqURL = settings.api + "get_loop" + paramify(params);

    xhttp.onreadystatechange = () => {
      if (xhttp.readyState === 4 && xhttp.status === 200) {
        loop.innerHTML = xhttp.responseText;
        loop.classList.remove("loading");
      }
    };

    xhttp.open("GET", reqURL, true);
    xhttp.send();
    loop.classList.add("loading");
  };

  const paramify = obj => {
    return "?" + Object.keys(obj).map(key => {
      return key + "=" + encodeURIComponent(obj[key]);
    }).join("&");
  };

  filterSelects.forEach(filterSelect => {
    filterSelect.addEventListener("change", onFilterUpdate);
  });

  if (filterReset) {
    filterReset.addEventListener("click", onFilterReset);
  }

  const togglePastButton = document.querySelector("#toggle-past-button");

  if (togglePastButton) {
    togglePastButton.addEventListener("click", e => {
      body.classList.toggle("show-past");

      if (body.classList.contains("show-past")) {
        togglePastButton.setAttribute("aria-expanded", "true");
      } else {
        togglePastButton.setAttribute("aria-expanded", "false");
      }
    });
  }
  /*****************************
  ***********SLIDESHOW**********
  *****************************/


  const slideshows = document.querySelectorAll(".slideshow");

  const slideshowSetup = slideshow => {
    const arrows = slideshow.querySelectorAll(".slideshow-arrow");
    arrows.forEach(arrow => {
      arrow.addEventListener("click", e => {
        const direction = arrow.dataset.direction;
        moveSlideshow(slideshow, direction);
      });
    });
  };

  const moveSlideshow = (slideshow, direction) => {
    const mediaSlides = slideshow.querySelectorAll(".slide.media"),
          captionSlides = slideshow.querySelectorAll(".slide.caption"),
          coverSlides = slideshow.querySelectorAll(".cover-slide"),
          slidesLength = parseInt(slideshow.dataset.length),
          currentIndex = parseInt(slideshow.dataset.active);
    let newIndex;

    if (direction === "next") {
      newIndex = currentIndex + 1;

      if (currentIndex >= slidesLength - 1) {
        newIndex = 0;
      }
    }

    if (direction === "prev") {
      newIndex = currentIndex - 1;

      if (newIndex < 0) {
        newIndex = slidesLength - 1;
      }
    }

    slideshow.dataset.active = newIndex;

    if (mediaSlides[currentIndex]) {
      mediaSlides[currentIndex].classList.remove("active");
    }

    if (captionSlides[currentIndex]) {
      captionSlides[currentIndex].classList.remove("active");
    }

    if (coverSlides[currentIndex]) {
      coverSlides[currentIndex].classList.remove("active");
      menuItems[currentIndex].classList.remove("active");
    }

    if (mediaSlides[newIndex]) {
      mediaSlides[newIndex].classList.add("active");
    }

    if (captionSlides[newIndex]) {
      captionSlides[newIndex].classList.add("active");
    }

    if (coverSlides[newIndex]) {
      coverSlides[newIndex].classList.add("active");
      menuItems[newIndex].classList.add("active");
    }
  };

  slideshows.forEach(slideshow => {
    slideshowSetup(slideshow);
  });
  const coverSlideshow = document.querySelector("#cover-slideshow");

  if (coverSlideshow) {
    setInterval(() => {
      if (!coverSlideshow.classList.contains("paused")) {// moveSlideshow(coverSlideshow, "next");
      }
    }, 4000);
    coverSlideshow.addEventListener("mouseover", e => {
      coverSlideshow.classList.add("paused");
    });
    coverSlideshow.addEventListener("mouseleave", e => {
      coverSlideshow.classList.remove("paused");
    });
  }
  /*****************************
  ***********STORY MAP**********
  *****************************/


  const storyMap = document.querySelector("#story-map"),
        markers = document.querySelectorAll("#story-map svg > g");

  const onMarkerClick = index => {
    const oldPanel = document.querySelector(".marker-panel.open"),
          newPanel = document.querySelector(`.marker-panel[data-index="${index}"]`);
    oldPanel.classList.remove("open");
    newPanel.classList.add("open");
  };

  markers.forEach((marker, i) => {
    const index = markers.length - i; // marker.dataset.index = markers.length - i;

    marker.addEventListener("click", e => {
      onMarkerClick(index);
    });
  });
  /*****************************
  ************VIDEOS************
  *****************************/

  const videos = document.querySelectorAll("video");
  videos.forEach(video => {
    video.removeAttribute("controls");
    video.addEventListener("play", () => {
      video.parentElement.classList.add("playing");
    });
    video.addEventListener("pause", () => {
      video.parentElement.classList.remove("playing");
    });
    video.addEventListener("click", () => {
      if (video.paused) {
        video.play();
      } else {
        video.pause();
      }
    });
  });
  /*****************************
  ************MASONRY***********
  *****************************/

  const masonryElems = document.querySelectorAll(".masonry");
  masonryElems.forEach(masonryElem => {
    const masonryInst = new Masonry(masonryElem, {
      itemSelector: '.col',
      percentPosition: true,
      // gutter: '.gutter-sizer',
      transitionDuration: 0
    });
  });
  /*****************************
  **********TAKE ACTION*********
  *****************************/

  const wpForm = document.querySelector("#respond .comment-form");
  /*****************************
  ***********SENSE MAP**********
  *****************************/

  const senseMap = document.querySelector("#sense-map"),
        userMarker = document.querySelector("#user-marker");

  if (senseMap) {
    const senseForm = document.querySelector("#sense-form"),
          location = senseForm.dataset.location;
    senseMap.addEventListener("mousemove", function (e) {
      if (userMarker.classList.contains("placed") || userMarker.classList.contains("submitted")) {
        return;
      }

      if (e.target.id !== "sense-map") {
        userMarker.classList.remove("show");
        return;
      }

      const x = e.offsetX,
            y = e.offsetY;
      userMarker.classList.add("show");
      userMarker.style.left = x + "px";
      userMarker.style.top = y + "px";
    });
    senseMap.addEventListener("mouseleave", function (e) {
      const x = e.offsetX,
            y = e.offsetY;

      if (!userMarker.classList.contains("placed")) {
        userMarker.classList.remove("show");
      }
    });
    senseMap.addEventListener("mouseup", function (e) {
      if (e.target.id !== "sense-map") {
        return;
      }

      if (userMarker.classList.contains("placed")) {
        return;
      }

      if (userMarker.classList.contains("submitted")) {
        return;
      }

      const xInput = wpForm.querySelector("[data-name='sense_pos_x'] input"),
            yInput = wpForm.querySelector("[data-name='sense_pos_y'] input"),
            commentInput = senseForm.querySelector("textarea"),
            x = e.offsetX,
            y = e.offsetY,
            xPer = x / senseMap.offsetWidth * 100,
            yPer = y / senseMap.offsetHeight * 100;
      userMarker.style.left = `${x}px`;
      userMarker.style.top = `${y}px`;
      userMarker.classList.add("show");
      userMarker.classList.add("placed");
      xInput.value = xPer;
      yInput.value = yPer;
      setTimeout(function () {
        commentInput.focus();
      });
    });
    $(userMarker).draggable({
      containment: "parent",
      start: (e, ui) => {
        if (userMarker.classList.contains("submitted")) {
          e.preventDefault();
        }
      },
      stop: (e, ui) => {
        const xInput = wpForm.querySelector("[data-name='sense_pos_x'] input"),
              yInput = wpForm.querySelector("[data-name='sense_pos_y'] input"),
              x = ui.position.left,
              y = ui.position.top,
              xPer = x / senseMap.offsetWidth * 100,
              yPer = y / senseMap.offsetHeight * 100;
        xInput.value = xPer;
        yInput.value = yPer;

        if (userMarker.classList.contains("submitted")) {
          e.preventDefault();
        }
      }
    });
    const userTextarea = senseForm.querySelector("textarea"),
          senseTextarea = document.querySelector("[data-name=\"sense_comment\"] textarea");
    wpForm.querySelector("[data-name=\"overlay\"] select").value = "sense";

    if (userTextarea) {
      userTextarea.addEventListener("keyup", function (e) {
        // const userOverlay = this.parentNode.parentNode.parentNode,
        // 		commentField = userOverlay.querySelector("[data-name='sense_comment'] textarea"),
        // 		text = this.value;
        // if(text.length) {
        // 	userOverlay.classList.remove("no-text");
        // }
        // commentField.value = text;
        senseTextarea.value = this.value;
      });
    }
  }
  /*****************************
  *******TAKE ACTION CONT*******
  *****************************/


  const radioButtonsUl = document.querySelector(".radio-buttons");

  if (radioButtonsUl) {
    const radioButtons = radioButtonsUl.querySelectorAll("li"),
          fieldName = radioButtonsUl.dataset.field,
          formSelect = document.querySelector(`[data-name="${fieldName}"] select`);
    radioButtons.forEach(radioButton => {
      radioButton.addEventListener("click", e => {
        radioButton.parentElement.classList.add("clicked");

        if (radioButton.getAttribute("aria-checked") === "true") {
          radioButton.setAttribute("aria-checked", "false");
          formSelect.value = null;

          if (userMarker) {
            userMarker.dataset.sense = null;
          }
        } else {
          radioButton.setAttribute("aria-checked", "true");
          formSelect.value = radioButton.dataset.sense;

          if (userMarker) {
            userMarker.dataset.sense = radioButton.dataset.sense;
          }
        }

        radioButtons.forEach(sibling => {
          if (sibling !== radioButton) {
            sibling.setAttribute("aria-checked", "false");
          }
        });
      });
    });
  }

  const actionForm = document.querySelector(".action-form");

  if (actionForm) {
    actionForm.addEventListener("submit", e => {
      e.preventDefault();
      submitActionForm(wpForm);
      disabledInputs(actionForm);
      disabledInputs(wpForm);

      if (userMarker) {
        userMarker.classList.add("submitted");
      }
    });
  }

  const disabledInputs = form => {
    const fieldsets = actionForm.querySelectorAll("fieldset");
    fieldsets.forEach(fieldset => {
      fieldset.setAttribute("disabled", "true");
    });
    console.log(actionForm);
    actionForm.classList.add("disabled");
  };

  const submitActionForm = form => {
    const XHR = new XMLHttpRequest(),
          action = form.action,
          data = new FormData(form);
    XHR.addEventListener("load", function (e) {
      console.log("Success");
    });
    XHR.addEventListener("error", function (e) {
      console.warn('Oops! Something went wrong.');
      console.warn(e);
    });
    XHR.open("POST", action);
    XHR.send(data);
  };
});

/***/ }),

/***/ "./src/style.scss":
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ 0:
/*!**********************************************!*\
  !*** multi ./src/script.js ./src/style.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/coreytegeler/Sites/climatesofinequality.org/wp-content/themes/climates-of-inequality-v2/src/script.js */"./src/script.js");
module.exports = __webpack_require__(/*! /Users/coreytegeler/Sites/climatesofinequality.org/wp-content/themes/climates-of-inequality-v2/src/style.scss */"./src/style.scss");


/***/ })

/******/ });
});
//# sourceMappingURL=script.js.map