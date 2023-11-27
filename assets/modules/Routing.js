const routes = require('../../public/build/js/routes.json');
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

function generate(path) {
    Routing.setRoutingData(routes);
    return Routing.generate(path);
}

const api = {
    generate
}

export default api;
