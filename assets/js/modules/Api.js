import Routing from '@Routing'
import $ from "jquery";

function post(path, params, callback = null, callbackParams = null)
{
    $.ajax({
        method: "POST",
        url: Routing.generate(path),
        data: {params}
    })
        .done(function (data) {
            if (callback) {
                callback(data, callbackParams);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function get(path, params, callback = null, callbackParams = null)
{
    $.ajax({
        method: "GET",
        url: Routing.generate(path, params),
    })
        .done(function (data) {
            if (callback) {
                callback(data, callbackParams);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function put(path, params, callback = null, callbackParams = null)
{
    $.ajax({
        method: "PUT",
        url: Routing.generate(path),
        data: {params}
    })
        .done(function (data) {
            if (callback) {
                callback(data, callbackParams);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function remove(path, params, callback = null, callbackParams = null)
{
    $.ajax({
        method: "DELETE",
        url: Routing.generate(path),
        data: {params}
    })
        .done(function (data) {
            if (callback) {
                callback(data, callbackParams);
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
