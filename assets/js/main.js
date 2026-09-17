/* J&Ko Ventures — site behaviour */
(function () {
  'use strict';

  /* ---- mobile navigation ---- */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('primary-nav');

  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });

    nav.addEventListener('click', function (e) {
      if (e.target.tagName === 'A') {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('open')) {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
      }
    });
  }

  /* ---- header shadow on scroll ---- */
  var header = document.querySelector('.site-header');
  if (header) {
    var onScroll = function () {
      header.classList.toggle('scrolled', window.scrollY > 12);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---- reveal on scroll ---- */
  var items = document.querySelectorAll('.reveal');
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!items.length) {
    /* nothing to do */
  } else if (reduced || !('IntersectionObserver' in window)) {
    items.forEach(function (el) { el.classList.add('in'); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

    items.forEach(function (el) { io.observe(el); });
  }

  /* ---- footer year ---- */
  var year = document.getElementById('year');
  if (year) { year.textContent = new Date().getFullYear(); }

  /* ---- enquiry form ----
     The form posts to form-handler.php, which emails the enquiry and sends
     the visitor back here with ?status=... We stamp the load time so the
     handler can reject submissions that arrive impossibly fast, disable the
     button on submit, and render whatever status came back. */
  var form = document.getElementById('enquiry-form');

  if (form) {
    var started = document.getElementById('f-started');
    if (started) { started.value = String(Date.now()); }

    form.addEventListener('submit', function () {
      var btn = form.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.textContent = 'Sending…';
      }
    });
  }

  var alertBox = document.getElementById('form-alert');
  if (alertBox) {
    var MESSAGES = {
      sent: ['Thank you — your enquiry has been sent. Our team will get back to you shortly.', false],
      missing: ['Please add your name, email and a little detail about the requirement, then try again.', true],
      bademail: ['That email address does not look right. Please check it and resend.', true],
      error: ['Sorry — the enquiry could not be sent just now. Please email hello@jkoventuress.com directly.', true]
    };

    var status = new URLSearchParams(window.location.search).get('status');
    var entry = status && Object.prototype.hasOwnProperty.call(MESSAGES, status) ? MESSAGES[status] : null;

    if (entry) {
      alertBox.textContent = entry[0];
      alertBox.classList.toggle('is-error', entry[1]);
      alertBox.hidden = false;

      if (!entry[1] && form) { form.reset(); }

      /* drop the query string so a refresh does not repeat the message */
      if (window.history && window.history.replaceState) {
        window.history.replaceState({}, '', window.location.pathname);
      }
    }
  }
})();
