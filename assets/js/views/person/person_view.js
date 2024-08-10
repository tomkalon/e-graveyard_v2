import {
    trans,
    UI_PERSON_DATE_SHORTAGE,
} from '@Translator';

const getPerson = (person) => {
    const div = document.createElement('div')
    let bornDate = person.bornDate !== null ? person.bornDate : trans(UI_PERSON_DATE_SHORTAGE)
    let deathDate = person.deathDate !== null ? person.deathDate : trans(UI_PERSON_DATE_SHORTAGE)

    div.innerHTML = `
        <div class="flex items-center px-4 text-neutral-800 dark:text-neutral-100">
            <span class="font-semibold">${person.firstName} ${person.lastName}</span>
            <svg class="ml-4 w-[15px] h-[15px] mr-2 fill-[#bababa]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"></path>
            </svg> ${bornDate}
            <svg class="ml-4 w-[15px] h-[15px] mr-1 fill-[#bababa]" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                <path d="M176 0c-26.5 0-48 21.5-48 48v80H48c-26.5 0-48 21.5-48 48v32c0 26.5 21.5 48 48 48h80V464c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V256h80c26.5 0 48-21.5 48-48V176c0-26.5-21.5-48-48-48H256V48c0-26.5-21.5-48-48-48H176z"></path>
            </svg> ${deathDate}
        </div>
    `
    return div
}

export { getPerson };
