const navMenu = document.querySelector("#checkbox");
    
navMenu.addEventListener("click", () => {
    const sidebar = document.querySelector("#sidebar");
    sidebar.classList.toggle("sidebar-on");
})

