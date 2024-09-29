import $ from 'jquery';
import Cookie from 'jquery.cookie';
import {
    trans,
    UI_BUTTONS_HIDE_FILTER, UI_BUTTONS_SHOW_FILTER
} from '@Translator';


const FilterSwitch = (toggleButton, filterContainer, name) => {
    let toggleFilterStatus = $.cookie(name)
    if (!toggleFilterStatus) {
        $.cookie(name, false, { path: '/' })
    }

    const icon = `<i class="fa fa-filter" aria-hidden="true"></i>`

    toggleButton.addEventListener('click', () => {
        toggleFilterStatus = $.cookie(name)
        if (toggleFilterStatus === 'true') {
            $(filterContainer).fadeOut(200)
            $(toggleButton).html(icon + trans(UI_BUTTONS_SHOW_FILTER))
            $.cookie(name, false, { path: '/' })
        } else {
            $(filterContainer).fadeIn(200)
            $(toggleButton).html(icon + trans(UI_BUTTONS_HIDE_FILTER))
            $.cookie(name, true, { path: '/' })
        }
        $(toggleButton).toggleClass('btn-danger').toggleClass('btn-warning')
    })
}

export {FilterSwitch}
