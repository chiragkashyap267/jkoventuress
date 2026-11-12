<?php require_once __DIR__ . '/inc/content.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<title>J&amp;Ko Ventures — Corporate Gifting &amp; Customised Gift Solutions</title>
<meta name="description" content="J&amp;Ko Ventures is a corporate and customised gifting company creating curated hampers, branded merchandise, welcome kits, trophies, lanyards, name plates and premium executive gifts for businesses." />
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
      <a href="/" aria-current="page">Home</a>
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

  <!-- ============ HERO ============ -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <h1><?= t('index.h1') ?></h1>
        <p class="hero-sub"><?= t('index.sub') ?></p>
        <p class="lede"><?= t('index.lede') ?></p>
        <div class="btn-row">
          <a class="btn btn-primary" href="/contact">Start an Enquiry</a>
          <a class="btn btn-ghost" href="/services">Explore Solutions</a>
        </div>
      </div>

      <div class="hero-logo">
        <img class="art" src="/assets/img/logo-full.png<?= '?v=' . ASSET_V ?>"
             alt="J&amp;Ko Ventures — Global Vision"
             width="960" height="960" fetchpriority="high" decoding="async" />
        <span class="sweep" aria-hidden="true"></span>
      </div>
    </div>
  </section>

  <!-- ============ INTRO ============ -->
  <section class="section-white">
    <div class="wrap split">
      <div class="reveal">
        <span class="eyebrow"><?= t('index.label1') ?></span>
        <h2><?= t('index.heading1') ?></h2>
        <p class="lede"><?= t('index.lede2') ?></p>
        <p style="color:var(--muted)">
          Every business has its own identity, culture, values and audience — which is why we
          do not believe in a one-size-fits-all approach. We work closely with our clients to
          understand their requirement, budget, occasion, brand personality and recipients
          before creating the right gifting solution.
        </p>
        <div class="divider"></div>
        <a class="btn btn-ghost" href="/about">More About Us</a>
      </div>
      <div class="split-media has-photo reveal d2">
        <img src="/<?= img_src('team-meeting', 'assets/img/photos/team-meeting.jpg') ?>" alt="A team planning a corporate gifting programme around a boardroom table" width="1200" height="1000" loading="lazy" decoding="async" />
      </div>
    </div>
  </section>

  <!-- ============ STATS ============ -->
  <section class="section-tint" style="padding-block:clamp(48px,6vw,72px)">
    <div class="wrap">
      <div class="stats reveal">
        <div class="stat"><b>18+</b><span>Gifting Categories</span></div>
        <div class="stat"><b>End&#8209;to&#8209;End</b><span>Concept to Delivery</span></div>
        <div class="stat"><b>Any Scale</b><span>Startup to Enterprise</span></div>
        <div class="stat"><b>100%</b><span>Custom Branded</span></div>
      </div>
    </div>
  </section>

  <!-- ============ WHAT WE DO ============ -->
  <section class="section-white">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('index.label2') ?></span>
        <h2><?= t('index.heading2') ?></h2>
        <p>
          From thoughtfully curated hampers to premium customised merchandise, welcome kits,
          festive gifts, promotional products and executive gifts — designed around your brand
          and your occasion.
        </p>
      </div>

      <div class="grid grid-3">
        <article class="card reveal">
          <div class="card-icon"><i>I</i></div>
          <h3>Customised Corporate Gifts</h3>
          <p>Gifts built around your brand identity, occasion and recipients — never picked off a generic catalogue.</p>
        </article>
        <article class="card reveal d1">
          <div class="card-icon"><i>II</i></div>
          <h3>Premium Executive Gifts</h3>
          <p>Minimal, sophisticated pieces for leadership, VIP clients and senior stakeholders.</p>
        </article>
        <article class="card reveal d2">
          <div class="card-icon"><i>III</i></div>
          <h3>Employee Welcome Kits</h3>
          <p>Joining and onboarding kits that make a new team member feel expected and valued from day one.</p>
        </article>
        <article class="card reveal">
          <div class="card-icon"><i>IV</i></div>
          <h3>Corporate Gift Hampers</h3>
          <p>Curated combinations assembled, branded and presented as a single considered package.</p>
        </article>
        <article class="card reveal d1">
          <div class="card-icon"><i>V</i></div>
          <h3>Branded Merchandise</h3>
          <p>Promotional and branded products that keep your identity visible long after the event.</p>
        </article>
        <article class="card reveal d2">
          <div class="card-icon"><i>VI</i></div>
          <h3>Recognition &amp; Signage</h3>
          <p>Trophies, awards, name plates, lanyards and ID cards produced to a consistent finish.</p>
        </article>
      </div>

      <div class="btn-row center" style="margin-top:44px">
        <a class="btn btn-primary" href="/services">View All Gifting Solutions</a>
      </div>
    </div>
  </section>

  <!-- ============ SIGNATURE CATEGORIES ============ -->
  <section class="section-tint">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('index.label3') ?></span>
        <h2><?= t('index.heading3') ?></h2>
        <p>Three categories we are regularly asked for — produced with the same attention to finish as everything else we make.</p>
      </div>

      <div class="grid grid-3">
        <article class="card reveal">
          <div class="card-media">
            <img src="/<?= img_src('lanyards-id-cards', 'assets/img/photos/lanyards-id-cards.jpg') ?>" alt="A printed lanyard holding a employee ID card" width="1200" height="1000" loading="lazy" decoding="async" />
          </div>
          <h3>Lanyards &amp; ID Cards</h3>
          <p>
            Custom-printed lanyards, PVC and RFID ID cards, badge holders, retractable reels and
            accessory kits — colour-matched to your brand for offices, conferences and events.
          </p>
        </article>
        <article class="card reveal d1">
          <div class="card-media">
            <img src="/<?= img_src('trophies-awards', 'assets/img/photos/trophies-awards.jpg') ?>" alt="A row of gold and silver trophies awaiting presentation" width="1200" height="1000" loading="lazy" decoding="async" />
          </div>
          <h3>Trophies &amp; Awards</h3>
          <p>
            Crystal, acrylic, metal and wooden trophies, memento plaques, certificates and
            recognition sets — engraved or printed for annual awards, milestones and achievements.
          </p>
        </article>
        <article class="card reveal d2">
          <div class="card-media">
            <img src="/<?= img_src('name-plates', 'assets/img/photos/name-plates.jpg') ?>" alt="A brushed steel desk name plate on a reception counter" width="1200" height="1000" loading="lazy" decoding="async" />
          </div>
          <h3>Name Plates</h3>
          <p>
            Desk, door, cabin and reception name plates in acrylic, brass, steel and wood,
            with engraved or printed branding for a consistent look across your workplace.
          </p>
        </article>
      </div>
    </div>
  </section>

  <!-- ============ APPROACH ============ -->
  <section class="section-white">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('index.label4') ?></span>
        <h2><?= t('index.heading4') ?></h2>
        <p>
          We select products, combinations, colours, packaging and personalisation options so
          that every gift feels intentional rather than assembled.
        </p>
      </div>

      <div class="process reveal" style="margin-bottom:56px">
        <i>Understand</i><b>&rarr;</b>
        <i>Curate</i><b>&rarr;</b>
        <i>Customise</i><b>&rarr;</b>
        <i>Brand</i><b>&rarr;</b>
        <i>Pack</i><b>&rarr;</b>
        <i>Deliver</i>
      </div>

      <div class="grid grid-4">
        <div class="card step reveal">
          <span class="num">01</span>
          <h4>Understand</h4>
          <p>Your brand, occasion, audience and budget — before a single product is proposed.</p>
        </div>
        <div class="card step reveal d1">
          <span class="num">02</span>
          <h4>Curate &amp; Customise</h4>
          <p>Products, combinations and personalisation options shaped to the brief.</p>
        </div>
        <div class="card step reveal d2">
          <span class="num">03</span>
          <h4>Brand &amp; Pack</h4>
          <p>Logo placement, inserts, messages and packaging that present the gift properly.</p>
        </div>
        <div class="card step reveal d3">
          <span class="num">04</span>
          <h4>Quality &amp; Deliver</h4>
          <p>Checks, organised order management and delivery to one location or many.</p>
        </div>
      </div>

      <div class="btn-row center" style="margin-top:44px">
        <a class="btn btn-ghost" href="/approach">See How We Work</a>
      </div>
    </div>
  </section>

  <!-- ============ OCCASIONS ============ -->
  <section class="section-tint">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('index.label5') ?></span>
        <h2><?= t('index.heading5') ?></h2>
        <p>
          Businesses have countless opportunities to appreciate and connect with their people
          and partners throughout the year.
        </p>
      </div>

      <div class="pills reveal" style="justify-content:center">
        <span class="pill">Employee Onboarding</span>
        <span class="pill">Employee Appreciation</span>
        <span class="pill">Client Appreciation</span>
        <span class="pill">Diwali &amp; Festivals</span>
        <span class="pill">Annual Celebrations</span>
        <span class="pill">Conferences</span>
        <span class="pill">Events</span>
        <span class="pill">Product Launches</span>
        <span class="pill">Business Milestones</span>
        <span class="pill">Dealer &amp; Distributor Gifting</span>
        <span class="pill">New Partnerships</span>
        <span class="pill">Awards &amp; Recognition</span>
        <span class="pill">Customer Loyalty</span>
        <span class="pill">Special Occasions</span>
      </div>

      <div class="btn-row center" style="margin-top:40px">
        <a class="btn btn-ghost" href="/occasions">Explore Occasions</a>
      </div>
    </div>
  </section>

  <!-- ============ PERSONALISATION + SUSTAINABILITY ============ -->
  <section class="section-white">
    <div class="wrap split reverse">
      <div class="split-media has-photo reveal">
        <img src="/<?= img_src('personalised-gifts', 'assets/img/photos/personalised-gifts.jpg') ?>" alt="Leather gift tags individually engraved with names and monograms" width="1200" height="1000" loading="lazy" decoding="async" />
      </div>
      <div class="reveal d1">
        <span class="eyebrow"><?= t('index.label6') ?></span>
        <h2><?= t('index.heading6') ?></h2>
        <p style="color:var(--muted)">
          We offer a wide range of personalisation and branding options — corporate logos,
          employee names, customised messages, branded packaging, personalised inserts and
          bespoke gift combinations.
        </p>
        <p style="color:var(--muted)">
          Our objective is to make every recipient feel the gift was thoughtfully selected for
          them, rather than simply picked from a catalogue.
        </p>
      </div>
    </div>
  </section>

  <section class="section-tint">
    <div class="wrap split">
      <div class="split-media has-photo reveal">
        <img src="/<?= img_src('kraft-packaging', 'assets/img/photos/kraft-packaging.jpg') ?>" alt="Plain kraft gift boxes made from recyclable materials" width="1200" height="1000" loading="lazy" decoding="async" />
      </div>
      <div class="reveal d1">
        <span class="eyebrow"><?= t('index.label7') ?></span>
        <h2><?= t('index.heading7') ?></h2>
        <p style="color:var(--muted)">
          As businesses become increasingly conscious of their environmental impact, gifting is
          evolving too. We are committed to promoting responsible and sustainable choices
          wherever possible.
        </p>
        <ul class="tick-list cols">
          <li>Reusable products</li>
          <li>Eco-conscious materials</li>
          <li>Sustainable packaging</li>
          <li>Built for long-term use</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- ============ WHY US ============ -->
  <section class="section-white">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('index.label8') ?></span>
        <h2><?= t('index.heading8') ?></h2>
      </div>

      <div class="grid grid-3">
        <article class="card reveal">
          <h3>One-Stop Solution</h3>
          <p>From concept and product selection to branding, packaging and delivery, we manage the complete process.</p>
        </article>
        <article class="card reveal d1">
          <h3>Customised for Your Brand</h3>
          <p>Every gifting requirement is different. We create solutions around your brand and objectives.</p>
        </article>
        <article class="card reveal d2">
          <h3>Quality-Focused</h3>
          <p>We focus on product quality, presentation, customisation and attention to detail.</p>
        </article>
        <article class="card reveal">
          <h3>Creative &amp; Contemporary</h3>
          <p>Our gifting concepts are designed to be modern, useful, attractive and memorable.</p>
        </article>
        <article class="card reveal d1">
          <h3>Flexible Solutions</h3>
          <p>Solutions for different occasions, budgets, quantities and business requirements.</p>
        </article>
        <article class="card reveal d2">
          <h3>Reliable Fulfilment</h3>
          <p>Organised order management, quality checks, professional packaging and timely delivery.</p>
        </article>
      </div>

      <div class="btn-row center" style="margin-top:44px">
        <a class="btn btn-ghost" href="/why-us">Why Work With Us</a>
      </div>
    </div>
  </section>

  <!-- ============ QUOTE ============ -->
  <section class="section-tint quote-band">
    <div class="wrap-narrow reveal">
      <span class="eyebrow center"><?= t('index.label9') ?></span>
      <p class="lines">
        <span>Thank you.</span>
        <span>We appreciate you.</span>
        <span>We value our relationship.</span>
        <span>We celebrate your success.</span>
        <span>We are glad to have you with us.</span>
      </p>
      <div class="divider center"></div>
      <p style="color:var(--muted)">
        A great gift may be opened in a moment, but the impression it creates can last
        much longer.
      </p>
    </div>
  </section>

  <!-- ============ CTA ============ -->
  <section class="cta-band">
    <div class="wrap-narrow reveal">
      <span class="eyebrow center"><?= t('index.label10') ?></span>
      <h2><?= t('index.heading9') ?></h2>
      <p>
        Planning your next corporate event, welcoming new employees, appreciating your team,
        strengthening client relationships or preparing for the festive season — our team is
        ready to help.
      </p>
      <div class="btn-row center">
        <a class="btn btn-primary" href="/contact">Discuss Your Requirement</a>
        <a class="btn btn-ghost" href="/services">Browse Solutions</a>
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
        Corporate gifting, customised gifts, branded merchandise and premium gift solutions —
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
