import $ from 'jquery';
import Api from '@Api'
import { Lightbox } from "tw-elements";

const createGallery = (container, id, path, thumbPath, galleryName = null) => {
    const loader = container.querySelector('[data-gallery-loader]')
    const gallery = container.querySelector('[data-gallery-box]')

    const create = (item, params) => {
        $(loader).fadeOut(300)
        $(gallery).fadeIn(300).css('display', 'flex')

        item.forEach((image) => {
            let item = getImage(image, path, thumbPath)
            $(gallery).append(item)
        })

        const lightbox = container.querySelector('[data-te-lightbox-init]')
        const lightboxInstance = new Lightbox(lightbox)
    }

    const getImage = (image) => {
        const fullPath = '/'+ path + image.name + '.' + image.extension
        const thumbFullPath = '/'+ thumbPath + image.name + '.' + image.thumb_extension

        const img = $('<img/>', {
            src: thumbFullPath,
            'data-te-img': fullPath,
            'data-lightbox-thumb': '',
            'data-te-class-gallery': 'gallery',
            alt: 'Image',
            class: 'mx-auto sm:mx-0 w-fit cursor-pointer rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto'
        });

        $(img).on('mouseenter', function () {
        });

        return img;
    }

    Api.get(
        'admin_api_grave_get_images',
        {id: id},
        create.bind(this)
    )
}

export { createGallery }
