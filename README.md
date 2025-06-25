# Laravel Project Rent & Sell - Docker Setup

This project is a Laravel 10 application containerized with Docker for easy local development and deployment.

---

## Prerequisites

- [Docker](https://www.docker.com/get-started) installed on your machine
- [Docker Compose](https://docs.docker.com/compose/install/) (usually included with Docker Desktop)
- [Node.js & npm](https://nodejs.org/) (for frontend assets development)

---

## Getting Started

### 1. Clone the repository

```
git clone https://github.com/yourusername/your-laravel-project.git
cd your-laravel-project

2. Copy the environment file
``` cp .env.example .env ```

Edit .env and update database credentials:
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=realrentcar
DB_USERNAME=root
DB_PASSWORD=root

Build and run the Docker containers
docker compose up -d --build

docker exec -it laravel-app composer install
docker exec -it laravel-app php artisan migrate
docker exec -it laravel-app chown -R www-data:www-data storage bootstrap/cache
8. Frontend assets - run Vite (locally)
npm install
npm run dev
http://localhost:8001


APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:WTj1VpSWRnvVeEGrsFdmguXuJ7dAvrSs9D5sh7yCVds=
APP_DEBUG=false
APP_URL=https://project-rent-sell.onrender.com

DB_CONNECTION=mysql
DB_HOST=mysql-abc123.render.com
DB_PORT=3306
DB_DATABASE=realrentcar
DB_USERNAME=renderuser
DB_PASSWORD=StrongPassword123!

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
