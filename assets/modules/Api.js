import Routing from '@Routing'
import $ from "jquery";

function post(path, options, callback)
{
    $.ajax({
        method: "POST",
        url: Routing.generate(path),
        data: {options}
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

function get(path, options, callback)
{
    $.ajax({
        method: "GET",
        url: Routing.generate(path),
        data: {options}
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

function put(path, options, callback)
{
    $.ajax({
        method: "PUT",
        url: Routing.generate(path),
        data: {options}
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

function remove(path, options, callback)
{
    $.ajax({
        method: "DELETE",
        url: Routing.generate(path),
        data: {options}
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
