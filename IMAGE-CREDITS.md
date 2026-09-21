# Image credits

## Brand assets

These are the client's own logo, not stock, and are generated from the supplied
artwork:

| File | Purpose |
|---|---|
| `assets/img/logo-full.jpg` | The complete lockup, shown in the home page hero |
| `assets/img/logo-mark.png` | Emblem only, used in the header and footer. Its edges are feathered in the PNG so it sits on any surface without showing a box |
| `assets/img/favicon.ico` | Browser tab icon (16/32/48px) |
| `assets/img/favicon-32.png` | Modern browser tab icon |
| `assets/img/apple-touch-icon.png` | Home-screen icon on iOS |

The site palette is sampled directly from that artwork: ground `#c5b2a4`, gold
ramp `#784817` → `#a0712b` → `#dda25e` → `#f8dbb1`. Those values are the
`:root` tokens in `assets/css/style.css`; change them there and the whole site
follows.

To regenerate these from new artwork, the crops are: emblem = a 1220×1220
square centred at (800, 614) in the 1600×1600 original.

# Photography credits

All photographs in `assets/img/photos/` are stock images published under
licences that permit commercial use without payment or permission. They are
placeholders: replace them with real J&Ko Ventures product photography as it
becomes available.

## Licences in use

**Unsplash License** — free for commercial and non-commercial use, no
permission needed, attribution appreciated but not required. Note: this covers
regular Unsplash photos only. Unsplash+ images (URLs containing
`premium_photo-`) require a paid subscription and none are used here.
<https://unsplash.com/license>

**Pexels License** — free for commercial and non-commercial use, no
attribution required. <https://www.pexels.com/license/>

Neither licence permits selling the unmodified photo itself, or using an
identifiable person to imply their endorsement. Normal website use is fine.

## The images

| File | Used on | Source | Photographer |
|---|---|---|---|
| `team-meeting.jpg` | Home — Who We Are | Unsplash | Dylan Gillis |
| `personalised-gifts.jpg` | Home — Personalisation | Pexels | Merve Cetin |
| `kraft-packaging.jpg` | Home — Sustainable Gifting | Unsplash | Mildlee |
| `premium-gift-boxes.jpg` | About — Who We Are | Pexels | Max Fischer |
| `curated-hampers.jpg` | Solutions — Curated Hampers | Unsplash | David Trinks |
| `launch-kit.jpg` | Occasions — Launches & Campaigns | Pexels | Ron Lach |
| `branded-stationery.jpg` | Approach — Brand Alignment | Unsplash | Marissa Grootes |
| `packaging-quality.jpg` | Approach — Quality | Pexels | cup-of-couple |
| `sustainable-packaging.jpg` | Approach — Sustainable Gifting | Unsplash | Ochir-Erdene Oyunmedeg |
| `lanyards-id-cards.jpg` | Home + Solutions — category card | Unsplash | jim |
| `trophies-awards.jpg` | Home + Solutions — category card | Unsplash | Ariel |
| `name-plates.jpg` | Home + Solutions — category card | Pexels | freestockpro |

## Why these particular images

Photos showing another company's branding were deliberately rejected, since a
visible third-party logo on a gifting site reads as a client reference the
business has not actually made. Images were also chosen to sit within the warm
white, gold and bronze palette rather than fight it.

## Replacing them

Each photo is 1200×1000 and already compressed. To swap one in, keep the same
filename and dimensions and drop the new file in place — no markup changes
needed. Update the `alt` text in the page if the subject changes, and update
this file so the credits stay accurate.

A light gold wash sits over every photo (`.split-media.has-photo::after` and
`.card-media::after` in `assets/css/style.css`) to keep photography consistent
with the palette. Remove those rules if your own photography is already
colour-matched.
