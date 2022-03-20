/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/controllers/ReviewsController.js":
/*!*************************************************!*\
  !*** ./src/js/controllers/ReviewsController.js ***!
  \*************************************************/
/***/ ((module) => {

ReviewsController = {
    run: function () {

        document.getElementById('content-table').addEventListener('click', function (event) {
            event.preventDefault();
            let target = event.target;
            while (target.id !== 'content-table') {
                if (target.classList.contains('contacts')) {
                    let authorId = target.getAttribute('data-author');
                    console.log(authorId);
                    $.getJSON("/author/contacts?author_id=" + authorId, function(data){
                        mainUtilites.mustasheModalBuild('/site/author-contacts', data, 'Контакты');
                    });
                }
                target = target.parentNode;
            }
        });
    },
};

module.exports = ReviewsController;

/***/ }),

/***/ "./src/js/main_utillites.js":
/*!**********************************!*\
  !*** ./src/js/main_utillites.js ***!
  \**********************************/
/***/ ((module) => {

mainUtilites = {
    mustasheModalBuild: function (templateID, data, headerStr) {
        $.ajax({
            url: templateID,
            type: 'GET',
            success:
                function (template) {
                    console.log(template);
                    console.log(data);
                    console.log(headerStr);
                    let render = Mustache.render(template, data);

                    document.getElementById('modalLabel').innerHTML = '<p>'+headerStr+'</p>';
                    document.getElementById('modalBody').innerHTML = render;
                }

        });
    },
};

module.exports = mainUtilites;

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
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
mainUtilites = __webpack_require__(/*! ./main_utillites.js */ "./src/js/main_utillites.js");

window.App = {
    reviews: __webpack_require__(/*! ./controllers/ReviewsController */ "./src/js/controllers/ReviewsController.js"),
};

let ROUTE = {
    exec: function (controller, action) {
        let ns = App;
        action = (action === undefined) ? "main" : action;

        if (controller !== '' && ns[controller] && typeof ns[controller][action] === 'function') {
            ns[controller][action]();
        }
    },

    init: function() {
        let content = document.getElementById('content-container'),
            controller = content.getAttribute('data-controller'),
            action = content.getAttribute('data-action');

        ROUTE.exec(controller, action);
    }
};

$(document).ready(ROUTE.init);
})();

/******/ })()
;
//# sourceMappingURL=build.js.map