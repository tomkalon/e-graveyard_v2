import Routing from '@Routing'
import $ from "jquery";

function post(path, params, callback = null)
{
    apiHandler("POST", path, params, callback)

}

function get(path, params, callback)
{
    apiHandler("GET", path, params, callback)

}

function put(path, params, callback = null)
{
    apiHandler("PUT", path, params, callback)

}

function remove(path, params, callback = null)
{
    apiHandler("DELETE", path, params, callback)
}

function apiHandler(method, path, params, callback = null)
{
    $.ajax({
        method: method,
        url: Routing.generate(path, params),
        data: {params}
    })
        .done(function (data) {
            if (callback) {
                callback(data, params);
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
