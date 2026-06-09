# SimpsonsDex Backend

Backend Laravel de SimpsonsDex desplegado en Render como Web Service con Docker.

## URLs

- Formulario Laravel: https://lossimpsons-backend.onrender.com/personajes/create
- API de personajes: https://lossimpsons-backend.onrender.com/api/personajes

## Endpoints API

- `GET /api/personajes`
- `POST /api/personajes`
- `DELETE /api/personajes/{personaje}`

## Despliegue en Render

El servicio usa el `Dockerfile` del proyecto. El script `render-start.sh` prepara SQLite, ejecuta migraciones, carga los personajes base y arranca Apache.

```bash
php artisan migrate --force
php artisan db:seed --force --no-interaction
php artisan config:cache
php artisan route:cache
```

## Variables principales

```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
```

El archivo `.env` real no debe subirse al repositorio.
