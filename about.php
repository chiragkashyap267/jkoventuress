<?php require_once __DIR__ . '/inc/content.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<title>About Us — J&amp;Ko Ventures | Corporate Gifting Company</title>
<meta name="description" content="J&amp;Ko Ventures is a professional corporate and customised gifting company helping businesses create meaningful experiences for employees, clients, partners and stakeholders." />
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
      <a href="/about" aria-current="page">About</a>
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
<section class="page-hero">
    <div class="wrap">
      <p class="crumbs"><a href="/">Home</a><i>&rsaquo;</i>About Us</p>
      <span class="eyebrow center"><?= t('about.label1') ?></span>
      <h1><?= t('about.h1') ?></h1>
      <p class="lede"><?= t('about.lede') ?></p>
    </div>
  </section>

  <section class="section-white">
    <div class="wrap-narrow">
      <div class="reveal">
        <p class="lede"><?= t('about.lede2') ?></p>
        <p style="color:var(--muted)">
          From thoughtfully curated gift hampers to premium customised merchandise, employee
          welcome kits, festive gifts, promotional products and executive gifts, we provide
          complete gifting solutions designed around your brand and occasion.
        </p>
        <div class="divider center"></div>
        <p style="color:var(--muted);text-align:center;font-family:var(--serif);font-size:1.3rem;font-style:italic">
          Our goal is simple: to make every corporate gift memorable, purposeful and
          beautifully presented.
        </p>
      </div>
    </div>
  </section>

  <section class="section-tint">
    <div class="wrap split">
      <div class="reveal">
        <span class="eyebrow"><?= t('about.label2') ?></span>
        <h2><?= t('about.heading1') ?></h2>
        <p style="color:var(--muted)">
          J&amp;Ko Ventures was created with a vision to transform corporate gifting from a
          routine business activity into an opportunity to build stronger relationships.
        </p>
        <p style="color:var(--muted)">
          We understand that every business has its own identity, culture, values and audience.
          That is why we do not believe in a one-size-fits-all approach. We work closely with
          our clients to understand their requirements, budget, occasion, brand personality and
          target recipients before creating the right gifting solution.
        </p>
        <p style="color:var(--muted)">
          Whether you are looking for gifts for corporate events, employee appreciation, client
          relationships, festive celebrations, conferences, product launches, onboarding,
          annual celebrations, weddings, milestone achievements or special occasions, our team
          helps you create gifts that leave a lasting impression.
        </p>
      </div>
      <div class="split-media has-photo reveal d2">
        <img src="/<?= img_src('premium-gift-boxes', 'assets/img/photos/premium-gift-boxes.jpg') ?>" alt="Two dark premium gift boxes finished with pale satin ribbon" width="1200" height="1000" loading="lazy" decoding="async" />
      </div>
    </div>
  </section>

  <section class="section-white">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('about.label3') ?></span>
        <h2><?= t('about.heading2') ?></h2>
      </div>
      <div class="grid grid-2">
        <article class="card reveal">
          <div class="card-icon"><i>&#10022;</i></div>
          <h3>Our Vision</h3>
          <p style="margin-bottom:14px">
            To become a trusted name in the corporate gifting industry by creating gifting
            experiences that combine creativity, quality, personalisation, reliability and
            exceptional service.
          </p>
          <p>
            We aspire to build long-term relationships with our clients by becoming more than
            just a gifting supplier — we want to be their trusted gifting partner.
          </p>
        </article>
        <article class="card reveal d1">
          <div class="card-icon"><i>&#9670;</i></div>
          <h3>Our Mission</h3>
          <p style="margin-bottom:14px">
            To make corporate gifting simple, creative, premium and meaningful.
          </p>
          <p>
            We strive to deliver carefully curated gifting solutions that help organisations
            appreciate their employees, strengthen client relationships, celebrate achievements,
            promote their brands and create memorable experiences.
          </p>
        </article>
      </div>
    </div>
  </section>

  <section class="section-tint">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('about.label4') ?></span>
        <h2><?= t('about.heading3') ?></h2>
        <p>
          Whether you are a startup ordering gifts for your first team, an established company
          celebrating employees, or a large organisation managing gifting across multiple
          locations, we provide solutions according to your requirements.
        </p>
      </div>
      <div class="pills reveal" style="justify-content:center">
        <span class="pill">Startups &amp; Entrepreneurs</span>
        <span class="pill">Small &amp; Medium Businesses</span>
        <span class="pill">Corporates &amp; Large Organisations</span>
        <span class="pill">MNCs</span>
        <span class="pill">Real Estate Companies</span>
        <span class="pill">Financial Institutions</span>
        <span class="pill">Educational Organisations</span>
        <span class="pill">Hospitality Businesses</span>
        <span class="pill">Healthcare Organisations</span>
        <span class="pill">Event Management Companies</span>
        <span class="pill">Agencies &amp; Institutions</span>
      </div>
    </div>
  </section>

  <section class="section-white quote-band">
    <div class="wrap-narrow reveal">
      <span class="eyebrow center"><?= t('about.label5') ?></span>
      <h2 style="margin-bottom:26px"><?= t('about.heading4') ?></h2>
      <p class="lines">
        <span>Thank you.</span>
        <span>We appreciate you.</span>
        <span>We value our relationship.</span>
        <span>We celebrate your success.</span>
        <span>We are glad to have you with us.</span>
      </p>
      <div class="divider center"></div>
      <p style="color:var(--muted)">
        At J&amp;Ko Ventures, we help businesses communicate these messages through thoughtfully
        designed gifting experiences — because a great gift may be opened in a moment, but the
        impression it creates can last much longer.
      </p>
    </div>
  </section>

  <section class="cta-band">
    <div class="wrap-narrow reveal">
      <span class="eyebrow center"><?= t('about.label6') ?></span>
      <h2><?= t('about.heading5') ?></h2>
      <p>Connect with us today to discuss your gifting requirements.</p>
      <div class="btn-row center">
        <a class="btn btn-primary" href="/contact">Contact Our Team</a>
        <a class="btn btn-ghost" href="/services">See What We Do</a>
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
