import {
    trans,
    UI_PAYMENT_VALUE, UI_PAYMENT_VALIDITY_TIME
} from '@Translator';


const getPayment = (payment) => {
    const div = document.createElement('div');
    div.setAttribute('class', 'grid gap-2 grid-cols-1 lg:grid-cols-2 text-neutral-700 dark:text-neutral-100 text-center')
    div.innerHTML = `
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_PAYMENT_VALUE)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">
                ${payment.value} ${payment.currency}
            </p>
        </div>
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_PAYMENT_VALIDITY_TIME)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">
                ${payment.validity_time}
            </p>
        </div>
    `
    return div
}

export {getPayment};
