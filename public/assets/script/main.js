  // burger menu 
  let menu = document.getElementById("menu");
  let burgerMenu = document.getElementById("menu-btn");
  burgerMenu.addEventListener('click', () => {
      burgerMenu.classList.toggle('is-active');
      menu.classList.toggle('flex');
      menu.classList.toggle('hidden');
  });
