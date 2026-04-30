/* ============================================================
   PROAISKILL — MAIN JS
   ============================================================ */

(function () {
  'use strict';



  window.selectBox = function(el) {
    const all = document.querySelectorAll('.learning-box');
    all.forEach(b => b.classList.remove('active'));
    el.classList.add('active');
  };


  /* ── Mobile Menu Toggle ── */
  const hamburger = document.querySelector('.navbar__hamburger');
  const mobileMenu = document.querySelector('.mobile-menu');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('is-open');
      hamburger.setAttribute('aria-expanded', isOpen);
      // Animate bars
      const bars = hamburger.querySelectorAll('span');
      if (isOpen) {
        bars[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
        bars[1].style.opacity   = '0';
        bars[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
      } else {
        bars[0].style.transform = '';
        bars[1].style.opacity   = '';
        bars[2].style.transform = '';
      }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
      if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenu.classList.remove('is-open');
        const bars = hamburger.querySelectorAll('span');
        bars.forEach(b => { b.style.transform = ''; b.style.opacity = ''; });
      }
    });
  }

  /* ── Active Nav Link ── */
  const navLinks = document.querySelectorAll('.navbar__nav-item');
  const mobileLinks = document.querySelectorAll('.mobile-menu__item');

  function setActive(items, href) {
    items.forEach(item => {
      item.classList.remove('active');
      if (item.querySelector('a') && item.querySelector('a').getAttribute('href') === href) {
        item.classList.add('active');
      }
    });
  }

  // navLinks.forEach(item => {
  //   item.querySelector('a')?.addEventListener('click', function (e) {
  //     e.preventDefault();
  //     navLinks.forEach(i => i.classList.remove('active'));
  //     mobileLinks.forEach(i => i.classList.remove('active'));
  //     item.classList.add('active');
  //   });
  // });

  mobileLinks.forEach(item => {
    item.querySelector('a')?.addEventListener('click', function () {
      mobileMenu.classList.remove('is-open');
    });
  });

  /* ── Chat Bubble Pulse ── */
  const chatBubble = document.querySelector('.chat-bubble');
  if (chatBubble) {
    chatBubble.addEventListener('click', () => {
      chatBubble.style.transform = 'scale(0.9)';
      setTimeout(() => { chatBubble.style.transform = ''; }, 150);
    });
  }

  /* ── Scroll-based navbar shadow ── */
  const navbar = document.querySelector('.navbars');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
        navbar.style.boxShadow = '0 2px 12px rgba(0,0,0,0.08)';
      } else {
        navbar.style.boxShadow = 'none';
      }
    }, { passive: true });
  }

  /* ── Job Card Hover ── */
  document.querySelectorAll('.job-card').forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.borderColor = 'var(--color-primary)';
    });
    card.addEventListener('mouseleave', function () {
      this.style.borderColor = '';
    });
  });



  lucide.createIcons();






})();


(function () {
  const profileTrigger  = document.getElementById('navbar-profile-trigger');
  const profileDropdown = document.getElementById('navbar-profile-dropdown');
  const searchTrigger   = document.getElementById('navbar-search-trigger');
  const searchOverlay   = document.getElementById('navbar-search-overlay');
  const searchPopup     = document.getElementById('navbar-search-popup');
  const searchInput     = document.getElementById('navbar-search-input');
  const searchClose     = document.getElementById('navbar-search-close');

  // ── Profile dropdown ──
  function openProfile() {
    profileDropdown.classList.add('navbar__profile-dropdown--open');
    profileTrigger.setAttribute('aria-expanded', 'true');
    profileTrigger.classList.add('navbar__icon-btn--active');
  }

  function closeProfile() {
    profileDropdown.classList.remove('navbar__profile-dropdown--open');
    profileTrigger.setAttribute('aria-expanded', 'false');
    profileTrigger.classList.remove('navbar__icon-btn--active');
  }

  profileTrigger.addEventListener('click', function (e) {
    e.stopPropagation();
    const isOpen = profileDropdown.classList.contains('navbar__profile-dropdown--open');
    isOpen ? closeProfile() : openProfile();
  });

  // ── Search popup ──
  function openSearch() {
    searchPopup.classList.add('navbar__search-popup--open');
    searchOverlay.classList.add('navbar__search-overlay--open');
    searchTrigger.classList.add('navbar__icon-btn--active');
    setTimeout(() => searchInput.focus(), 260);
    closeProfile();
  }

  function closeSearch() {
    searchPopup.classList.remove('navbar__search-popup--open');
    searchOverlay.classList.remove('navbar__search-overlay--open');
    searchTrigger.classList.remove('navbar__icon-btn--active');
  }

  searchTrigger.addEventListener('click', function (e) {
    e.stopPropagation();
    const isOpen = searchPopup.classList.contains('navbar__search-popup--open');
    isOpen ? closeSearch() : openSearch();
  });

  searchClose.addEventListener('click', closeSearch);
  searchOverlay.addEventListener('click', closeSearch);

  // ── Close on outside click ──
  document.addEventListener('click', function (e) {
    if (!profileDropdown.contains(e.target) && e.target !== profileTrigger) {
      closeProfile();
    }
  });

  // ── Close on Escape ──
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeProfile();
      closeSearch();
    }
  });
})();
