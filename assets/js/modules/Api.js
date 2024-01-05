import Routing from '@Routing'
import $ from "jquery";

function post(path, params, callback = null, options = null)
{
    apiHandler("POST", path, params, callback, options)

}

function get(path, params, callback, options = null)
{
    apiHandler("GET", path, params, callback, options)

}

function put(path, params, callback = null, options = null)
{
    apiHandler("PUT", path, params, callback, options)

}

function remove(path, params, callback = null, options = null)
{
    apiHandler("DELETE", path, params, callback, options)
}

function apiHandler(method, path, params, callback = null, options = null)
{
    $.ajax({
        method: method,
        url: Routing.generate(path, params),
        data: {params}
    })
        .done(function (data) {
            if (callback) {
                callback(data, params, options);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}


const api = {
    post, get, put, remove
}

export default api;
