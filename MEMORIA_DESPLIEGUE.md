# Memoria de despliegue - SimpsonsDex

## Enlaces publicos

- Frontend Angular: https://lossimpsonsdex.onrender.com/
- Backend Laravel: https://lossimpsons-backend.onrender.com/personajes/create
- API de personajes: https://lossimpsons-backend.onrender.com/api/personajes

## Estructura del proyecto

El proyecto esta dividido en dos aplicaciones independientes:

- `losSimpsonsDex-Frontend`: aplicacion Angular encargada de la interfaz de usuario.
- `losSimpsons-Backend`: aplicacion Laravel encargada del formulario, la API REST y la persistencia de personajes.

Ambos proyectos se han subido a GitHub y se han desplegado como servicios separados en Render.

## Despliegue del frontend Angular

El frontend se ha desplegado en Render como Static Site.

Configuracion principal:

- Comando de build: `npm ci && npm run build`
- Carpeta publicada: `dist/losSimpsonsDex/browser`
- Version de Node: `22.12.0`

La aplicacion Angular usa el fichero `environment.prod.ts` para conectarse al backend publicado:

```ts
apiBaseUrl: 'https://lossimpsons-backend.onrender.com'
```

Tambien se ha configurado una regla de rewrite hacia `index.html` para que las rutas de Angular funcionen correctamente en produccion.

## Despliegue del backend Laravel

El backend se ha desplegado en Render como Web Service usando Docker.

Configuracion principal:

- Imagen base: `php:8.2-apache`
- Servidor web: Apache apuntando a la carpeta `public`
- Instalacion de dependencias PHP con Composer
- Base de datos SQLite
- Script de arranque: `render-start.sh`

Durante el arranque se preparan las carpetas necesarias, se crea el archivo SQLite, se ejecutan las migraciones, se cargan los datos iniciales y se cachea la configuracion:

```bash
php artisan migrate --force
php artisan db:seed --force --no-interaction
php artisan config:cache
php artisan route:cache
```

## Integracion entre frontend y backend

El frontend consume la API REST del backend mediante HTTP.

Endpoints principales:

- `GET /api/personajes`: obtiene el listado de personajes.
- `POST /api/personajes`: crea un nuevo personaje.
- `DELETE /api/personajes/{personaje}`: elimina un personaje.

El backend tiene CORS configurado para permitir las peticiones desde el frontend publicado en Render.

## Verificacion

Se ha comprobado que:

- El frontend carga correctamente desde su URL publica.
- El backend responde correctamente desde su URL publica.
- La API devuelve datos en formato JSON.
- Los personajes basicos aparecen en la API.
- La creacion de personajes desde el frontend se comunica con el backend.

## Conclusion

La aplicacion SimpsonsDex queda desplegada publicamente en Render con frontend Angular y backend Laravel comunicandose correctamente en entorno de produccion.
