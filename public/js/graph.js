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

/***/ "./resources/js/graph.js":
/*!*******************************!*\
  !*** ./resources/js/graph.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var colorsArray = ['#f1635b', '#0544c7', '#2c1fe6', '#dbfb41', '#f20fd9', '#4ee566', '#dd48dc', '#4f1f48', '#e47a6e', '#08e8ab', '#b8740a', '#f4508d', '#e43e36', '#ff6a1a'];
var windowSize = screen.width;
var xs = 512;
var sm = 768;
var md = 896;
var lg = 1152;
var xl = 1280;

var shuffle = function shuffle(o) {
  for (var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x) {
    ;
  }

  return o;
};

if (windowSize <= sm) {
  var overviewGraph = document.querySelector('#overview-graph');
  var filters = [].slice.call(document.querySelectorAll('[data-expense-filter]'));
  var filtersBtn = document.createElement('a');
  filtersBtn.setAttribute('href', '#');
  var overviewFilters = document.createElement('div');
  overviewFilters.classList.add('card', 'clear-card', 'filters-accordion');
  var accHeight = 42;

  filtersBtn.onclick = function (e) {
    overviewFilters.classList.toggle('filters-accordion-full'); // overviewFilters.style.height = ;

    e.preventDefault();
  };

  filtersBtn.innerText = 'Filters';
  expenses.insertBefore(overviewFilters, overviewGraph);
  overviewFilters.appendChild(filtersBtn);

  for (var r in filters) {
    overviewFilters.appendChild(filters[r]);
  }
}

var bar_ctx = document.getElementById('bar-chart').getContext('2d');
var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
purple_orange_gradient.addColorStop(0, 'rgba(235,87,87,0.7)');
purple_orange_gradient.addColorStop(1, 'rgba(255,255,255,0)');
var weekly_expenses = new Array();
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  for (var _iterator = weekly_cost[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
    expenses = _step.value;
    expenses = expenses.replace(',', ' ');
    weekly_expenses.push(parseFloat(expenses));
  }
} catch (err) {
  _didIteratorError = true;
  _iteratorError = err;
} finally {
  try {
    if (!_iteratorNormalCompletion && _iterator["return"] != null) {
      _iterator["return"]();
    }
  } finally {
    if (_didIteratorError) {
      throw _iteratorError;
    }
  }
}

var bar_chart = new Chart(bar_ctx, {
  type: 'line',
  data: {
    labels: weekly_range,
    datasets: [{
      data: weekly_expenses,
      backgroundColor: purple_orange_gradient,
      hoverBackgroundColor: purple_orange_gradient,
      borderWidth: 3,
      lineTension: 0,
      borderColor: 'rgba(235,87,87,1)',
      pointBorderColor: 'rgba(255,255,255,1)',
      pointBorderWidth: 3,
      pointBackgroundColor: 'rgba(235,87,87,1)',
      pointHoverBackgroundColor: 'rgba(47,128,237,1)',
      pointHoverBorderColor: 'rgba(255,255,255,1)',
      pointRadius: 7,
      pointHoverRadius: 7,
      hoverBorderWidth: 3,
      hoverBorderColor: 'rgba(235,87,87,1)',
      pointHitRadius: 15
    }]
  },
  options: {
    title: {},
    tooltips: {
      position: 'average',
      bodySpacing: 8,
      xPadding: 8,
      yPadding: 8,
      custom: function custom(tooltip) {
        if (!tooltip) return;
        tooltip.displayColors = false;
      }
    },
    legend: {
      display: false,
      labels: {
        display: false,
        padding: 20
      }
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
}); // Dough nut chart
// if( typeof m_s_category !== 'undefined'){
//     var maintenanceChart = document.getElementById("maintenance-chart").getContext('2d');
//     new Chart(maintenanceChart, {
//         type: 'doughnut',
//         data: {
//             labels: m_s_category,
//             datasets: [
//                 {
//                     label: "Population (millions)",
//                     backgroundColor: shuffle(colorsArray),
//                     data: m_s_total_cost       }
//             ]
//         },
//         options: {
//             cutoutPercentage:80,
//             legend:{
//                 labels:{
//                     fontFamily:'Work sans',
//                     fontColor:'#393C40',
//                 },
//                 position:'bottom'
//             }
//         }
//     });
// }

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/graph.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\chris\OneDrive\Documentos\Proyectos\fueltrack-laravel\resources\js\graph.js */"./resources/js/graph.js");


/***/ })

/******/ });