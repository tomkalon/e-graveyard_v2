import $ from 'jquery';
import Cookie from 'jquery.cookie';
import {
    trans,
    UI_BUTTONS_HIDE_FILTER, UI_BUTTONS_SHOW_FILTER
} from '@Translator';


const FilterSwitch = (toggleButton, filterContainer) => {
    let toggleFilterStatus = $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS')
    if (!toggleFilterStatus) {
        $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', false, { path: '/' })
    }

    const icon = `<i class="fa fa-filter" aria-hidden="true"></i>`

    toggleButton.addEventListener('click', () => {
        toggleFilterStatus = $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS')
        if (toggleFilterStatus === 'true') {
            $(filterContainer).fadeOut(200)
            $(toggleButton).html(icon + trans(UI_BUTTONS_SHOW_FILTER))
            $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', false, { path: '/' })
        } else {
            $(filterContainer).fadeIn(200)
            $(toggleButton).html(icon + trans(UI_BUTTONS_HIDE_FILTER))
            $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', true, { path: '/' })
        }
        $(toggleButton).toggleClass('btn-danger').toggleClass('btn-warning')
    })
}

export {FilterSwitch}
