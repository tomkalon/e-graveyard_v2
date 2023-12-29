import Routing from '@Routing'
import $ from "jquery";

function post(path, sendData, callback)
{
    $.ajax({
        method: "POST",
        url: Routing.generate(path),
        data: {sendData}
    })
        .done(function (data) {
            if (callback) {
                callback(data);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function get(path, params, callback)
{
    $.ajax({
        method: "GET",
        url: Routing.generate(path, params),
    })
        .done(function (data) {
            if (callback) {
                callback(data);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function put(path, sendData, callback)
{
    $.ajax({
        method: "PUT",
        url: Routing.generate(path),
        data: {sendData}
    })
        .done(function (data) {
            if (callback) {
                callback(data);
            }
        })
        .fail(function () {
            alert("error");
        })
    ;
}

function remove(path, sendData, callback)
{
    $.ajax({
        method: "DELETE",
        url: Routing.generate(path),
        data: {sendData}
    })
        .done(function (data) {
            if (callback) {
                callback(data);
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
