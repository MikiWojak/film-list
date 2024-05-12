import { fetchFilms } from './fetchFilms.js'

const search = document.querySelector('#search');
const searchSubmitBtn = document.querySelector('.search__form__submit');

search.addEventListener('keyup', async (event) => {
    if (event.key !== "Enter") {
        return;
    }

    event.preventDefault();

    await fetchFilms();
})

searchSubmitBtn.addEventListener('click', (event) =>
    fetchFilms()
);
