#!/bin/sh
# Builds cybercraft-website.zip for upload with cPanel File Manager (see INSTALL.txt).
# Layout inside the zip:
#   cybercraft-website/public_html/   -> contents go into ~/public_html
#   cybercraft-website/cybercraft_app/ -> folder goes next to public_html
#   cybercraft-website/database/cybercraft.sql
set -e
cd "$(dirname "$0")/.."
OUT=build/cybercraft-website
rm -rf build && mkdir -p "$OUT/public_html" "$OUT/cybercraft_app" "$OUT/database"
cp -R public/. "$OUT/public_html/"
cp -R app/. "$OUT/cybercraft_app/"
rm -f "$OUT/cybercraft_app/config.php"
find "$OUT/cybercraft_app/storage" -type f ! -name .htaccess -delete
find "$OUT/public_html/assets/img/uploads" -type f ! -name .htaccess -delete 2>/dev/null || true
cp database/cybercraft.sql "$OUT/database/"
cp INSTALL.txt "$OUT/"
(cd build && zip -qr cybercraft-website.zip cybercraft-website)
echo "Created build/cybercraft-website.zip"
