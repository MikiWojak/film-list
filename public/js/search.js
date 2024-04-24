const search = document.querySelector('#search');
const filmsContainer = document.querySelector('.film_list');

search.addEventListener('keyup', (event) => {
    // @TODO Refactor
    if (event.keyCode === 13) {
        event.preventDefault();

        const data = { search: search.value };

        // @TODO async / await
        fetch("/search", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        }).then((response) => {
            return response.json();
        }).then((films) => {
            filmsContainer.innerHTML = '';

            loadFilms(films);
        });
    }
})

const loadFilms = (films) => {
    films.forEach(film => {
        createFilm(film);
    })
}

const createFilm = (film) => {
    const template = document.querySelector('#film-template');
    const clone = template.content.cloneNode(true);

    const { title, posterUrl, avgRate } = film;

    const posterElement = clone.querySelector('img');
    posterElement.src = `public/uploads/${posterUrl}`;

    const titleElement = clone.querySelector('.film__title--inner');
    titleElement.innerHTML = title;

    const avgRateElement = clone.querySelector('.film__avg_rate--inner');
    avgRateElement.innerHTML = avgRate;

    filmsContainer.appendChild(clone);
}
