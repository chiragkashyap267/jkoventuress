# J&Ko Ventures — website

Static multi-page site. No build step, no dependencies: the `.html` files are
served exactly as they are. The one dynamic piece is `form-handler.php`, which
needs PHP (Hostinger provides it).

## Files

```
index.html          Home — every topic, linking onward
about.html          Who we are, vision, mission
services.html       Full gifting catalogue (incl. lanyards, trophies, name plates)
occasions.html      Occasions and industries
approach.html       Process, quality, personalisation, sustainability
why-us.html         Why choose us
contact.html        Enquiry form + contact details
404.html            Not-found page
form-handler.php    Receives the enquiry form and emails it
.htaccess           Clean URLs, caching, security headers, log protection
robots.txt          Crawler rules
sitemap.xml         Page list for search engines
assets/css/style.css   All styling
assets/js/main.js      Nav, scroll reveals, form status
assets/img/            Logo mark and favicon (SVG)
```

## Updating the contact details

The placeholders are `hello@jkoventuress.com`, `+91 00000 00000` and
"Address line one, City, State – PIN".

1. **Email in the footer** appears on every page. Find and replace
   `hello@jkoventuress.com` across all `.html` files.
2. **Phone, address and business hours** live only in `contact.html`, in the
   "Contact details" card — search for `<div class="k">Phone</div>`.
3. **Where enquiries are delivered** is `$TO_ADDRESS` at the top of
   `form-handler.php`. Set `$SITE_DOMAIN` to the live domain too.

## The enquiry form

`contact.html` posts to `form-handler.php`, which validates the input, emails
it to `$TO_ADDRESS` and redirects back to `contact.html?status=...`. The
JavaScript turns that flag into a message above the form.

Statuses: `sent`, `missing`, `bademail`, `error`.

Spam is filtered two ways: a honeypot field that people never see, and a
timestamp check that rejects submissions completed in under three seconds.

Every enquiry is also appended to `enquiries.log` as a fallback in case mail
delivery fails. `.htaccess` blocks web access to that file. Set `$KEEP_LOG` to
`false` in `form-handler.php` to turn it off.

**If mail does not arrive:** PHP's `mail()` is often flagged as spam because
the message is not authenticated. The fix is to send over authenticated SMTP
instead — create the mailbox in Hostinger (Emails → Create), then use PHPMailer
with those SMTP credentials in place of the `mail()` call.

## Brand colours and the logo

Every colour on the site is sampled from the logo artwork — the page ground is
the logo's own background (`#c5b2a4`) so the emblem blends into the hero with
no visible edge, and gold accents use the artwork's ramp (`#784817` through
`#dda25e` to `#f8dbb1`).

All of it lives in the `:root` block at the top of `assets/css/style.css`.
There are two metal gradients: `--metal` fills (buttons, rules) and
`--metal-text` is the same metal shifted darker for type, because flat gold
text has none of the logo's bevel to separate it from a mid-tone background.

The hero logo animates with three slow loops — a float, a light sweep across
the metal, and a breathing glow. All of it stops under
`prefers-reduced-motion`. See `.hero-logo` in the stylesheet.

## Photography

The site ships with twelve stock photographs in `assets/img/photos/`, all under
licences allowing commercial use. Sources, photographers and licence terms are
listed in [IMAGE-CREDITS.md](IMAGE-CREDITS.md).

These are placeholders for real J&Ko Ventures product photography. To swap one
in, keep the same filename and 1200×1000 dimensions and replace the file — no
markup changes needed. Update the `alt` text if the subject changes, and keep
IMAGE-CREDITS.md accurate.

Photos appear in two places:

- `<div class="split-media has-photo">` — the large framed images beside text
- `<div class="card-media">` — thumbnails at the top of a category card

A light gold wash sits over every photo so stock imagery stays consistent with
the palette. If your own photography is already colour-matched, remove the
`.split-media.has-photo::after` and `.card-media::after` rules from
`assets/css/style.css`.

## Local preview

Opening the `.html` files directly works for everything except the form, which
needs PHP. To test the form locally with PHP installed:

```
php -S localhost:8000
```

Then visit `http://localhost:8000/contact.html`.

## Deploying

Hostinger hPanel → Advanced → GIT, pointed at this repository, branch `main`,
directory `public_html` (which must be empty before the first clone). Add the
webhook it shows to the GitHub repo's Settings → Webhooks so pushes deploy
automatically.
