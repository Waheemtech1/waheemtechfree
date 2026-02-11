
  // Mobile Menu Logic
  const menuBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');
  const mobileLinks = document.querySelectorAll('.mobile-link');

  menuBtn.addEventListener('click', () => {
    const isHidden = mobileMenu.classList.contains('hidden');
    
    if (isHidden) {
      mobileMenu.classList.remove('hidden');
      menuIcon.classList.replace('fa-bars', 'fa-times'); // Changes icon to 'X'
    } else {
      mobileMenu.classList.add('hidden');
      menuIcon.classList.replace('fa-times', 'fa-bars'); // Changes icon back to 'Bars'
    }
  });

  // Auto-close menu when a link is clicked
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.add('hidden');
      menuIcon.classList.replace('fa-times', 'fa-bars');
    });
  });

  // Smart Scroll Effect: Header gets a shadow when you scroll down
  window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 20) {
      navbar.classList.add('shadow-lg', 'bg-white/100');
      navbar.classList.remove('bg-white/80');
    } else {
      navbar.classList.remove('shadow-lg', 'bg-white/100');
      navbar.classList.add('bg-white/80');
    }
  });

