import $ from 'jquery';
import {
    trans, UI_BUTTONS_CLOSE
} from '@Translator';


const getModal = (title, content, buttons, size = null) => {
    document.querySelectorAll('#js-modal-box').forEach((element) => element.remove())

    const modal = document.createElement('div')
    modal.setAttribute('role', 'dialog')
    modal.setAttribute('id', 'js-modal-box')
    modal.setAttribute('tabindex', '-1')
    modal.setAttribute('aria-modal', 'true')
    modal.setAttribute('class', 'fixed hidden left-0 top-0 z-[1055] h-full w-full overflow-y-auto overflow-x-hidden outline-none bg-black bg-opacity-70')


    // CONTENT AND BUTTONS
    let modalContent, modalButtons
    if (typeof content === 'string') {
        modalContent = content
    } else if (typeof content === 'object') {
        modalContent = ''
    }
    if (typeof buttons === 'string') {
        modalButtons = buttons
    } else if (typeof buttons === 'object') {
        modalButtons = ''
    }

    // SIZE
    const Sizes = {
        sm: 'min-[576px]:max-w-[300px]',
        md: 'min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]',
        lg: 'min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]',
        xl: 'min-[576px]:max-w-[500px] min-[992px]:max-w-[800px] min-[1200px]:max-w-[1140px]',
    }

    let selectedSize = Sizes[size] || Sizes['md'];
    modal.innerHTML =
        `<div class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 ${selectedSize} px-2">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                        id="js-modal-box-title">
                        ${title}
                    </h5>
                    <!--Close button-->
                    <button type="button"
                        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                        data-item-modal-close
                        aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
    
                <!--Modal body-->
                <div data-modal-content class="relative p-4">
                    ${modalContent}
                </div>
    
                <!--Modal footer-->
                <div data-modal-buttons class="flex flex-shrink-0 gap-2 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    ${modalButtons}
                    <button data-item-modal-close class="btn btn-neutral">${trans(UI_BUTTONS_CLOSE)}</button>
                </div>
            </div>
            </div>
        </div>`

    closeBtnHandler(modal, 200)
    const buttonsContainer = modal.querySelector('[data-modal-buttons]')
    const contentContainer = modal.querySelector('[data-modal-content]')

    if (typeof buttons === 'object') {
        buttonsContainer.insertBefore(buttons, buttonsContainer.firstChild)
    }
    if (typeof content === 'object') {
        contentContainer.appendChild(content)
    }

    $(modal).appendTo('body').fadeIn(250)
    return modal
}

function closeBtnHandler (modal, time) {
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
