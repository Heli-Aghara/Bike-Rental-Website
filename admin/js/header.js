/*++++++++++++++++++++| Adding active class to sidebar links when clicked |+++++++++++++++++++++ */
sidebarLinks = document.querySelectorAll('.sidebar-link:not(.logout-link)');
sidebarLinks.forEach(sidebarLink => {
    sidebarLink.addEventListener('click',function(){
        document.querySelector('.active')?.classList.remove('active');
        sidebarLink.classList.add('active');
    })
})

/*+++++++++++++++++++++++++++|Hiding and Expanding sidebar when user clicks on hamburger |+++++++++++++++++++++++++++++++++++ */

sidebarToggleIcon = document.querySelector('.sidebar-toggle');
sidebar = document.querySelector('.sidebar');

sidebarToggleIcon.addEventListener('click', function(){
    if (sidebar.classList.contains('hidden')) {
        sidebar.classList.remove('hidden');
    } else {
        sidebar.classList.add('hidden');
    }
})