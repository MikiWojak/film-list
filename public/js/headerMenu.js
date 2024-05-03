const headerMenu = document.querySelector('.header_menu');
const sidebar = document.querySelector('.sidebar');
const content = document.querySelector('.content');

// @TODO Show header menu (hide by default)
headerMenu.addEventListener('click', async (event) => {
    sidebar.classList.toggle("sidebar--enabled");
    content.classList.toggle("sidebar--enabled");
})
