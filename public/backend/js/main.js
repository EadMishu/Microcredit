const sidebar = document.getElementById('sidebar');
const mainContent = document.querySelector('.main-content');
const desktopLogo = document.querySelector('.desktop-logo');
const mobileLogo = document.querySelector('.mobile-logo');
const overlay = document.getElementById('overlay');
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const desktopToggleSidebar = document.getElementById('desktopToggleSidebar');

desktopToggleSidebar?.addEventListener('click', () => {
  if (window.innerWidth > 768) {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
    desktopLogo.classList.toggle('d-none');
    mobileLogo.classList.toggle('d-none');
  }
  if (window.innerWidth < 768) { 
    sidebar.classList.remove('collapsed');
  }
});

// Initial state based on window size
window.addEventListener('resize', () => {
  if (window.innerWidth < 768) {
    sidebar.classList.remove('collapsed');
    mainContent.classList.remove('collapsed');
  }
});
window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    sidebar.classList.remove('collapsed');
    mainContent.classList.remove('collapsed');
    desktopLogo.classList.remove('d-none');
    mobileLogo.classList.add('d-none');
  }
});

// Mobile menu toggle
mobileMenuToggle?.addEventListener('click', () => {
  sidebar.classList.toggle('show');
  overlay.classList.toggle('show');
});
// Overlay click closes menu
overlay?.addEventListener('click', () => {
  sidebar.classList.remove('show');
  overlay.classList.remove('show');
});

// Add active class to the current page
function setActiveSidebarLink() {
  const currentUrl = window.location.href;
  const navLinks = document.querySelectorAll('.submenu .nav-link');
  navLinks.forEach(link => {
    const linkHref = link.getAttribute('href');
    if (currentUrl.endsWith(linkHref)) {
      link.classList.add('active');
      const submenu = link.closest('.submenu');
      if (submenu) {
        submenu.classList.add('show');
        const parentLink = submenu.previousElementSibling;
        if (parentLink && parentLink.classList.contains('nav-link')) {
          parentLink.classList.add('active');
        }
      }
    }
  });
}
window.addEventListener('DOMContentLoaded', setActiveSidebarLink);

// Scroll to top button
const backToTopBtn = document.getElementById("backToTopBtn");
window.onscroll = () => {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    backToTopBtn.classList.remove("d-none");
  } else {
    backToTopBtn.classList.add("d-none");
  }
};
backToTopBtn.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

// Fullscreen toggle functionality
document.getElementById('fullscreenToggle').addEventListener('click', function (e) {
  e.preventDefault();
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen();
  } else {
    document.exitFullscreen();
  }
});
function updateFullscreenIcon() {
  var icon = document.querySelector('#fullscreenToggle i');
  if (document.fullscreenElement) {
    if (icon) {
      icon.classList.remove('bi-fullscreen');
      icon.classList.add('bi-fullscreen-exit');
    }
  } else {
    if (icon) {
      icon.classList.remove('bi-fullscreen-exit');
      icon.classList.add('bi-fullscreen');
    }
  }
}
document.addEventListener('fullscreenchange', updateFullscreenIcon);
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape' && document.fullscreenElement) {
    document.exitFullscreen();
  }
});
updateFullscreenIcon();

// Dark mode toggle functionality
const setTheme = (theme) => {
  const html = document.getElementById('htmlPage');
  const icon = document.querySelector('#toggle-dark-mode i');
  html.setAttribute('data-bs-theme', theme);
  if (icon) icon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
};
window.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('toggle-dark-mode');
  const savedTheme = localStorage.getItem('theme') || 'light';
  setTheme(savedTheme);
  toggle?.addEventListener('click', () => {
    const html = document.getElementById('htmlPage');
    const current = html.getAttribute('data-bs-theme');
    const next = current === 'dark' ? 'light' : 'dark';
    setTheme(next);
    localStorage.setItem('theme', next);
  });
});

// Quill editor initialization
    // const quill = new Quill('#editor', {
    //   modules: {
    //     syntax: true,
    //     toolbar: '#toolbar-container',
    //   },
    //   theme: 'snow',
    // });

    // Set initial content
    // quill.setContents([
    //   { insert: 'Quill Snow ', attributes: { bold: true } },
    //   { insert: 'is a free, open source ' },
    //   { insert: 'Quill Editor', attributes: { link: 'https://quilljs.com' } },
    //   { insert: ' built for the modern web. With its ' },
    //   { insert: 'modular architecture', attributes: { link: 'https://quilljs.com/docs/modules/' } },
    //   { insert: ' and expressive API, it is completely customizable to fit any need.\n\n' },
    //   { insert: '1. Write text select and edit with multiple options.\n' },
    //   { insert: '2. This is quill snow editor.\n' },
    //   { insert: '3. Easy to customize and flexible.\n\n' },
    //   { insert: 'Quill officially supports a standard toolbar theme ' },
    //   { insert: '"Snow"', attributes: { link: 'https://quilljs.com/docs/themes/#snow' } },
    //   { insert: ' and a floating tooltip theme ' },
    //   { insert: '"Bubble"\n', attributes: { link: 'https://quilljs.com/docs/themes/#bubble' } }
    // ]);