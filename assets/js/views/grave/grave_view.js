import {
    trans,
    UI_GRAVE_GRAVEYARD, UI_GRAVE_SECTOR, UI_GRAVE_ROW, UI_GRAVE_NUMBER,
    UI_GRAVE_PEOPLE, UI_GRAVE_WITHOUT_PEOPLE,
    UI_PERSON_FIRST_NAME, UI_PERSON_LAST_NAME, UI_PERSON_BORN_DATE, UI_PERSON_DEATH_DATE,
} from '@Translator';

const getGraveDetails = (graveyard, sector, row, number, people) => {
    const content = document.createElement('div')
    content.appendChild(getGravePosition(graveyard, sector, row, number))
    content.appendChild(getGravePeople(people))
    return content
}

const getGravePosition = (graveyard, sector, row, number) => {
    const div = document.createElement('div');
    div.setAttribute('class', 'grid gap-2 grid-cols-2 lg:grid-cols-4 text-neutral-700 dark:text-neutral-100 text-center')
    div.innerHTML = `
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_GRAVE_GRAVEYARD)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${graveyard}</p>
        </div>
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_GRAVE_SECTOR)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${sector}</p>
        </div>
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_GRAVE_ROW)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${row}</p>
        </div>
        <div>
            <p class="mb-1 text-xs uppercase">${trans(UI_GRAVE_NUMBER)}</p>
            <p class="p-2 rounded-lg bg-neutral-800 dark:bg-white bg-opacity-20 dark:bg-opacity-10">${number}</p>
        </div>
    `
    return div
}

const getGravePeople = (people) => {
    const div = document.createElement('div');

    let data = []
    people.forEach((person) => {
        const tr = `
        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
            <td class="whitespace-nowrap px-3 py-3">${person.firstname}</td>
            <td class="whitespace-nowrap px-3 py-3">${person.lastname}</td>
            <td class="whitespace-nowrap px-3 py-3">
                <div class="flex items-center">
                    <svg class="mr-2 w-[15px] h-[15px] mr-2 fill-[#bababa]" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"></path>
                    </svg>
                    ${person.born_date}
                </div>
            </td>
            <td class="whitespace-nowrap px-3 py-3">
                <div class="flex items-center">
                    <svg class="mr-1 w-[15px] h-[15px] mr-1 fill-[#bababa]" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M176 0c-26.5 0-48 21.5-48 48v80H48c-26.5 0-48 21.5-48 48v32c0 26.5 21.5 48 48 48h80V464c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V256h80c26.5 0 48-21.5 48-48V176c0-26.5-21.5-48-48-48H256V48c0-26.5-21.5-48-48-48H176z"></path>
                    </svg>
                    ${person.death_date}
                </div>
            </td>
        </tr>
        `
        data.push(tr)
    })

    if (people.length) {
        div.innerHTML = `
            <p class="mt-8 font-bold text-neutral-700 dark:text-neutral-100">${trans(UI_GRAVE_PEOPLE)}</p>
            <hr class="mt-1 mb-3">
            <table class="min-w-full text-left text-sm text-neutral-600 dark:text-neutral-100">
                <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-3 py-3">${trans(UI_PERSON_FIRST_NAME)}</th>
                    <th scope="col" class="px-3 py-3">${trans(UI_PERSON_LAST_NAME)}</th>
                    <th scope="col" class="px-3 py-3">${trans(UI_PERSON_BORN_DATE)}</th>
                    <th scope="col" class="px-3 py-3">${trans(UI_PERSON_DEATH_DATE)}</th>
                </tr>
                </thead>
                <tbody>
                    ${data.join('')}
                </tbody>
            </table>
        `
        return div
    } else {
        div.innerHTML = `
            <hr class="my-3">
            <p class="font-bold text-center">${trans(UI_GRAVE_WITHOUT_PEOPLE)}</p>
        `
        return div
    }
}

export { getGraveDetails, getGravePosition, getGravePeople };
