const toggleMenu = document.querySelector(".toggle");
const menu = document.querySelector(".menu");

toggleMenu.addEventListener("click", () => {
  menu.classList.toggle("show-menu");
});

