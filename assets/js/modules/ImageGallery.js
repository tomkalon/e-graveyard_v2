import $ from 'jquery';
import Api from '@Api'
import Modal from '@Modal';
import {
    trans, UI_BUTTONS_SET_MAIN_IMAGE, UI_BUTTONS_REMOVE
} from '@Translator';

const createGallery = (container, id, path, thumbPath, galleryName = null) => {
    const loader = container.querySelector('[data-gallery-loader]')
    const gallery = container.querySelector('[data-gallery-box]')
    const toggleActionButton = container.querySelector('[data-gallery-toggle-action]')

    const create = (item, params) => {
        $(loader).fadeOut(300)
        $(gallery).fadeIn(300).css('display', 'flex')

        // append gallery items
        item.forEach((image) => {
            let item = getImage(image, path, thumbPath)
            $(gallery).append(item)
        })

        // events
        let actions = container.querySelectorAll('[data-lightbox-actions]')
        toggleActionButton.addEventListener('click', () => {
            actions.forEach((action) => {
                $(action).fadeToggle(200).css('display', 'flex')
            })
            $(gallery).toggleClass('active')
        })
    }

    const getImage = (image) => {
        const fullPath = '/' + path + image.name + '.' + image.extension
        const thumbFullPath = '/' + thumbPath + image.name + '.' + image.extension

        // gallery elements
        const imageBox = $('<div/>', {
            src: thumbFullPath, 'data-lightbox-item': '', class: 'flex flex-col'
        });

        const img = $('<img/>', {
            src: thumbFullPath,
            'data-te-img': fullPath,
            'data-lightbox-thumb': '',
            'data-te-class-gallery': 'gallery',
            alt: 'Image',
            class: 'mx-auto sm:mx-0 w-fit cursor-pointer rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto'
        });

        const actions = $('<div/>', {
            src: thumbFullPath, 'data-lightbox-actions': '', class: 'flex justify-center py-2 gap-1 relative top-[-3px] hidden'
        });

        const remove = $('<button/>', {
            src: thumbFullPath, 'data-lightbox-action-remove': '', class: 'btn btn-xs btn-dark'
        });
        remove.html(trans(UI_BUTTONS_REMOVE))

        const setMain = $('<button/>', {
            src: thumbFullPath, 'data-lightbox-action-set-main': '', class: 'btn btn-xs btn-warning'
        });
        setMain.html(trans(UI_BUTTONS_SET_MAIN_IMAGE))

        // append to item-box
        $(actions).append(setMain).append(remove)
        $(imageBox).append(img).append(actions)

        // events
        $(img).on('mouseenter', function () {
            $(actions).fadeIn(200).css('display', 'flex')
        });

        $(img).on('mouseleave', function (e) {
            if (!gallery.classList.contains('active')) {
                if (!$(img).is(e.relatedTarget) && !$(actions).is(e.relatedTarget)) {
                    $(actions).fadeOut(200);
                }
            }
        });

        $(actions).on('mouseleave', function (e) {
            if (!gallery.classList.contains('active')) {
                if (!$(img).is(e.relatedTarget) && !$(actions).is(e.relatedTarget)) {
                    $(actions).fadeOut(200);
                }
            }
        });

        // remove action
        $(remove).on("click", function () {
            const modal = Modal.getModal('grave-image-modal-remove')
            const removeBtn = modal.querySelector('[data-grave-image-btn-remove]')
            $(removeBtn).on("click", function () {
                Api.remove(
                    'admin_api_file_grave_remove',
                    {id: image.id},
                    () => location.reload()
                )
            });
        });

        // set main image action
        $(setMain).on("click", function () {
            Api.put(
                'admin_api_grave_set_main_image',
                {id: id, image: btoa(image.id)},
                () => location.reload()
            )
        });

        return imageBox;
    }

    Api.get('admin_api_grave_get_images', {id: id}, create.bind(this))
}

export {createGallery}
