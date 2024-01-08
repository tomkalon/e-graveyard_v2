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
    div.setAttribute('class', 'grid gap-2 grid-cols-2 lg:grid-cols-4 text-center')
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
            <td class="whitespace-nowrap px-3 py-3">${person.born_date}</td>
            <td class="whitespace-nowrap px-3 py-3">${person.death_date}</td>
        </tr>
        `
        data.push(tr)
    })

    if (people.length) {
        div.innerHTML = `
            <hr class="my-3">
            <p class="font-bold">${trans(UI_GRAVE_PEOPLE)}</p>
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
