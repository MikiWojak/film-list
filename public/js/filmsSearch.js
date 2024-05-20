import { fetchFilms } from './fetchFilms.js'

let filterRated = false

const searchSection = document.querySelector('.search--desktop')
const ratedBtn = searchSection.querySelector('.search__rated-btn');
const loggedInInput = searchSection.querySelector('#isLoggedIn');
const search = searchSection.querySelector('#search');
const searchSubmitBtn = searchSection.querySelector('.search__form__submit');

const tabBar = document.querySelector('.tab-bar');
const tabBarRatedBtn = tabBar.querySelector('.tab-bar--rated');
const tabBarSearchBtn = tabBar.querySelector('.tab-bar--search');

search.addEventListener('keyup', async (event) => {
    if (event.key !== "Enter") {
        return;
    }

    event.preventDefault();

    await fetchFilms(filterRated);
})

searchSubmitBtn.addEventListener('click', (event) =>
    fetchFilms(filterRated)
);

tabBarSearchBtn.addEventListener('click', (event) =>
    fetchFilms(filterRated)
);
tabBarSearchBtn.classList.add('visible');

ratedBtn.addEventListener('click', () => getRatedFilmsOnly());
tabBarRatedBtn.addEventListener('click', () => getRatedFilmsOnly());
tabBarRatedBtn.classList.add('visible');

const getRatedFilmsOnly = async () => {
    const isLoggedIn = loggedInInput.value;

    if (!isLoggedIn) {
        alert("You must be logged in to show only films rated by you");

        return;
    }

    filterRated = !filterRated;

    const ratedBtnInner = ratedBtn.querySelector('span');
    const tabBarRatedBtnInner = tabBarRatedBtn.querySelector('span');

    changeStarRatedIcon(ratedBtnInner, filterRated);
    changeStarRatedIcon(tabBarRatedBtnInner, filterRated);

    await fetchFilms(filterRated);
}

const changeStarRatedIcon = (element, rated) => {
    element.innerHTML = rated ? 'star_half' : 'star'
}
