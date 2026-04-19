/**
 * StudyOS – script.js
 *
 * Sidebar states (desktop):
 *   compact  ← default (body.sidebar-is-compact)
 *   full     ← single click on toggle
 *   hidden   ← double click on toggle
 *
 * Mobile: hamburger → sb--open class on .sb, overlay shown
 */

(function () {
  'use strict';

  /* ── Refs ── */
  const body        = document.body;
  const sidebar     = document.getElementById('sidebar');
  const sbToggle    = document.getElementById('sbToggle');
  const sbToggleIcon= document.getElementById('sbToggleIcon');
  const sbClose     = document.getElementById('sbClose');
  const sbOverlay   = document.getElementById('sbOverlay');
  const hamBtn      = document.getElementById('hamBtn');
  const pageWrap    = document.getElementById('pageWrap');
  const progFill    = document.querySelector('.prog-fill');
  const dateLabel   = document.getElementById('dateLabel');
  const navLinks    = document.querySelectorAll('.sb__link');

  /* ── State ── */
  // desktop states: 'compact' | 'full' | 'hidden'
  let desktopState = 'compact';   // default: collapsed

  function setDesktop(state) {
    desktopState = state;
    body.classList.remove('sidebar-is-compact', 'sidebar-is-full', 'sidebar-is-hidden');
    if (state === 'compact') body.classList.add('sidebar-is-compact');
    if (state === 'hidden')  body.classList.add('sidebar-is-hidden');
    // 'full' needs no extra class — default styles apply
    updateToggleIcon(state);
  }

  function updateToggleIcon(state) {
    if (!sbToggleIcon) return;
    // Chevron direction handled in CSS via body class
    // Update label text
    const lbl = sbToggle ? sbToggle.querySelector('.sb__toggle-label') : null;
    if (lbl) {
      lbl.textContent = state === 'full' ? 'Einklappen' : 'Ausklappen';
    }
  }

  /* ── Desktop toggle: click = full↔compact, dblclick = hidden ── */
  let clickTimer = null;
  const DBL = 260;

  if (sbToggle) {
    sbToggle.addEventListener('click', () => {
      if (clickTimer) return; // wait for dblclick check
      clickTimer = setTimeout(() => {
        clickTimer = null;
        if (desktopState === 'full')    setDesktop('compact');
        else if (desktopState === 'compact') setDesktop('full');
        else if (desktopState === 'hidden')  setDesktop('compact');
      }, DBL);
    });

    sbToggle.addEventListener('dblclick', () => {
      if (clickTimer) { clearTimeout(clickTimer); clickTimer = null; }
      if (desktopState === 'hidden') setDesktop('compact');
      else                           setDesktop('hidden');
    });
  }

  /* ── Mobile: open / close ── */
  function openMobile() {
    sidebar.classList.add('sb--open');
    sbOverlay.classList.add('active');
    body.style.overflow = 'hidden';
    if (hamBtn) hamBtn.setAttribute('aria-expanded', 'true');
  }
  function closeMobile() {
    sidebar.classList.remove('sb--open');
    sbOverlay.classList.remove('active');
    body.style.overflow = '';
    if (hamBtn) hamBtn.setAttribute('aria-expanded', 'false');
  }

  if (hamBtn)    hamBtn.addEventListener('click', openMobile);
  if (sbClose)   sbClose.addEventListener('click', closeMobile);
  if (sbOverlay) sbOverlay.addEventListener('click', closeMobile);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMobile(); });
  window.addEventListener('resize', () => { if (window.innerWidth > 991) closeMobile(); });

  /* ── Nav link active state ── */
  // navLinks.forEach(link => {
  //   link.addEventListener('click', e => {
  //     e.preventDefault();
  //     navLinks.forEach(l => l.classList.remove('active'));
  //     link.classList.add('active');
  //     if (window.innerWidth <= 991) setTimeout(closeMobile, 140);
  //   });
  // });

  /* ── Tooltip: compute --tip-top for fixed-positioned tooltips ──
     Since tooltips use position:fixed, we set a CSS variable on each
     link so the ::after pseudo-element can position itself correctly.
  */
  function bindTooltipPositions() {
    navLinks.forEach(link => {
      link.addEventListener('mouseenter', () => {
        const rect = link.getBoundingClientRect();
        const mid  = rect.top + rect.height / 2;
        link.style.setProperty('--tip-top', mid + 'px');
      });
    });
    const userEl = document.querySelector('.sb__user');
    if (userEl) {
      userEl.addEventListener('mouseenter', () => {
        const rect = userEl.getBoundingClientRect();
        userEl.style.setProperty('--tip-top', (rect.top + rect.height / 2) + 'px');
      });
    }
  }
  bindTooltipPositions();

  /* ── Progress bar animation ── */
  function animateProgress() {
    if (!progFill) return;
    const target = progFill.getAttribute('data-w') || '0';
    progFill.style.width = '0%';
    requestAnimationFrame(() => {
      setTimeout(() => { progFill.style.width = target + '%'; }, 150);
    });
  }

  /* ── Date label ── */
  function setDate() {
    if (!dateLabel) return;
    const d = new Date();
    const str = d.toLocaleDateString('de-DE', {
      weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
    });
    dateLabel.innerHTML = '<i class="bi bi-calendar3" style="margin-right:5px"></i>' + str;
  }

  /* ── Chat FAB ── */
  const chatFab = document.getElementById('chatFab');
  if (chatFab) {
    chatFab.addEventListener('click', () => {
      chatFab.style.transform = 'scale(.92)';
      setTimeout(() => { chatFab.style.transform = ''; }, 150);
    });
  }

  /* ── Init ── */
  function init() {
    setDesktop('compact');   // start collapsed
    setDate();
    animateProgress();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

}());
