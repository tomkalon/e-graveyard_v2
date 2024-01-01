import {
    trans,
    UI_GRAVE_GRAVEYARD, UI_GRAVE_SECTOR, UI_GRAVE_ROW, UI_GRAVE_NUMBER,
    UI_GRAVE_PEOPLE, UI_GRAVE_WITHOUT_PEOPLE,
    UI_GRAVE_QUESTION_REMOVE
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
    if (people.length) {
        div.innerHTML = `
            <hr class="my-3">
            <p class="font-bold">${trans(UI_GRAVE_PEOPLE)}</p>
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

const getGraveQuestionRemove = () => {
    const div = document.createElement('div')
    div.innerHTML = `
        <h3>${trans(UI_GRAVE_QUESTION_REMOVE)}</h3>
        <hr class="my-3">
    `
    return div
}

export { getGraveDetails, getGravePosition, getGravePeople, getGraveQuestionRemove };
