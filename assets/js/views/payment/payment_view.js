import {
    trans,
    UI_PAYMENT_VALUE, UI_PAYMENT_VALIDITY_TIME, UI_ENUMS_CURRENCY_TYPE_PLN, UI_ENUMS_CURRENCY_TYPE_USD, UI_ENUMS_CURRENCY_TYPE_EUR,
} from '@Translator';


const getPayment = (payment) => {
    const div = document.createElement('div');
    div.setAttribute('class', 'grid gap-2 grid-cols-1 lg:grid-cols-2 text-neutral-700 dark:text-neutral-100 text-center')

    let currency = trans(UI_ENUMS_CURRENCY_TYPE_PLN)
    switch (payment.currency) {
        case 'usd':
            currency = trans(UI_ENUMS_CURRENCY_TYPE_USD)
            break;
        case 'eur':
            currency = trans(UI_ENUMS_CURRENCY_TYPE_EUR)
            break;
    }

    div.innerHTML = `
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_PAYMENT_VALUE)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">
                ${payment.value} ${currency}
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
