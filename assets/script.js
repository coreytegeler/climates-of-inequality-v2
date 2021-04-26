(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define("nychvs", [], factory);
	else if(typeof exports === 'object')
		exports["nychvs"] = factory();
	else
		root["nychvs"] = factory();
})(self, function() {
return /******/ (() => { // webpackBootstrap
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***********************!*\
  !*** ./src/script.js ***!
  \***********************/
const html = document.querySelector("html"),
      body = document.querySelector("body"); // coverCard = document.querySelector("#cover-card"),
// coverToggle = document.querySelector("#cover-toggle");
// if(coverToggle) {
// 	coverToggle.addEventListener("click", () => {
// 		html.classList.toggle("expand-cover");
// 	});
// }
})();

// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin

})();

/******/ 	return __webpack_exports__;
/******/ })()
;
});
//# sourceMappingURL=script.js.map