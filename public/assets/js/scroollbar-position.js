// Obtiene la posición del scroll almacenada en el almacenamiento local
const storedScrollPosition = localStorage.getItem("sidebarScrollPosition");

// Si hay una posición almacenada, mueve el scroll a esa posición
if (storedScrollPosition) {
    const sidebar = document.querySelector(".scroll-pos");
    sidebar.scrollTop = storedScrollPosition;
}

// Escucha el evento de desplazamiento y guarda la posición actual del scroll en el almacenamiento local
const sidebar = document.querySelector(".scroll-pos");
sidebar.addEventListener("scroll", function () {
    const scrollPosition = sidebar.scrollTop;
    localStorage.setItem("sidebarScrollPosition", scrollPosition);
});
