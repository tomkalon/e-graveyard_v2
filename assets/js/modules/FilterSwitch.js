import $ from 'jquery';
import Cookie from 'jquery.cookie';

const FilterSwitch = (toggleButton, filterContainer) => {
    let toggleFilterStatus = $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS')
    if (!toggleFilterStatus) {
        $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', false, { path: '/' })
    }
    toggleButton.addEventListener('click', () => {
        toggleFilterStatus = $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS')
        if (toggleFilterStatus === 'true') {
            $(filterContainer).fadeOut(200)
            $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', false, { path: '/' })
        } else {
            console.log('tete')
            $(filterContainer).fadeIn(200)
            $.cookie('ADMIN_GRAVE_LIST_TOGGLE_FILTER_STATUS', true, { path: '/' })
        }
    })
}

export {FilterSwitch}
