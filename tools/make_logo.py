"""Builds refined CyberCraft logo SVGs from the original card logo.

Mark: glossy target-disc "C" with orbiting dots (geometry measured from the
original). Wordmark: heavy italic "CYBER" + "CRAFT", converted to outlines so
the SVGs render identically everywhere.
"""
import math, sys, os
from fontTools.ttLib import TTFont
from fontTools.pens.svgPathPen import SVGPathPen
from fontTools.pens.transformPen import TransformPen
from fontTools.pens.boundsPen import BoundsPen

FONT, OUT = sys.argv[1], sys.argv[2]
font = TTFont(FONT)
gs, cmap = font.getGlyphSet(), font.getBestCmap()
UPM = font["head"].unitsPerEm
SKEW = math.tan(math.radians(12))


def text_path(text, size, x, y, tracking=0.0):
    """Outline `text` with baseline at (x, y); returns (path_d, advance_width)."""
    s = size / UPM
    pen = SVGPathPen(gs)
    cx = 0.0
    for ch in text:
        g = cmap[ord(ch)]
        # font y-up -> svg y-down, plus italic skew
        t = (s, 0, SKEW * s, -s, x + cx, y)
        gs[g].draw(TransformPen(pen, t))
        cx += gs[g].width * s + tracking * size
    return pen.getCommands(), cx - tracking * size


# ---- palette -------------------------------------------------------------
NAVY, BLUE, SKY, PALE = "#14213D", "#1F4FA8", "#3B7DD8", "#8DB5EC"


def defs(p):
    return f"""<defs>
    <radialGradient id="{p}o" cx="38%" cy="30%" r="80%"><stop offset="0" stop-color="#4C86DA"/><stop offset=".55" stop-color="{BLUE}"/><stop offset="1" stop-color="#173A80"/></radialGradient>
    <radialGradient id="{p}i" cx="40%" cy="32%" r="75%"><stop offset="0" stop-color="#A9C8F2"/><stop offset="1" stop-color="#5A8FDA"/></radialGradient>
    <linearGradient id="{p}d" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#5B8FDB"/><stop offset="1" stop-color="#2A5CB8"/></linearGradient>
    <linearGradient id="{p}g" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fff" stop-opacity=".45"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></linearGradient>
    <linearGradient id="{p}w" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="#1F4FA8"/><stop offset="1" stop-color="#3B7DD8"/></linearGradient>
  </defs>"""


def mark(p, cx, cy, R, ring="#FFFFFF"):
    """The emblem centred at (cx, cy) with main-disc radius R."""
    dots = [(-0.30, -1.58, .36), (-0.90, -0.92, .24), (1.18, 0.64, .24),
            (1.76, 0.92, .33), (-1.10, 1.42, .33)]
    out = [f'<circle cx="{cx+dx*R:.1f}" cy="{cy+dy*R:.1f}" r="{r*R:.1f}" fill="url(#{p}d)"/>' for dx, dy, r in dots]
    # C arc: open on the right
    rc, a = .42 * R, math.radians(38)
    x1, y1 = cx + rc * math.cos(a), cy - rc * math.sin(a)
    x2, y2 = cx + rc * math.cos(a), cy + rc * math.sin(a)
    out += [
        f'<circle cx="{cx}" cy="{cy}" r="{R}" fill="url(#{p}o)"/>',
        f'<circle cx="{cx}" cy="{cy}" r="{.80*R:.1f}" fill="none" stroke="{ring}" stroke-width="{.055*R:.1f}"/>',
        f'<circle cx="{cx}" cy="{cy}" r="{.72*R:.1f}" fill="url(#{p}i)"/>',
        f'<path d="M{x1:.1f} {y1:.1f}A{rc:.1f} {rc:.1f} 0 1 0 {x2:.1f} {y2:.1f}" fill="none" stroke="{BLUE}" stroke-width="{.17*R:.1f}" stroke-linecap="round"/>',
        f'<circle cx="{cx}" cy="{cy}" r="{.20*R:.1f}" fill="#C9DCF6"/>',
        # gloss on the upper half of the disc
        f'<path d="M{cx-.93*R:.1f} {cy-.05*R:.1f}A{.93*R:.1f} {.93*R:.1f} 0 0 1 {cx+.93*R:.1f} {cy-.05*R:.1f}C{cx+.5*R:.1f} {cy-.22*R:.1f} {cx-.5*R:.1f} {cy-.22*R:.1f} {cx-.93*R:.1f} {cy-.05*R:.1f}Z" fill="url(#{p}g)"/>',
    ]
    return "\n  ".join(out)


def wordmark(x, y, size, c1, c2, tag=None, tagc="#475569"):
    d1, w1 = text_path("CYBER", size, x, y, .02)
    d2, w2 = text_path("CRAFT", size, x + w1 + .06 * size, y, .02)
    parts = [f'<path d="{d1}" fill="{c1}"/>', f'<path d="{d2}" fill="{c2}"/>']
    total = w1 + .06 * size + w2
    if tag:
        tsize = size * .235
        d3, w3 = text_path(tag, tsize, x, y + size * .52, .16)
        # stretch tagline to wordmark width for a locked-up block
        sx = total / w3
        parts.append(f'<path d="{d3}" fill="{tagc}" transform="translate({x} 0) scale({sx:.4f} 1) translate({-x} 0)"/>')
    return "\n  ".join(parts), total


def svg(name, w, h, body, label):
    with open(os.path.join(OUT, name), "w") as f:
        f.write(f'<svg xmlns="http://www.w3.org/2000/svg" width="{w}" height="{h}" viewBox="0 0 {w} {h}" role="img" aria-label="{label}">\n  {body}\n</svg>\n')


LABEL = "CyberCraft — An Innovation Technology Company"
TAG = "AN INNOVATION TECHNOLOGY COMPANY"

# icon
svg("cybercraft-icon.svg", 240, 240, defs("a") + "\n  " + mark("a", 112, 128, 54), "CyberCraft")

# horizontal, colour + white
for v, c1, c2, tc, ring in [("color", NAVY, "url(#hw)", "#475569", "#FFFFFF"),
                             ("white", "#FFFFFF", "#7FB0F0", "#B8C7DD", "#FFFFFF")]:
    wm, tw = wordmark(236, 124, 82, c1, c2, TAG, tc)
    body = defs("h") + "\n  " + mark("h", 104, 114, 50, ring) + "\n  " + wm
    svg(f"cybercraft-logo-{v}.svg", int(236 + tw + 28), 230, body, LABEL)

# stacked (like the original card)
wm, tw = wordmark(40, 430, 100, NAVY, "url(#sw)", TAG)
W = int(tw + 80)
body = defs("s") + "\n  " + mark("s", W / 2 - 20, 175, 78) + "\n  " + wm
svg("cybercraft-logo-stacked.svg", W, 550, body, LABEL)
print("ok")
