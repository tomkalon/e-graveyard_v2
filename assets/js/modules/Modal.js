import $ from 'jquery';

const preLoadModal = (name) => {
    const modal = document.querySelector('[data-modal-box="' + name + '"]')
    const submit = modal.querySelector('[type="submit"]')
    const buttonsContainer = modal.querySelector('[data-modal-buttons]')
    const newButtons = modal.querySelector('[data-modal-buttons-inner]')

    if (submit) {
        const form = modal.querySelector('form')
        form.setAttribute('id', name)
        submit.setAttribute('form', name)
        buttonsContainer.insertBefore(submit, newButtons)
    }

    closeBtnHandler(modal, 200)
}

const getModal = (name, contentBefore = null, contentAfter = null,  buttons = null) => {

    // modal pattern
    const modal = document.querySelector('[data-modal-box="' + name + '"]')

    // // modal instance
    modal.setAttribute('data-modal-open', name)

    // // close handler
    closeBtnHandler(modal, 200)

    // CONTENT
    const newContentBefore = modal.querySelector('[data-modal-content-before]')
    if (contentBefore) {
        $(newContentBefore).html(contentBefore)
    } else {
        newContentBefore.innerHTML = ''
    }
    const newContentAfter = modal.querySelector('[data-modal-content-after]')
    if (contentAfter) {
        $(newContentAfter).html(contentAfter)
    } else {
        newContentAfter.innerHTML = ''
    }

    // BUTTONS
    const submit = modal.querySelector('[type="submit"]')
    const buttonsContainer = modal.querySelector('[data-modal-buttons]')

    const newButtons = modal.querySelector('[data-modal-buttons-inner]')
    if (buttons) {
        $(newButtons).html(buttons)
    } else {
        newButtons.setAttribute('class', 'hidden')
    }

    if (submit) {
        const form = modal.querySelector('form')
        form.setAttribute('id', name)
        submit.setAttribute('form', name)
        buttonsContainer.insertBefore(submit, newButtons)
    }

    // // display modal
    $(modal).fadeIn(200)
    return modal
}

function closeBtnHandler(modal, time)
{
    const dialog = modal.querySelector('[data-modal-dialog]')
    $(modal).on('click', function (event) {
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

function closeDialog(modal, time)
{
    $(modal).removeAttr('data-modal-open').fadeOut(time)
}

const modal = {
    getModal, closeDialog, preLoadModal
}

export default modal
