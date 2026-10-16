"""Generates the default IT illustrations in public/assets/img/scenes/ (flat corporate style, brand palette).
Replace any of them with real photos from the dashboard (image fields)."""
import os, random
OUT = os.path.join(os.path.dirname(__file__), '..', 'public', 'assets', 'img', 'scenes')
NAVY, BLUE, SKY, PALE, TEAL, AMBER, INK = '#0B1B3A', '#1F4FA8', '#3B7DD8', '#DCE8FA', '#0E9AA7', '#F59E0B', '#14213D'
W, H = 800, 560

def svg(name, body, bg='#EEF3FA'):
    with open(os.path.join(OUT, name), 'w') as f:
        f.write(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W} {H}" role="img">'
                f'<rect width="{W}" height="{H}" fill="{bg}"/>{body}</svg>\n')

def monitor(x, y, w, h, screen, stand=True):
    s = f'<rect x="{x}" y="{y}" width="{w}" height="{h}" rx="10" fill="{NAVY}"/>'
    s += f'<rect x="{x+8}" y="{y+8}" width="{w-16}" height="{h-16}" rx="5" fill="#0F2A57"/>'
    s += screen(x + 8, y + 8, w - 16, h - 16)
    if stand:
        s += f'<rect x="{x+w/2-8}" y="{y+h}" width="16" height="26" fill="#9AA9C2"/><rect x="{x+w/2-44}" y="{y+h+24}" width="88" height="8" rx="4" fill="#9AA9C2"/>'
    return s

def dash(x, y, w, h):
    r = random.Random(int(x * 7 + y))
    s = f'<rect x="{x+12}" y="{y+12}" width="{w*0.38}" height="10" rx="5" fill="{SKY}" opacity=".7"/>'
    pts = ' '.join(f'{x+14+i*(w-28)/11:.0f},{y+h*0.75 - r.random()*h*0.35:.0f}' for i in range(12))
    s += f'<polyline points="{pts}" fill="none" stroke="#5FD3B4" stroke-width="3"/>'
    for i in range(4):
        bh = 10 + r.random() * h * 0.25
        s += f'<rect x="{x+w*0.62+i*16}" y="{y+34+h*0.3-bh}" width="10" height="{bh:.0f}" fill="{SKY}" opacity=".8"/>'
    for i in range(3):
        c = ['#5FD3B4', '#5FD3B4', AMBER][i]
        s += f'<circle cx="{x+20+i*22}" cy="{y+h-16}" r="6" fill="{c}"/>'
    return s

def code(x, y, w, h):
    r = random.Random(int(x + y))
    s = ''
    for i in range(int((h - 20) / 16)):
        ind = r.choice([0, 0, 16, 32])
        s += f'<rect x="{x+14+ind}" y="{y+14+i*16}" width="{r.randint(40, int(w*0.6))}" height="7" rx="3.5" fill="{r.choice([SKY, "#5FD3B4", "#9AA9C2", AMBER])}" opacity=".85"/>'
    return s

def shield_screen(x, y, w, h):
    cx, cy = x + w * 0.32, y + h * 0.5
    s = f'<path d="M{cx} {cy-58} l46 18 v34 c0 32-20 52-46 62 c-26-10-46-30-46-62 v-34z" fill="{TEAL}"/>'
    s += f'<path d="M{cx-18} {cy+2} l12 12 l26-28" fill="none" stroke="#fff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>'
    for i in range(5):
        c = ['#5FD3B4', '#5FD3B4', AMBER, '#5FD3B4', '#F87171'][i]
        s += f'<circle cx="{x+w*0.62}" cy="{y+26+i*26}" r="5" fill="{c}"/><rect x="{x+w*0.62+12}" y="{y+22+i*26}" width="{w*0.28}" height="8" rx="4" fill="#9AA9C2" opacity=".7"/>'
    return s

def person(x, y, shirt=BLUE, headset=False):
    s = f'<path d="M{x-42} {y+120} q0-70 42-70 q42 0 42 70z" fill="{shirt}"/>'
    s += f'<circle cx="{x}" cy="{y+22}" r="26" fill="#C98E6B"/><path d="M{x-26} {y+18} q2-30 26-30 q26 0 26 30 q-8-14-26-14 q-18 0-26 14z" fill="#2B2B2B"/>'
    if headset:
        s += f'<path d="M{x-28} {y+20} q0-36 28-36 q28 0 28 36" fill="none" stroke="#2B2B2B" stroke-width="5"/><rect x="{x-34}" y="{y+14}" width="10" height="18" rx="4" fill="#2B2B2B"/><path d="M{x-29} {y+32} q4 18 22 18" fill="none" stroke="#2B2B2B" stroke-width="3"/>'
    return s

def desk(y):
    return f'<rect x="80" y="{y}" width="640" height="18" rx="6" fill="#B9C6DA"/><rect x="110" y="{y+18}" width="14" height="{H-y-18}" fill="#9AA9C2"/><rect x="676" y="{y+18}" width="14" height="{H-y-18}" fill="#9AA9C2"/>'

# 1. Managed IT / NOC support desk
random.seed(1)
b = f'<rect x="120" y="40" width="560" height="190" rx="14" fill="{NAVY}"/>'
for i, (nx, ny) in enumerate([(200, 110), (300, 80), (400, 135), (500, 90), (600, 150), (340, 180), (520, 190)]):
    b += f'<circle cx="{nx}" cy="{ny}" r="9" fill="{["#5FD3B4", SKY, "#5FD3B4", AMBER, SKY, "#5FD3B4", SKY][i]}"/>'
b += f'<path d="M200 110 L300 80 L400 135 L500 90 L600 150 M300 80 L340 180 L400 135 M500 90 L520 190 L600 150" fill="none" stroke="{SKY}" stroke-opacity=".6" stroke-width="2"/>'
b += f'<rect x="140" y="58" width="120" height="10" rx="5" fill="{SKY}" opacity=".7"/><text x="660" y="72" text-anchor="end" font-family="Arial" font-size="14" font-weight="700" fill="#5FD3B4">ALL SYSTEMS NORMAL</text>'
b += desk(430)
b += monitor(170, 270, 220, 140, dash) + monitor(410, 270, 220, 140, code)
b += person(400, 300, BLUE, True).replace('y+120', 'y+120')
b += f'<rect x="300" y="414" width="200" height="16" rx="4" fill="{NAVY}"/><rect x="560" y="400" width="40" height="30" rx="6" fill="{AMBER}"/>'
svg('managed-it.svg', b)

# 2. Data center: row of server racks
b = f'<rect y="420" width="{W}" height="{H-420}" fill="#D3DCEA"/>'
for i in range(0, W, 80):
    b += f'<line x1="{i}" y1="420" x2="{i - 60}" y2="{H}" stroke="#C3CDDD"/>'
b += f'<rect x="40" y="40" width="720" height="22" rx="6" fill="#9AA9C2"/>'
for c in range(6):
    b += f'<path d="M{90+c*120} 62 v40" stroke="{BLUE}" stroke-width="4"/><path d="M{110+c*120} 62 v40" stroke="{TEAL}" stroke-width="4"/>'
r = random.Random(3)
for k in range(6):
    x = 50 + k * 120
    b += f'<rect x="{x}" y="100" width="100" height="320" rx="6" fill="{NAVY}"/><rect x="{x+6}" y="106" width="88" height="308" rx="3" fill="#13305F"/>'
    for u in range(14):
        yy = 112 + u * 21.5
        b += f'<rect x="{x+10}" y="{yy}" width="80" height="16" rx="2" fill="#1C3D74"/>'
        for l in range(3):
            if r.random() < 0.7:
                b += f'<circle cx="{x+18+l*9}" cy="{yy+8}" r="2.6" fill="{r.choice(["#5FD3B4", "#5FD3B4", SKY, AMBER])}"/>'
        b += f'<rect x="{x+50}" y="{yy+6}" width="32" height="4" rx="2" fill="#2E5596"/>'
svg('data-center.svg', b)

# 3. Security operations (SOC)
b = desk(430)
b += monitor(110, 70, 580, 300, shield_screen, stand=False)
b += f'<rect x="390" y="370" width="20" height="60" fill="#9AA9C2"/>'
b += f'<rect x="480" y="90" width="190" height="120" rx="8" fill="#123766"/>'
for i in range(6):
    b += f'<rect x="496" y="{106+i*16}" width="{60+((i*37)%100)}" height="7" rx="3.5" fill="{["#5FD3B4", SKY, AMBER, "#5FD3B4", SKY, "#F87171"][i]}" opacity=".85"/>'
b += f'<g transform="translate(600 300)"><rect x="-40" y="-20" width="80" height="62" rx="10" fill="{AMBER}"/><path d="M-24 -20 v-18 a24 24 0 0 1 48 0 v18" fill="none" stroke="{AMBER}" stroke-width="10"/><circle cy="8" r="9" fill="{NAVY}"/><rect x="-4" y="8" width="8" height="18" fill="{NAVY}"/></g>'
b += person(250, 330, NAVY, True)
svg('cyber-security.svg', b)

# 4. Audit & compliance
b = f'<rect x="150" y="60" width="300" height="420" rx="16" fill="#fff" stroke="#C3CDDD" stroke-width="3"/><rect x="250" y="44" width="100" height="36" rx="10" fill="{NAVY}"/>'
for i in range(6):
    y = 120 + i * 56
    ok = i != 4
    b += f'<rect x="185" y="{y}" width="34" height="34" rx="8" fill="{"#E3F6EF" if ok else "#FEF3C7"}"/>'
    b += (f'<path d="M193 {y+17} l7 7 l13-14" fill="none" stroke="#0F9D6E" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>' if ok
          else f'<rect x="200" y="{y+8}" width="4" height="13" rx="2" fill="{AMBER}"/><circle cx="202" cy="{y+26}" r="2.5" fill="{AMBER}"/>')
    b += f'<rect x="234" y="{y+6}" width="{170 - (i*23)%70}" height="9" rx="4.5" fill="#9AA9C2"/><rect x="234" y="{y+21}" width="{110 - (i*17)%40}" height="7" rx="3.5" fill="#C3CDDD"/>'
b += f'<g transform="translate(560 220)"><rect x="-130" y="-110" width="260" height="190" rx="12" fill="#fff" stroke="{BLUE}" stroke-width="4"/><rect x="-112" y="-92" width="224" height="154" rx="6" fill="none" stroke="{PALE}" stroke-width="3"/>'
b += f'<text y="-50" text-anchor="middle" font-family="Arial" font-size="15" font-weight="700" fill="{INK}">CERTIFICATE</text><text y="-14" text-anchor="middle" font-family="Arial" font-size="30" font-weight="800" fill="{BLUE}">ISO 27001</text><rect x="-70" y="6" width="140" height="7" rx="3.5" fill="#C3CDDD"/><rect x="-50" y="22" width="100" height="7" rx="3.5" fill="#C3CDDD"/>'
b += f'<circle cx="80" cy="70" r="30" fill="{AMBER}"/><circle cx="80" cy="70" r="20" fill="none" stroke="#fff" stroke-width="3"/><path d="M62 96 l-10 34 l18-10 l10 18 l6-30z M98 96 l10 34 l-18-10 l-10 18 l-6-30z" fill="{AMBER}"/></g>'
b += f'<g transform="translate(470 420)"><circle r="44" fill="none" stroke="{NAVY}" stroke-width="12"/><circle r="36" fill="#DCE8FA" opacity=".6"/><rect x="30" y="30" width="18" height="60" rx="8" transform="rotate(-45 30 30)" fill="{NAVY}"/></g>'
svg('audit-compliance.svg', b)

# 5. Network & telecom infrastructure
b = f'<rect x="120" y="250" width="560" height="70" rx="10" fill="{NAVY}"/>'
for p in range(16):
    b += f'<rect x="{150+p*30}" y="270" width="20" height="16" rx="2" fill="#1C3D74"/><circle cx="{160+p*30}" cy="298" r="3" fill="{"#5FD3B4" if p%5 else AMBER}"/>'
cols = [BLUE, TEAL, AMBER, SKY, '#5FD3B4', BLUE]
for i in range(6):
    sx = 160 + i * 90
    b += f'<path d="M{sx} 286 C {sx} 380, {120+i*110} 380, {120+i*110} 470" fill="none" stroke="{cols[i]}" stroke-width="6" stroke-linecap="round"/>'
    b += f'<rect x="{100+i*110}" y="470" width="44" height="34" rx="6" fill="#fff" stroke="#C3CDDD" stroke-width="2"/><rect x="{108+i*110}" y="478" width="28" height="16" rx="2" fill="{PALE}"/>'
b += f'<path d="M400 250 V170" stroke="#9AA9C2" stroke-width="8"/><rect x="340" y="120" width="120" height="56" rx="12" fill="#fff" stroke="#C3CDDD" stroke-width="3"/><circle cx="370" cy="148" r="6" fill="#5FD3B4"/><circle cx="392" cy="148" r="6" fill="#5FD3B4"/>'
for k in range(3):
    b += f'<path d="M{400-40-k*26} {100-k*18} q{40+k*26} {-30-k*14} {80+k*52} 0" fill="none" stroke="{SKY}" stroke-width="7" stroke-linecap="round" opacity="{1-k*0.25}"/>'
b += f'<g transform="translate(650 120)"><path d="M0 0 L-30 120 M0 0 L30 120 M-20 80 h40 M-12 45 h24" stroke="{NAVY}" stroke-width="6" fill="none"/><circle r="10" fill="{AMBER}"/><path d="M-30 -20 q30 -24 60 0 M-44 -34 q44 -34 88 0" stroke="{AMBER}" stroke-width="5" fill="none"/></g>'
svg('network-infrastructure.svg', b)

# 6. Cloud & software
b = f'<g transform="translate(400 140)"><circle cx="-70" cy="10" r="56" fill="#fff"/><circle cx="0" cy="-20" r="74" fill="#fff"/><circle cx="76" cy="12" r="52" fill="#fff"/><rect x="-126" y="10" width="254" height="56" fill="#fff"/></g>'
b += f'<text x="400" y="160" text-anchor="middle" font-family="Arial" font-size="30" font-weight="800" fill="{BLUE}">cloud</text>'
for i, x in enumerate([250, 400, 550]):
    b += f'<path d="M{x} 210 V270" stroke="{SKY}" stroke-width="4" stroke-dasharray="8 8"/>'
b += f'<rect x="170" y="270" width="460" height="230" rx="14" fill="{NAVY}"/><rect x="186" y="286" width="428" height="198" rx="6" fill="#0F2A57"/>' + code(186, 286, 428, 198)
b += f'<path d="M120 500 h560 l-40 24 h-480z" fill="#B9C6DA"/>'
svg('cloud-software.svg', b)

# 6b. Software & ERP: a desktop ERP dashboard and a laptop with an app
def erp(x, y, w, h):
    s = f'<rect x="{x}" y="{y}" width="{w*0.2:.0f}" height="{h}" fill="{NAVY}"/>'
    for i in range(6):
        s += f'<rect x="{x+10}" y="{y+16+i*22}" width="{w*0.2-20:.0f}" height="8" rx="4" fill="{SKY if i == 1 else "#5A6B8C"}"/>'
    cx = x + w * 0.2 + 12
    cw = w * 0.8 - 24
    for i, c in enumerate([SKY, "#5FD3B4", AMBER]):
        s += f'<rect x="{cx+i*(cw/3):.0f}" y="{y+12}" width="{cw/3-8:.0f}" height="34" rx="5" fill="#173563"/><rect x="{cx+8+i*(cw/3):.0f}" y="{y+22}" width="{cw/6:.0f}" height="6" rx="3" fill="#9AA9C2"/><rect x="{cx+8+i*(cw/3):.0f}" y="{y+32}" width="{cw/9:.0f}" height="8" rx="4" fill="{c}"/>'
    r = random.Random(7)
    for i in range(8):
        bh = 14 + r.random() * (h * 0.3)
        s += f'<rect x="{cx+6+i*(cw*0.5/8):.0f}" y="{y+h*0.62-bh:.0f}" width="{cw*0.5/8-6:.0f}" height="{bh:.0f}" rx="2" fill="{SKY}"/>'
    for i in range(4):
        s += f'<rect x="{cx+cw*0.56:.0f}" y="{y+58+i*18}" width="{cw*0.44:.0f}" height="12" rx="3" fill="{"#173563" if i % 2 else "#1C3D74"}"/>'
    for i in range(3):
        s += f'<rect x="{cx}" y="{y+h*0.68+i*14:.0f}" width="{cw:.0f}" height="9" rx="3" fill="{"#173563" if i % 2 else "#1C3D74"}"/>'
    return s
b = desk(440)
b += monitor(150, 90, 400, 290, erp)
b += f'<rect x="470" y="300" width="230" height="140" rx="8" fill="{NAVY}"/><rect x="480" y="310" width="210" height="120" rx="4" fill="#0F2A57"/>'
b += code(480, 310, 210, 120)
b += f'<path d="M450 440 L720 440 L700 452 L470 452 Z" fill="#9AA9C2"/>'
b += f'<rect x="96" y="402" width="40" height="38" rx="4" fill="{TEAL}"/><rect x="100" y="380" width="32" height="24" rx="3" fill="#fff" stroke="#9AA9C2"/>'
svg('software-erp.svg', b)

# 7. Solar, wind, automation & IoT
import math
b = f'<rect y="430" width="{W}" height="{H-430}" fill="#D3E7D8"/>'
b += f'<circle cx="660" cy="100" r="50" fill="{AMBER}"/>'
for k in range(12):
    a = k * math.pi / 6
    b += f'<line x1="{660+math.cos(a)*62:.0f}" y1="{100+math.sin(a)*62:.0f}" x2="{660+math.cos(a)*82:.0f}" y2="{100+math.sin(a)*82:.0f}" stroke="{AMBER}" stroke-width="6" stroke-linecap="round"/>'
# ground-mounted solar array: three rows of tilted panels
for row in range(3):
    y0 = 330 + row * 46
    for c in range(5):
        x0 = 60 + c * 78 + row * 18
        b += f'<path d="M{x0} {y0+40} L{x0+14} {y0} L{x0+84} {y0} L{x0+70} {y0+40} Z" fill="{BLUE}" stroke="#fff" stroke-width="2"/>'
        b += f'<path d="M{x0+7} {y0+20} L{x0+77} {y0+20} M{x0+38} {y0} L{x0+32} {y0+40}" stroke="#8CB4EE" stroke-width="1.5"/>'
        b += f'<rect x="{x0+30}" y="{y0+40}" width="4" height="10" fill="#9AA9C2"/>'
# wind turbine
tx, ty = 560, 170
b += f'<path d="M{tx-7} 470 L{tx-3} {ty} h6 L{tx+7} 470z" fill="#C3CDDD"/>'
for ang in (90, 210, 330):
    rad = math.radians(ang)
    ex, ey = tx + math.cos(rad) * 110, ty - math.sin(rad) * 110
    px, py = -math.sin(rad) * 9, -math.cos(rad) * 9
    b += f'<path d="M{tx+px:.0f} {ty+py:.0f} L{ex:.0f} {ey:.0f} L{tx-px:.0f} {ty-py:.0f} Z" fill="#fff" stroke="#9AA9C2" stroke-width="2"/>'
b += f'<circle cx="{tx}" cy="{ty}" r="11" fill="{NAVY}"/>'
# IoT sensor with signal
b += f'<g transform="translate(690 400)"><rect x="-6" y="0" width="12" height="70" fill="#9AA9C2"/><rect x="-30" y="-36" width="60" height="44" rx="10" fill="{TEAL}"/><circle cy="-14" r="9" fill="#fff"/>'
b += f'<path d="M-42 -50 q42 -30 84 0 M-56 -64 q56 -40 112 0" stroke="{TEAL}" stroke-width="4" fill="none"/></g>'
# robot arm (industrial automation)
b += f'<g transform="translate(110 250)" stroke-linecap="round"><rect x="-30" y="60" width="60" height="18" rx="4" fill="{NAVY}"/><path d="M0 60 L20 0 L80 -30" stroke="{AMBER}" stroke-width="16" fill="none"/><circle cx="20" r="11" fill="{NAVY}"/><circle cx="80" cy="-30" r="9" fill="{NAVY}"/><path d="M80 -30 l18 6 M80 -30 l14 -14" stroke="{NAVY}" stroke-width="6"/></g>'
svg('innovation.svg', b)

# 8. Hero composite: corporate managed services (desk + wall screen + racks)
b = f'<rect x="0" y="0" width="{W}" height="{H}" fill="#EEF3FA"/>'
r = random.Random(9)
for k in range(2):
    x = 30 + k * 96
    b += f'<rect x="{x}" y="120" width="84" height="300" rx="6" fill="{NAVY}"/>'
    for u in range(13):
        yy = 130 + u * 22
        b += f'<rect x="{x+8}" y="{yy}" width="68" height="16" rx="2" fill="#1C3D74"/><circle cx="{x+16}" cy="{yy+8}" r="2.6" fill="{r.choice(["#5FD3B4", SKY, AMBER])}"/>'
b += f'<rect x="250" y="50" width="510" height="230" rx="14" fill="{NAVY}"/>' + dash(266, 66, 230, 198) + shield_screen(506, 66, 240, 198)
b += desk(440)
b += monitor(300, 300, 200, 130, code, stand=False) + monitor(520, 300, 200, 130, dash, stand=False)
b += person(510, 330, BLUE, True)
svg('hero-managed-services.svg', b)
print('scenes written')
