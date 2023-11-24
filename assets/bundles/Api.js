import Routing from './Routing.js'

function put(path) {
    return Routing.generate(path)
}

const api = {
    put
}

export default api;
