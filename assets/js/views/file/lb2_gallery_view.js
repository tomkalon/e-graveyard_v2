import $ from 'jquery';

const getImage = (image, path, thumbPath, galleryName = null) => {
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

export { getImage };
