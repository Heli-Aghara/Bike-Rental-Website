const navMenu = document.querySelector('.nav_bar__menu')
const navMenuToggleBtn = document.querySelector('.mobile-nav-menu-toggle');
const navMenuToggleIcon = document.querySelector('.toggle-icon');

navMenuToggleBtn.addEventListener('click', () => {
  console.log(navMenuToggleIcon);
  const visibility = navMenu.getAttribute('data-visible');
  console.log(visibility);
  if(visibility === "false"){
    navMenu.setAttribute('data-visible', true);
    navMenuToggleIcon.innerHTML = '<i class="fa-solid fa-x fa-xl" style="color:#fff;"></i>';
    navMenuToggleBtn.setAttribute('aria-expanded', 'true');

  }else if(visibility === "true"){
    navMenu.setAttribute('data-visible', false);
    navMenuToggleIcon.innerHTML = '<i class="fa-solid fa-bars fa-xl" style="color: #3a3a3a;"></i>';
    navMenuToggleBtn.setAttribute('aria-expanded', 'false');
  }
});

