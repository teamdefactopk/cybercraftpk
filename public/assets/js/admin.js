// CyberCraft admin: sidebar toggle, row links, delete confirmations, unsaved-change warnings, textarea autosize.
(function () {
  'use strict';
  var side = document.getElementById('side');
  var toggle = document.querySelector('[data-side]');
  if (toggle && side) {
    toggle.addEventListener('click', function () { side.classList.toggle('open'); });
    document.addEventListener('click', function (ev) {
      if (side.classList.contains('open') && !side.contains(ev.target) && !toggle.contains(ev.target)) side.classList.remove('open');
    });
  }

  // Click anywhere on a table row to open it
  document.querySelectorAll('tr[data-href]').forEach(function (tr) {
    tr.addEventListener('click', function (ev) {
      if (ev.target.closest('a, button, form, input')) return;
      window.location.href = tr.getAttribute('data-href');
    });
  });

  // Confirm destructive actions
  document.addEventListener('click', function (ev) {
    var b = ev.target.closest('[data-confirm]');
    if (b && !window.confirm(b.getAttribute('data-confirm'))) { ev.preventDefault(); ev.stopPropagation(); }
  }, true);

  // Warn before leaving a form with unsaved changes
  document.querySelectorAll('form[data-dirty]').forEach(function (form) {
    var dirty = false;
    form.addEventListener('input', function () {
      if (dirty) return;
      dirty = true;
      var bar = form.querySelector('.form-actions');
      if (bar && !bar.querySelector('.dirty-note')) {
        var s = document.createElement('span');
        s.className = 'dirty-note';
        s.textContent = 'Unsaved changes';
        bar.appendChild(s);
      }
    });
    form.addEventListener('submit', function () { dirty = false; });
    window.addEventListener('beforeunload', function (ev) { if (dirty) { ev.preventDefault(); ev.returnValue = ''; } });
  });

  // Auto-grow textareas
  function size(t) { t.style.height = 'auto'; t.style.height = Math.min(t.scrollHeight + 2, 640) + 'px'; }
  document.querySelectorAll('textarea[data-autosize]').forEach(function (t) {
    size(t);
    t.addEventListener('input', function () { size(t); });
  });

  // Close user menu on outside click
  var um = document.querySelector('.user-menu');
  if (um) document.addEventListener('click', function (ev) { if (!um.contains(ev.target)) um.removeAttribute('open'); });
})();
