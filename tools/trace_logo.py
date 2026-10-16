"""Rebuild the CyberCraft logo from the original business-card photo.

The wordmark is traced directly from the photo (potrace), so the letter shapes
are the original ones. The emblem is redrawn as exact geometry from radii,
centres and colours measured on the photo. Colours are the measured ones with
the camera's exposure corrected (card background mapped back to white).

usage: python3 trace_logo.py original-card-logo.jpg tagline-font.ttf OUT_DIR
"""
import math, os, sys
import numpy as np
import potrace
from PIL import Image
from scipy import ndimage as nd
from fontTools.ttLib import TTFont
from fontTools.pens.svgPathPen import SVGPathPen
from fontTools.pens.transformPen import TransformPen

SRC, FONT, OUT = sys.argv[1:4]
img = np.array(Image.open(SRC).convert("RGB")).astype(float)

# ---------------------------------------------------------------- colours ---
C = dict(
    cyber="#2A3550",          # CYBER, dark slate navy
    craft_top="#407AB2",      # CRAFT above the gloss line
    craft_bot="#1E629C",      # CRAFT below the gloss line
    outer="#194988", outer_hi="#6D87BB",     # outer band and the dark inner band
    ring="#275291", ring_hi="#7388BE",       # the C ring
    light="#7E97CA", light_hi="#C3C8E0",     # light band and centre disc
    white="#F7F8FA",                         # the thin white ring
    dot_top="#6D8BC3", dot_ul="#6D8BC3", dot_r1="#3F75AF", dot_r2="#3472AD",
    dot_ll="#517FB3", dot_far="#304055",
)

# ------------------------------------------------------- emblem geometry ---
# measured on the photo, in photo pixels
CX, CY, R = 563.5, 402.5, 134.0
BANDS = dict(centre=32, ring=46, light=74, dark=93, white=104)  # outer radii
BAR = (CY - 9, CY + 8, CX + 64)          # horizontal bar of the C: y0, y1, x end
GLOSS = (CX, CY + 16 - 300.0, 300.0)     # highlight = disc ∩ this circle
DOTS = [  # cx, cy, r, colour key
    (528.1, 187.6, 51.5, "dot_top"), (447.3, 276.0, 32.8, "dot_ul"),
    (719.8, 477.3, 34.3, "dot_r1"), (798.3, 514.6, 44.4, "dot_r2"),
    (416.0, 582.0, 45.0, "dot_ll"),
]
FAR_DOT = (980.0, 323.0, 21.0, "dot_far")


def emblem(p, far=False):
    gx, gy, gr = GLOSS
    dots = DOTS + ([FAR_DOT] if far else [])
    out = [f'<circle cx="{x}" cy="{y}" r="{r}" fill="{C[k]}"/>' for x, y, r, k in dots]

    def disc_layers(hi):
        s = "_hi" if hi else ""
        b = BANDS
        y0, y1, xe = BAR
        return [
            f'<circle cx="{CX}" cy="{CY}" r="{R}" fill="{C["outer" + s]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{b["white"]}" fill="{C["white"]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{b["dark"]}" fill="{C["outer" + s]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{b["light"]}" fill="{C["light" + s]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{b["ring"]}" fill="{C["ring" + s]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{b["centre"]}" fill="{C["light" + s]}"/>',
        ]

    out += disc_layers(False)
    out += [f'<clipPath id="{p}gl"><circle cx="{gx}" cy="{gy:.1f}" r="{gr}"/></clipPath>',
            f'<g clip-path="url(#{p}gl)">'] + disc_layers(True) + ['</g>']
    y0, y1, xe = BAR
    out += [f'<rect x="{CX + BANDS["centre"] - 2}" y="{y0}" width="{xe - CX - BANDS["centre"] + 2}" height="{y1 - y0}" fill="{C["ring"]}"/>',
            f'<circle cx="{CX}" cy="{CY}" r="{BANDS["centre"]}" fill="none"/>']
    return "\n  ".join(out)


# ------------------------------------------------------ wordmark tracing ---
def trace_wordmark():
    x0, y0, x1, y1 = 205, 645, 1170, 790
    crop = img[y0:y1, x0:x1]
    bg = img[600:640, 1200:1300].reshape(-1, 3).mean(0)
    dist = np.sqrt(((crop - bg) ** 2).sum(-1))
    k = 4  # trace at 4x for smooth edges
    big = np.array(Image.fromarray(dist.astype(np.float32)).resize(
        (dist.shape[1] * k, dist.shape[0] * k), Image.BICUBIC))
    big = nd.gaussian_filter(big, 2.6)
    mask = big > 70
    mask = nd.binary_opening(mask, iterations=2)
    paths = potrace.Bitmap(~mask).trace(turdsize=60, turnpolicy=potrace.POTRACE_TURNPOLICY_MINORITY,
                                       alphamax=0.6, opticurve=True, opttolerance=0.6)

    def pt(p):
        return f"{x0 + p.x / k:.2f} {y0 + p.y / k:.2f}"

    cyber, craft = [], []
    for curve in paths:
        d = [f"M{pt(curve.start_point)}"]
        xs = [curve.start_point.x]
        for s in curve.segments:
            if s.is_corner:
                d.append(f"L{pt(s.c)}L{pt(s.end_point)}")
            else:
                d.append(f"C{pt(s.c1)} {pt(s.c2)} {pt(s.end_point)}")
            xs.append(s.end_point.x)
        d.append("Z")
        (cyber if x0 + np.mean(xs) / k < 680 else craft).append("".join(d))
    return "".join(cyber), "".join(craft)


CYBER_D, CRAFT_D = trace_wordmark()
CRAFT_SPLIT_Y = 720  # gloss line through CRAFT, measured


def wordmark(p, cyber_fill=None, craft_top=None, craft_bot=None):
    ct, cb = craft_top or C["craft_top"], craft_bot or C["craft_bot"]
    return "\n  ".join([
        f'<linearGradient id="{p}cr" gradientUnits="userSpaceOnUse" x1="0" y1="660" x2="0" y2="776">'
        f'<stop offset="{(CRAFT_SPLIT_Y - 660) / 116:.3f}" stop-color="{ct}"/>'
        f'<stop offset="{(CRAFT_SPLIT_Y - 660) / 116:.3f}" stop-color="{cb}"/></linearGradient>',
        f'<path d="{CYBER_D}" fill="{cyber_fill or C["cyber"]}" fill-rule="evenodd"/>',
        f'<path d="{CRAFT_D}" fill="url(#{p}cr)" fill-rule="evenodd"/>',
    ])


# ----------------------------------------------------------------- tagline --
font = TTFont(FONT)
gs, cmap, UPM = font.getGlyphSet(), font.getBestCmap(), font["head"].unitsPerEm
SKEW = math.tan(math.radians(12))


def tagline(text, x, y, width, size, fill):
    s = size / UPM
    pen = SVGPathPen(gs)
    cx = 0.0
    for ch in text:
        g = cmap[ord(ch)]
        gs[g].draw(TransformPen(pen, (s, 0, SKEW * s, -s, x + cx, y)))
        cx += gs[g].width * s + .16 * size
    sx = width / (cx - .16 * size)
    return f'<path d="{pen.getCommands()}" fill="{fill}" transform="translate({x} 0) scale({sx:.4f} 1) translate({-x} 0)"/>'


# ------------------------------------------------------------------ output --
def svg(name, vb, body, label="CyberCraft — An Innovation Technology Company", w=None):
    x, y, W, H = vb
    w = w or W
    h = round(w * H / W)
    with open(os.path.join(OUT, name), "w") as f:
        f.write(f'<svg xmlns="http://www.w3.org/2000/svg" width="{w:.0f}" height="{h}" viewBox="{x} {y} {W} {H}" '
                f'role="img" aria-label="{label}">\n  {body}\n</svg>\n')


TAG = "AN INNOVATION TECHNOLOGY COMPANY"
WM_X0, WM_X1, WM_TOP, WM_BOT = 219, 1151, 660, 776

# 1. original stacked lockup, exactly as on the card (with the far dot)
svg("cybercraft-logo-stacked.svg", (190, 120, 990, 690),
    emblem("s", far=True) + "\n  " + wordmark("s"), w=640)

# 2. stacked with tagline
svg("cybercraft-logo-stacked-tagline.svg", (190, 120, 990, 760),
    emblem("t", far=True) + "\n  " + wordmark("t") + "\n  "
    + tagline(TAG, WM_X0 + 4, WM_BOT + 50, WM_X1 - WM_X0 - 8, 30, "#475569"), w=640)

# 3. horizontal lockup: emblem left, wordmark + tagline right
EB = (366, 131, 482, 501)  # emblem bounding box (dots included), photo coords
sc = 0.56
gx = 30 + EB[2] * sc + 40          # wordmark left edge
top = 160 - 166 / 2                # wordmark + tagline block, centred at y=160
body = (f'<g transform="translate(30 {160 - EB[3] * sc / 2:.1f}) scale({sc}) translate({-EB[0]} {-EB[1]})">'
        + emblem("h") + "</g>\n  "
        f'<g transform="translate({gx - WM_X0:.1f} {top - WM_TOP:.1f})">' + wordmark("h") + "\n  "
        + tagline(TAG, WM_X0 + 3, WM_BOT + 46, WM_X1 - WM_X0 - 6, 27, "#475569") + "</g>")
svg("cybercraft-logo-color.svg", (0, 0, round(gx + (WM_X1 - WM_X0) + 30), 320), body, w=720)
# white-text version of the same lockup for dark backgrounds (emblem colours unchanged)
body_w = body.replace(f'fill="{C["cyber"]}"', 'fill="#FFFFFF"').replace('fill="#475569"', 'fill="#CBD5E1"').replace('id="hcr"', 'id="wcr"').replace('url(#hcr)', 'url(#wcr)')
svg("cybercraft-logo-white.svg", (0, 0, round(gx + (WM_X1 - WM_X0) + 30), 320), body_w, w=720)

# 4. icon: emblem with its five dots
svg("cybercraft-icon.svg", (360, 130, 500, 500), emblem("i"), label="CyberCraft", w=256)
print("ok", len(CYBER_D), len(CRAFT_D))
