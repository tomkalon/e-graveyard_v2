import $ from 'jquery';

const handleAction = (container) => {
    let images = container.querySelectorAll('[data-gallery-action]')
    console.log(images)
}

const imageGallery = {
    handleAction
}

export default imageGallery
