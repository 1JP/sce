#!/bin/bash
set -e

echo "==> Baixando atualizações do GitHub..."
git pull

echo "==> Reconstruindo imagem Docker..."
docker build -t sce-app .

echo "==> Parando container antigo..."
docker stop sce-app 2>/dev/null || true
docker rm sce-app 2>/dev/null || true

echo "==> Subindo novo container..."
docker run -d \
  --name sce-app \
  --env-file .env \
  -p 80:80 \
  --restart unless-stopped \
  sce-app

echo "==> Feito! Verificando status..."
docker ps