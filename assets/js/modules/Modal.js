import $ from 'jquery';

const getModal = (name, content = null, buttons = '') => {
    // clear all modals
    document.querySelectorAll('[data-modal-open="'+ name +'"]').forEach((element) => element.remove())

    // modal pattern
    const modal = document.querySelector('[data-modal-box="' + name + '"]')

    // modal instance
    const newModal = modal.cloneNode(true)
    newModal.setAttribute('data-modal-open', name)
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
    let close = modal.querySelectorAll('[data-item-modal-close]');
    close.forEach((element) => {
        $(element).click(() => {
            $(modal).fadeOut(time)
            setTimeout(() => {
                modal.remove()
            }, time)
        })
    })
}

const modal = {
    getModal
}

export default modal
