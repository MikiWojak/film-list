import { setupRateButtons } from './rateButtonsSetup.js';

const search = document.querySelector('#search');
const searchSubmitBtn = document.querySelector('.search__form__submit');
const filmsContainer = document.querySelector('.film_list');

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

export const fetchFilms = async () => {
    const data = { search: search.value };

    try {
        const response = await fetch("/search", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });

        const films = await response.json();

        filmsContainer.innerHTML = '';

        loadFilms(films);
    } catch (error) {
        console.error(error);
    }
}

const loadFilms = (films) => {
    films.forEach(film => createFilm(film));

    setupRateButtons();
}

const createFilm = (film) => {
    const template = document.querySelector('#film-template');
    const clone = template.content.cloneNode(true);

    const { id, title, posterUrl, avgRate, rate } = film;

    const posterElement = clone.querySelector('img');
    posterElement.src = `public/uploads/${posterUrl}`;

    const titleElement = clone.querySelector('.film__title--inner');
    titleElement.setAttribute("href", `film/${id}`);
    titleElement.innerHTML = title;

    const avgRateElement = clone.querySelector('.film__avg_rate--inner');
    avgRateElement.innerHTML = avgRate;

    const myRateElement = clone.querySelector('.film__my_rate--inner');
    myRateElement.innerHTML = rate || 'Rate';

    const rateBtnElement = clone.querySelector('#rate__btn');
    rateBtnElement.setAttribute('data-id', id);
    rateBtnElement.setAttribute('data-rate', rate || '');
    rateBtnElement.setAttribute('data-title', title);

    filmsContainer.appendChild(clone);
}
