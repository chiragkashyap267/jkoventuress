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

## Adding photography

Product sections currently use gold geometric placeholders — the
`<div class="split-media">` blocks containing a `<span class="glyph">`.

To use a real photo, replace the inner span with an image:

```html
<div class="split-media">
  <img src="assets/img/hampers.jpg" alt="Curated corporate gift hamper" />
</div>
```

Add this to `assets/css/style.css` so photos fill the frame:

```css
.split-media img { width: 100%; height: 100%; object-fit: cover; }
.split-media:has(img)::before { display: none; }
```

Put files in `assets/img/`. Export at roughly 1200×1000, compressed, and
prefer `.webp` where possible. Always write a real `alt` description.

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
