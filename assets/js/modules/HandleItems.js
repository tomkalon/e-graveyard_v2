function handleItems(items, actions) {
    // list table actions cells
    items.forEach((element) => {
        const id = element.getAttribute('data-item-id')
        const buttons = element.querySelectorAll('[data-modal-target]')

        // list table action buttons
        buttons.forEach((button) => {
            const action = button.getAttribute('data-modal-target')
            actions(button, id, action)
        })
    })
}


const handle = {
    handleItems
}

export default handle;
