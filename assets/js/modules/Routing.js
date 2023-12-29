const routes = require('@Routes');
import Routing from '@FosRoutes';

function generate(path, params)
{
    Routing.setRoutingData(routes);
    return Routing.generate(path, params);
}

const api = {
    generate
}

export default api;
