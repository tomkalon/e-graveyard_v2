import $ from 'jquery';
import Api from '@Api'

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
        console.log(item)
    }

    const getImage = (image) => {
        const fullPath = '/'+ path + image.name + '.' + image.extension
        const thumbFullPath = '/'+ thumbPath + image.name + '.' + image.thumb_extension

        let gallery = 'Gallery'
        if (galleryName) {
            gallery = galleryName
        }

        let link = $('<a/>', {
            href: fullPath,
            'data-lightbox-thumb': '',
            'data-lightbox': gallery
        });

        let img = $('<img/>', {
            src: thumbFullPath,
            alt: 'Image',
        });

        $(link).append(img)
        return link
    }

    Api.get(
        'admin_api_grave_get_images',
        {id: id},
        create.bind(this)
    )
}

export { createGallery }
