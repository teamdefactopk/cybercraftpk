// CyberCraft site interactions: header state, mobile menu, mega menu, search panel,
// scroll reveals, homepage carousel, cookie notice, back-to-top and disabled-item toasts.
(function () {
  'use strict';
  var doc = document.documentElement;
  var header = document.querySelector('.site-header');
  var toTop = document.querySelector('.to-top');
  var toast = document.getElementById('toast');

  function onScroll() {
    var y = window.scrollY || 0;
    if (header) header.classList.toggle('scrolled', y > 8);
    if (toTop) toTop.classList.toggle('show', y > 600);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Mobile menu
  var menuBtn = document.querySelector('[data-menu]');
  var nav = document.getElementById('main-nav');
  if (menuBtn && nav) {
    menuBtn.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', String(open));
    });
  }

  // Services menu: tap to open on touch / small screens
  document.querySelectorAll('.has-menu > a').forEach(function (a) {
    a.addEventListener('click', function (ev) {
      if (window.matchMedia('(max-width: 980px)').matches) {
        var item = a.parentElement;
        if (!item.classList.contains('open')) {
          ev.preventDefault();
          item.classList.add('open');
        }
      }
    });
  });

  // Search panel
  var panel = document.getElementById('search-panel');
  var openBtn = document.querySelector('[data-search-open]');
  var closeBtn = document.querySelector('[data-search-close]');
  function setSearch(open) {
    if (!panel) return;
    panel.hidden = !open;
    if (openBtn) openBtn.setAttribute('aria-expanded', String(open));
    if (open) { var i = panel.querySelector('input'); if (i) i.focus(); }
  }
  if (openBtn) openBtn.addEventListener('click', function () { setSearch(panel.hidden); });
  if (closeBtn) closeBtn.addEventListener('click', function () { setSearch(false); openBtn && openBtn.focus(); });
  document.addEventListener('keydown', function (ev) {
    if (ev.key === 'Escape') {
      setSearch(false);
      if (nav) { nav.classList.remove('open'); menuBtn && menuBtn.setAttribute('aria-expanded', 'false'); }
    }
    if (ev.key === '/' && !/input|textarea|select/i.test((document.activeElement || {}).tagName || '')) {
      ev.preventDefault();
      setSearch(true);
    }
  });

  // Scroll reveal (content is visible by default without JS or with reduced motion)
  var reveals = document.querySelectorAll('.reveal, .step');
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if ('IntersectionObserver' in window && doc.classList.contains('anim') && !reduce) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
      });
    }, { rootMargin: '0px 0px -5% 0px', threshold: 0 });
    reveals.forEach(function (el) { io.observe(el); });
    // Fast scrolling or jump links can skip the observer: show everything at or above the viewport
    var pending = false;
    window.addEventListener('scroll', function () {
      if (pending) return;
      pending = true;
      requestAnimationFrame(function () {
        pending = false;
        var limit = window.innerHeight;
        reveals.forEach(function (el) {
          if (!el.classList.contains('in') && el.getBoundingClientRect().top < limit) { el.classList.add('in'); io.unobserve(el); }
        });
      });
    }, { passive: true });
  } else {
    reveals.forEach(function (el) { el.classList.add('in'); });
  }


  // Service tabs (homepage)
  var tabs = [].slice.call(document.querySelectorAll('[role="tab"]'));
  function showTab(t) {
    tabs.forEach(function (x) {
      var on = x === t;
      x.setAttribute('aria-selected', String(on));
      x.tabIndex = on ? 0 : -1;
      var p = document.getElementById(x.getAttribute('aria-controls'));
      if (p) p.hidden = !on;
    });
  }
  tabs.forEach(function (t, i) {
    t.addEventListener('click', function () { showTab(t); });
    t.addEventListener('keydown', function (ev) {
      var k = ev.key === 'ArrowRight' ? 1 : ev.key === 'ArrowLeft' ? -1 : 0;
      if (!k) return;
      var n = tabs[(i + k + tabs.length) % tabs.length];
      n.focus(); showTab(n);
    });
  });

  // Hero network: slow-moving nodes in brand blues (static frame with reduced motion)

  // Homepage carousel: one photo per line of work; pauses on hover or keyboard focus
  document.querySelectorAll('[data-carousel]').forEach(function (hero) {
    var slides = hero.querySelectorAll('.slide');
    var tabs = hero.querySelectorAll('.slide-tab');
    if (slides.length < 2) return;
    var i = 0, timer = null, DUR = 6000;
    var motionOff = reduce || !doc.classList.contains('anim');
    hero.style.setProperty('--dur', DUR + 'ms');
    function show(n) {
      i = (n + slides.length) % slides.length;
      slides.forEach(function (s, k) { s.classList.toggle('on', k === i); });
      tabs.forEach(function (t, k) { t.setAttribute('aria-pressed', k === i ? 'true' : 'false'); });
    }
    function stop() { if (timer) { clearInterval(timer); timer = null; } hero.classList.add('paused'); }
    function play() { if (motionOff) return; stop(); hero.classList.remove('paused'); timer = setInterval(function () { show(i + 1); }, DUR); }
    tabs.forEach(function (t, k) { t.addEventListener('click', function () { show(k); play(); }); });
    hero.addEventListener('mouseenter', stop);
    hero.addEventListener('mouseleave', play);
    hero.addEventListener('focusin', stop);
    hero.addEventListener('focusout', play);
    document.addEventListener('visibilitychange', function () { if (document.hidden) stop(); else play(); });
    play();
  });

  var still = reduce || !doc.classList.contains('anim');
  document.querySelectorAll('canvas.net').forEach(function (c) {
    if (!c.getContext) return;
    var x = c.getContext('2d'), w, h, pts = [], running = true;
    function size() {
      var d = Math.min(window.devicePixelRatio || 1, 2);
      w = c.clientWidth; h = c.clientHeight;
      c.width = w * d; c.height = h * d; x.setTransform(d, 0, 0, d, 0, 0);
      var n = Math.min(140, Math.round(w * h / 11000)); pts = [];
      for (var i = 0; i < n; i++) pts.push({ x: Math.random() * w, y: Math.random() * h, vx: (Math.random() - .5) * .25, vy: (Math.random() - .5) * .25, r: Math.random() * 1.8 + .6, k: Math.random() });
    }
    function draw() {
      x.clearRect(0, 0, w, h);
      for (var i = 0; i < pts.length; i++) {
        var p = pts[i];
        if (!still) { p.x += p.vx; p.y += p.vy; if (p.x < 0 || p.x > w) p.vx *= -1; if (p.y < 0 || p.y > h) p.vy *= -1; }
        for (var j = i + 1; j < pts.length; j++) {
          var q = pts[j], dx = p.x - q.x, dy = p.y - q.y, dd = dx * dx + dy * dy;
          if (dd < 15000) { x.strokeStyle = 'rgba(91,143,219,' + (.22 * (1 - dd / 15000)) + ')'; x.lineWidth = 1; x.beginPath(); x.moveTo(p.x, p.y); x.lineTo(q.x, q.y); x.stroke(); }
        }
      }
      for (i = 0; i < pts.length; i++) {
        p = pts[i];
        x.fillStyle = p.k > .93 ? 'rgba(245,180,85,.9)' : p.k > .8 ? 'rgba(140,194,255,.9)' : 'rgba(91,143,219,.7)';
        x.beginPath(); x.arc(p.x, p.y, p.r, 0, 6.283); x.fill();
      }
      if (!still && running) requestAnimationFrame(draw);
    }
    if ('IntersectionObserver' in window && !still) {
      new IntersectionObserver(function (en) {
        var vis = en[0].isIntersecting;
        if (vis && !running) { running = true; requestAnimationFrame(draw); }
        running = vis;
      }).observe(c);
    }
    size(); draw();
    window.addEventListener('resize', function () { size(); if (still) draw(); });
  });

  // Disabled items: explain instead of doing nothing
  function showToast(msg) {
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.add('show');
    clearTimeout(showToast.t);
    showToast.t = setTimeout(function () { toast.classList.remove('show'); }, 2400);
  }
  document.querySelectorAll('[aria-disabled="true"]').forEach(function (el) {
    el.setAttribute('tabindex', '0');
    function explain(ev) { ev.preventDefault(); showToast(el.getAttribute('title') || 'Coming soon'); }
    el.addEventListener('click', explain);
    el.addEventListener('keydown', function (ev) { if (ev.key === 'Enter' || ev.key === ' ') explain(ev); });
  });

  // Cookie notice
  var cookie = document.getElementById('cookie');
  try {
    if (cookie && !localStorage.getItem('cc_cookie_ok')) cookie.hidden = false;
  } catch (e) { /* storage unavailable: keep hidden */ }
  var ok = document.querySelector('[data-cookie-ok]');
  if (ok) ok.addEventListener('click', function () {
    cookie.hidden = true;
    try { localStorage.setItem('cc_cookie_ok', '1'); } catch (e) {}
  });

  // Light client-side validation for the contact form (server validates too)
  var form = document.querySelector('form[data-validate]');
  if (form) {
    form.addEventListener('submit', function (ev) {
      if (!form.checkValidity()) {
        ev.preventDefault();
        var bad = form.querySelector(':invalid');
        if (bad) { bad.focus(); if (bad.reportValidity) bad.reportValidity(); }
      } else {
        var b = form.querySelector('button[type="submit"]');
        if (b) { b.disabled = true; b.textContent = 'Sending…'; }
      }
    });
  }
})();
