mainUtilites = require('./main_utillites.js');

window.App = {
    reviews: require('./controllers/ReviewsController'),
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