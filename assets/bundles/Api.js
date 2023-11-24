import Routing from './Routing.js'
import $ from "jquery";

function post(path, options, callback) {
    return Routing.generate(path)
}

function get(path, options, callback) {
    return Routing.generate(path)
}

function put(path, options, callback) {
    $.ajax({
        method: "PUT",
        url: Routing.generate(path),
        data: {options}
    })
        .done(function (data) {
            if (callback) {
                callback(data);
            }
        });
}

function remove(path, options, callback) {
    return Routing.generate(path)
}

const api = {
    post, get, put, remove
}

export default api;
