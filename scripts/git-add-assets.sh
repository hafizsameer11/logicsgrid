#!/usr/bin/env bash
# Add all site images and static assets to git for Dokploy deployment.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

git add -f public/assets/
git add -f public/css/
git add -f public/js/
git add -f public/fonts/ 2>/dev/null || true
git add -f brand-assets/ 2>/dev/null || true
git add -f veritical.png 2>/dev/null || true

echo "Staged image assets:"
git diff --cached --name-only | grep -E '\.(png|webp|jpg|jpeg|gif|css|js)$' | wc -l | xargs echo "  files:"
