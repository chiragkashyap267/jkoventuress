<?php require_once __DIR__ . '/inc/content.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<title>Contact — Discuss Your Gifting Requirement | J&amp;Ko Ventures</title>
<meta name="description" content="Connect with J&amp;Ko Ventures to discuss corporate gifting requirements — share your occasion, quantity, budget and timeline and our team will build the right gifting solution." />
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
      <a href="/contact" aria-current="page">Contact</a>
    </nav>

    <a class="btn btn-primary header-cta" href="/contact">Enquire</a>

    <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="primary-nav"><i></i></button>
  </div>
</header>

<main>
<section class="page-hero">
    <div class="wrap">
      <p class="crumbs"><a href="/">Home</a><i>&rsaquo;</i>Contact</p>
      <span class="eyebrow center"><?= t('contact.label1') ?></span>
      <h1><?= t('contact.h1') ?></h1>
      <p class="lede"><?= t('contact.lede') ?></p>
    </div>
  </section>

  <section class="section-white">
    <div class="wrap split" style="align-items:start">
      <div class="reveal">
        <span class="eyebrow"><?= t('contact.label2') ?></span>
        <h2><?= t('contact.heading1') ?></h2>
        <p style="color:var(--muted);margin-bottom:30px">
          The more you can share about the occasion, quantity and budget, the more useful our
          first response will be.
        </p>

        <p class="form-alert" id="form-alert" role="status" hidden></p>

        <form id="enquiry-form" class="form-grid" action="/form-handler.php" method="post">
          <!-- spam traps: hidden from people, tempting to bots -->
          <div class="hp" aria-hidden="true">
            <label for="f-website">Website</label>
            <input id="f-website" name="website" type="text" tabindex="-1" autocomplete="off" />
          </div>
          <input type="hidden" name="started_at" id="f-started" value="" />
          <div class="field">
            <label for="f-name">Your Name</label>
            <input id="f-name" name="name" type="text" placeholder="Full name" required />
          </div>
          <div class="field">
            <label for="f-company">Company</label>
            <input id="f-company" name="company" type="text" placeholder="Organisation name" />
          </div>
          <div class="field">
            <label for="f-email">Email</label>
            <input id="f-email" name="email" type="email" placeholder="name@company.com" required />
          </div>
          <div class="field">
            <label for="f-phone">Phone</label>
            <input id="f-phone" name="phone" type="tel" placeholder="Contact number" />
          </div>

          <div class="field">
            <label for="f-requirement">Requirement</label>
            <select id="f-requirement" name="requirement">
              <option value="">Select a category</option>
              <option>Customised corporate gifts</option>
              <option>Premium executive gifts</option>
              <option>Employee welcome / joining kits</option>
              <option>Employee appreciation gifts</option>
              <option>Client &amp; VIP gifting</option>
              <option>Festival &amp; occasion gifting</option>
              <option>Corporate gift hampers</option>
              <option>Promotional &amp; branded merchandise</option>
              <option>Customised stationery</option>
              <option>Travel &amp; lifestyle gifts</option>
              <option>Tech &amp; utility products</option>
              <option>Sustainable &amp; eco-friendly gifts</option>
              <option>Luxury &amp; premium collections</option>
              <option>Event &amp; conference giveaways</option>
              <option>Product launch kits</option>
              <option>Lanyards &amp; ID cards</option>
              <option>Trophies &amp; awards</option>
              <option>Name plates &amp; signage</option>
              <option>Bulk corporate gifting</option>
              <option>Something else</option>
            </select>
          </div>
          <div class="field">
            <label for="f-quantity">Approximate Quantity</label>
            <input id="f-quantity" name="quantity" type="text" placeholder="e.g. 250 units" />
          </div>

          <div class="field full">
            <label for="f-timeline">Required By</label>
            <input id="f-timeline" name="timeline" type="text" placeholder="Delivery date or occasion" />
          </div>

          <div class="field full">
            <label for="f-message">Details</label>
            <textarea id="f-message" name="message" placeholder="Occasion, recipients, budget range, branding requirements, delivery locations..."></textarea>
          </div>

          <div class="field full">
            <button class="btn btn-primary" type="submit">Send Enquiry</button>
            <p class="form-note" id="form-status">
              We usually respond within one working day. You can also write to us directly at
              <a href="mailto:<?= contact('email_primary') ?>"><?= contact('email_primary') ?></a>.
            </p>
          </div>
        </form>
      </div>

      <div class="reveal d1">
        <div class="card" style="padding:36px 32px">
          <span class="eyebrow"><?= t('contact.label3') ?></span>
          <h3 style="margin-bottom:26px">Contact details</h3>

          <div class="detail-list">
            <div class="detail">
              <div>
                <div class="k">Founder</div>
                <div class="v"><?= contact('founder') ?></div>
              </div>
            </div>
            <div class="detail">
              <div>
                <div class="k">Email</div>
                <div class="v">
                  <a href="mailto:<?= contact('email_primary') ?>"><?= contact('email_primary') ?></a><br />
                  <a href="mailto:<?= contact('email_secondary') ?>"><?= contact('email_secondary') ?></a>
                </div>
              </div>
            </div>
            <div class="detail">
              <div>
                <div class="k">Phone</div>
                <div class="v">
                  <a href="tel:<?= tel_href(contact_raw('phone_primary')) ?>"><?= contact('phone_primary') ?></a><br />
                  <a href="tel:<?= tel_href(contact_raw('phone_secondary')) ?>"><?= contact('phone_secondary') ?></a>
                </div>
              </div>
            </div>
            <div class="detail">
              <div>
                <div class="k">Office</div>
                <div class="v">
                  <?= contact('address_line1') ?><br />
                  <?= contact('address_line2') ?>
                </div>
              </div>
            </div>
          </div>

          <div class="divider" style="width:100%;margin:30px 0"></div>

          <div class="k" style="font-size:10.5px;letter-spacing:.2em;text-transform:uppercase;color:var(--bronze-deep);margin-bottom:14px">
            What We Cover
          </div>
          <ul class="tick-list">
            <li>Corporate &amp; customised gifting</li>
            <li>Branded merchandise &amp; welcome kits</li>
            <li>Lanyards, ID cards &amp; name plates</li>
            <li>Trophies, awards &amp; recognition</li>
            <li>Bulk gifting &amp; multi-location delivery</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section-tint">
    <div class="wrap">
      <div class="section-head center reveal">
        <span class="eyebrow center"><?= t('contact.label4') ?></span>
        <h2><?= t('contact.heading2') ?></h2>
      </div>
      <div class="grid grid-4">
        <div class="card step reveal">
          <span class="num">01</span>
          <h4>You Share the Brief</h4>
          <p>Occasion, audience, quantity, budget and timeline.</p>
        </div>
        <div class="card step reveal d1">
          <span class="num">02</span>
          <h4>We Propose Options</h4>
          <p>Curated products and combinations with branding suggestions.</p>
        </div>
        <div class="card step reveal d2">
          <span class="num">03</span>
          <h4>You Approve</h4>
          <p>Samples, mock-ups and final costing confirmed before production.</p>
        </div>
        <div class="card step reveal d3">
          <span class="num">04</span>
          <h4>We Deliver</h4>
          <p>Branded, quality-checked, packed and dispatched on schedule.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-band">
    <div class="wrap-narrow reveal">
      <img class="cta-logo" src="/assets/img/logo-full.png<?= '?v=' . ASSET_V ?>" alt="J&amp;Ko Ventures — Global Vision" width="960" height="960" />
      <p class="tagline" style="color:var(--bronze);letter-spacing:.14em;text-transform:uppercase;font-size:11px;margin-top:10px">
        Corporate Gifting &middot; Customised Gifts &middot; Branded Merchandise &middot; Premium Gift Solutions
      </p>
      <div class="divider center"></div>
      <p>Connect with us today to discuss your gifting requirements.</p>
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
