/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/dashboard/DragAndDrop.js":
/*!***********************************************!*\
  !*** ./resources/js/dashboard/DragAndDrop.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ DragAndDrop)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var DragAndDrop = /*#__PURE__*/function () {
  function DragAndDrop(dragArea) {
    _classCallCheck(this, DragAndDrop);

    this.dragArea = dragArea;
  }

  _createClass(DragAndDrop, [{
    key: "init",
    value: function init() {
      var _this = this;

      this.getAllEvents().forEach(function (eventName) {
        _this.dragArea.addEventListener(eventName, function (event) {
          event.preventDefault();
          event.stopPropagation();
        }, false);
      });
      this.dragArea.addEventListener('dragenter', function (event) {
        return _this.drag(event);
      }, false);
      this.dragArea.addEventListener('drop', function (event) {
        return _this.drop(event);
      }, false);
    }
  }, {
    key: "drag",
    value: function drag(event) {
      this.hideError();
    }
  }, {
    key: "drop",
    value: function drop(event) {
      var dt = event.dataTransfer;
      var files = dt.files;

      if (this.validate(files[0]) === false) {
        this.showError();
        return;
      }

      this.appendFile(files);
    }
  }, {
    key: "validate",
    value: function validate(file) {
      return ['text/csv'].includes(file.type);
    }
  }, {
    key: "hideError",
    value: function hideError() {
      document.getElementById('error-message').classList.add('hidden');
    }
  }, {
    key: "showError",
    value: function showError() {
      document.getElementById('error-message').classList.remove('hidden');
    }
  }, {
    key: "appendFile",
    value: function appendFile(files) {
      this.dragArea.querySelector('#csv-input').files = files;
    }
  }, {
    key: "getAllEvents",
    value: function getAllEvents() {
      return ['dragenter', 'dragover', 'dragleave', 'drop'];
    }
  }]);

  return DragAndDrop;
}();



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************!*\
  !*** ./resources/js/dashboard/app.js ***!
  \***************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DragAndDrop__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DragAndDrop */ "./resources/js/dashboard/DragAndDrop.js");

window.addEventListener('DOMContentLoaded', function () {
  new _DragAndDrop__WEBPACK_IMPORTED_MODULE_0__.default(document.getElementById('file-upload')).init();
});
})();

/******/ })()
;