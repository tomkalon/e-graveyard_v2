import $ from 'jquery';

const getModal = (name, content = null, buttons = '') => {
    // clear all modals
    document.querySelectorAll('[data-modal-open="'+ name +'"]').forEach((element) => element.remove())

    // modal pattern
    const modal = document.querySelector('[data-modal-box="' + name + '"]')

    // modal instance
    const newModal = modal.cloneNode(true)
    newModal.setAttribute('data-modal-open', name)

    // close handler
    closeBtnHandler(newModal, 200)

    // CONTENT
    const newContent = newModal.querySelector('[data-modal-content]')
    if (content) {
        newContent.appendChild(content)
    }

    // BUTTONS
    const newButtons = newModal.querySelector('[data-modal-buttons]')
    if (buttons) {
        newButtons.insertBefore(buttons, newButtons.firstChild)
    }

    // display modal
    $(newModal).appendTo('body').fadeIn(200)

    return newModal
}

function closeBtnHandler(modal, time)
{
    const dialog = modal.querySelector('[data-modal-dialog]')
    $(modal).on('click', function(event) {
        if (!$(event.target).closest(dialog).length) {
            closeDialog(modal, time)
            $(modal).off('click');
        }
    });

    let close = modal.querySelectorAll('[data-item-modal-close]');
    close.forEach((element) => {
        $(element).click(() => {
            closeDialog(modal, time)
        })
    })
}

function closeDialog (modal, time) {
    $(modal).fadeOut(time)
    setTimeout(() => {
        modal.remove()
    }, time)
}

const modal = {
    getModal, closeDialog
}

export default modal
