/******/ (function(modules) { // webpackBootstrap
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.readings.js":
/*!**************************************!*\
  !*** ./resources/js/app.readings.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function () {
  var lineCharts = [];
  var charts = jQuery("canvas[id^='chartContainer-']");

  for (var j = 0; j < charts.length; j++) {
    var id = jQuery(charts[j]).attr('id');
    var ctx = document.getElementById(id); //.getContext('2d');

    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {},
      options: {}
    });
    lineCharts.push(myLineChart);
  }

  var handleCharts = function handleCharts() {
    try {
      var _loop = function _loop(_j) {
        var sensor = jQuery(charts[_j]).attr('data-sensor');
        jQuery.getJSON("/user/sensor-readings/" + sensor + "/read", function (data) {
          var labels = [];
          var values = [];
          var maxValue = 0;
          var minValue = 0;

          for (var i = 0; i < data.length; i++) {
            labels.push(new Date(data[i].x));
            values.push(data[i].y); // dataPoints[i].x = i; //new Date(dataPoints[i].x);

            if (data[i].y > maxValue) maxValue = data[i].y;
            if (data[i].y < minValue) minValue = data[i].y;
          }

          lineCharts[_j].data = {
            "labels": labels,
            "datasets": [{
              "label": "Sensor Readings",
              "data": values,
              "fill": false,
              "borderColor": "rgb(0, 0, 255)",
              "lineTension": 0.5
            }]
          };
          lineCharts[_j].options = {
            scales: {
              xAxes: [{
                type: 'time',
                time: {
                  displayFormats: {
                    second: 'YYYY-MM-DD hh:mm:ss a'
                  }
                }
              }],
              yAxes: [{
                ticks: {
                  // beginAtZero: true,
                  maxTicksLimit: 100,
                  suggestedMin: minValue + 1,
                  suggestedMax: maxValue + 1
                }
              }]
            }
          };

          lineCharts[_j].update();

          setTimeout(function () {
            handleCharts();
          }, 5000);
        });
      };

      for (var _j = 0; _j < charts.length; _j++) {
        _loop(_j);
      }
    } catch (e) {
      setTimeout(function () {
        handleCharts();
      }, 5000);
    }
  };

  handleCharts();
});

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/js/app.readings.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\biomix-gp\resources\js\app.readings.js */"./resources/js/app.readings.js");


/***/ })

/******/ });