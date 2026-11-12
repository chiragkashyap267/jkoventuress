<?php require_once __DIR__ . '/inc/content.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<title>Page Not Found — J&amp;Ko Ventures</title>
<meta name="description" content="The page you are looking for could not be found. Explore our corporate gifting solutions or get in touch with the J&amp;Ko Ventures team." />
<link rel="icon" href="/assets/img/favicon.ico<?= '?v=' . ASSET_V ?>" sizes="any" />
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png<?= '?v=' . ASSET_V ?>" />
<link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png<?= '?v=' . ASSET_V ?>" />
<meta name="theme-color" content="#c1ae9f" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="/assets/css/style.css<?= '?v=' . ASSET_V ?>" />
</head>
<body>

<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="/" aria-label="J&amp;Ko Ventures — home">
      <img class="brand-logo" src="/assets/img/logo-full.png<?= '?v=' . ASSET_V ?>" alt="J&amp;Ko Ventures — Global Vision" width="960" height="960" />
    </a>

    <nav class="nav" id="primary-nav">
      <a href="/">Home</a>
      <a href="/about">About</a>
      <a href="/services">Gifting Solutions</a>
      <a href="/occasions">Occasions</a>
      <a href="/approach">Our Approach</a>
      <a href="/why-us">Why Us</a>
      <a href="/contact">Contact</a>
    </nav>

    <a class="btn btn-primary header-cta" href="/contact">Enquire</a>

    <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="primary-nav"><i></i></button>
  </div>
</header>

<main>
<section class="page-hero" style="padding-block:clamp(80px,12vw,140px)">
    <div class="wrap">
      <span class="eyebrow center"><?= t('404.label1') ?></span>
      <h1><?= t('404.h1') ?></h1>
      <p class="lede"><?= t('404.lede') ?></p>
      <div class="btn-row center" style="margin-top:32px">
        <a class="btn btn-primary" href="/">Back to Home</a>
        <a class="btn btn-ghost" href="/contact">Contact Us</a>
      </div>
    </div>
  </section>

  <section class="section-white">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('404.label2') ?></span>
        <h2><?= t('404.heading1') ?></h2>
      </div>
      <div class="grid grid-3">
        <a class="card reveal" href="/services">
          <h3>Gifting Solutions</h3>
          <p>Our complete range — corporate gifts, hampers, merchandise, trophies, lanyards and name plates.</p>
        </a>
        <a class="card reveal d1" href="/occasions">
          <h3>Occasions</h3>
          <p>Onboarding, appreciation, festivals, conferences, launches, milestones and more.</p>
        </a>
        <a class="card reveal d2" href="/about">
          <h3>About Us</h3>
          <p>Who we are, what we believe about gifting, and the vision we are working towards.</p>
        </a>
      </div>
    </div>
  </section>

</main>

<footer class="site-footer">
  <div class="wrap footer-grid">
    <div class="footer-brand">
      <a class="brand" href="/">
        <img class="brand-logo footer-logo" src="/assets/img/logo-full.png<?= '?v=' . ASSET_V ?>" alt="J&amp;Ko Ventures — Global Vision" width="960" height="960" />
      </a>
      <p>
        Corporate gifting, customised gifts, branded merchandise and premium gift solutions &mdash;
        designed around your brand, occasion and people.
      </p>
    </div>

    <div>
      <h4>Explore</h4>
      <ul class="footer-links">
        <li><a href="/about">About Us</a></li>
        <li><a href="/services">Gifting Solutions</a></li>
        <li><a href="/occasions">Occasions</a></li>
        <li><a href="/approach">Our Approach</a></li>
        <li><a href="/why-us">Why Choose Us</a></li>
      </ul>
    </div>

    <div>
      <h4>Popular</h4>
      <ul class="footer-links">
        <li><a href="/services#hampers">Gift Hampers</a></li>
        <li><a href="/services#welcome-kits">Welcome Kits</a></li>
        <li><a href="/services#lanyards">Lanyards &amp; ID Cards</a></li>
        <li><a href="/services#trophies">Trophies &amp; Awards</a></li>
        <li><a href="/services#name-plates">Name Plates</a></li>
      </ul>
    </div>

    <div>
      <h4>Get in Touch</h4>
      <ul class="footer-links">
        <li><a href="mailto:<?= contact('email_primary') ?>"><?= contact('email_primary') ?></a></li>
        <li><a href="tel:<?= tel_href(contact_raw('phone_primary')) ?>"><?= contact('phone_primary') ?></a></li>
        <li><a href="tel:<?= tel_href(contact_raw('phone_secondary')) ?>"><?= contact('phone_secondary') ?></a></li>
        <li class="footer-address">
          <?= contact('address_line1') ?><br />
          <?= contact('address_line2') ?>
        </li>
        <li><a href="/contact">Send an Enquiry</a></li>
      </ul>
    </div>
  </div>

  <div class="wrap footer-bottom">
    <span>&copy; <span id="year">2026</span> J&amp;Ko Ventures. All rights reserved.</span>
    <span class="tagline">Corporate Gifting &middot; Customised Gifts &middot; Branded Merchandise</span>
  </div>
</footer>

<script src="/assets/js/main.js<?= '?v=' . ASSET_V ?>"></script>
</body>
</html>
