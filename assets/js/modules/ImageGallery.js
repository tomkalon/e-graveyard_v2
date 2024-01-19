import $ from 'jquery';
import Api from '@Api'
import {getImage} from "@View/file/lb2_gallery_view";

const createGallery = (container, id, path, thumbPath) => {
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

    Api.get(
        'admin_api_grave_get_images',
        {id: id},
        create
    )
}



export { createGallery }
