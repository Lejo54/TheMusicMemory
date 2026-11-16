# ---- Étape 1 : build des assets front (Vite) ----
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json bun.lock ./
RUN npm install
COPY resources resources
COPY vite.config.js ./
RUN npm run build

# ---- Étape 2 : application PHP ----
FROM php:8.4-cli
RUN apt-get update && apt-get install -y --no-install-recommends unzip && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

COPY . .
COPY --from=assets /app/public/build public/build

RUN cp .env.example .env \
    && php artisan package:discover --ansi \
    && php artisan key:generate --force

ENV APP_ENV=production \
    APP_DEBUG=false

EXPOSE 8000
CMD ["sh", "-c", "touch database/database.sqlite && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]