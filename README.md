# CyberCraft website (www.cybercraft.biz)

Corporate website for **CyberCraft Pvt. Ltd.**, *An Innovation Technology Company*, with a built-in content dashboard. It is built on the same technology as the b2cloud.io site: plain PHP 8.1+ and MySQL, with no frameworks or Composer packages, so it runs on any cPanel hosting.

**Install:** follow [INSTALL.txt](INSTALL.txt) step by step.

## What's in it

**Public site**
- **Home:** Run. Secure. Invent. hero, numbers band, the three pillar panels, industries, service tabs, products, standards strip, client wall, case studies, CEO quote, offices, why CyberCraft, careers band
- **What we do:** an overview page plus one page per pillar: Managed Services Provider (with CyberCraft Care plans), Cyber Security Compliance & Audit (with standards by region), New Inventions & Horizons (Adapt · Innovate · Improvise), and Supporting services
- **Services:** all services grouped by pillar, plus one page per service
- **Industries:** an overview page plus one page per industry, showing all three pillars applied to it
- **Products:** CyberCraft Care, Secure, Horizons, CyberERP, b2cloud.io
- **Clients:** grouped by country, plus case studies
- **Company** (story, timeline, CEO message, vision, mission, values, offices, partnerships), **Careers**, **FAQ**
- **Contact:** a contact form that routes each enquiry to the right team mailbox (managed services, compliance & audit, Horizons, sales, partners or careers)
- **Also included:** site search, privacy, terms, 404, `sitemap.xml`, `robots.txt`

**Dashboard (`/admin`)**
- **Messages:** inbox with country and routing, status, search, CSV export and email alerts
- **Page text:** every heading and paragraph on the site
- **Content:** pillars, services, Care plans, industries, products, clients, case studies, standards, why-CyberCraft reasons, engagement steps, FAQs, offices
- **Settings:** site details, all team email addresses, notification routing, phone and WhatsApp, social links, client-login button, announcement bar, numbers band, sample badges, animations
- **System:** users and roles (Administrator / Editor), activity log

**Sample content:** the 18 clients and 4 case studies are fictitious placeholders and are marked "Sample" on the site. The dashboard home shows how many are left to replace.

## Folder layout

```
app/        PHP code, templates, schema (keep OUT of public_html)
public/     web root: index.php, .htaccess, assets (logos, CSS, JS)
database/   cybercraft.sql: optional import file (tables + default content)
tools/      dev-router.php (local server) and build-zip.sh (upload package)
assets/     brand files: logos (SVG), sample client logos, original card scan
docs/       static design drafts
PROFILE.md  full company profile text
.cpanel.yml deployment recipe for cPanel Git Version Control
```

## Local development

```bash
php -S 127.0.0.1:8080 -t public tools/dev-router.php
# then open http://127.0.0.1:8080/install.php
```

You need a local MySQL or MariaDB database. To build the upload package:

```bash
sh tools/build-zip.sh   # creates build/cybercraft-website.zip
```

## Security
Inherited from the b2cloud.io codebase:
- Passwords hashed with PHP `password_hash`; sessions are HTTP-only and SameSite, regenerated on sign-in, and expire after 2 hours idle
- CSRF tokens on every form; sign-in is limited to 5 failed attempts per 15 minutes per IP
- All database access uses prepared statements; all output is escaped
- The contact form has a honeypot, a minimum fill time and a per-IP hourly limit; email headers are sanitised
- `app/` sits outside the web root (or is blocked by `.htaccess`); the dashboard sends `noindex` and `no-store` headers
