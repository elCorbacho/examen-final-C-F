## Rutas API.

Las rutas de la API están definidas en `routes/api.php` y permiten la integración con clientes externos o aplicaciones móviles. Algunas rutas requieren autenticación por token.

```
POST   /api/store           Registrar usuario (API)
POST   /api/login           Login de usuario (API)

// Rutas protegidas (requieren auth:api):
GET    /api/productos       Listar productos
POST   /api/productos       Crear producto
GET    /api/productos/{id}  Ver producto

# VentasFix

Sistema de Gestión de Usuarios, Productos y Clientes

## Descripción
VentasFix es una aplicación web desarrollada en Laravel orientada a la administración eficiente de usuarios, productos y clientes. El sistema está diseñado para empresas que requieren un control centralizado, seguro y moderno de su información comercial.

## Requisitos
- PHP >= 8.1
- Composer
- Node.js y npm (para assets front-end)
- Base de datos SQLite, MySQL o PostgreSQL

## Instalación
1. Clonar el repositorio:
	```bash
	git clone https://github.com/elCorbacho/examen-final-C-F.git
	cd examen-final-C-F
	```
2. Instalar dependencias backend:
	```bash
	composer install
	```
3. Instalar dependencias frontend:
	```bash
	npm install && npm run build
	```
4. Configurar el archivo `.env` y la base de datos:
	```bash
	cp .env.example .env
	php artisan key:generate
	# Editar .env según configuración local
	```
5. Ejecutar migraciones y seeders:
	```bash
	php artisan migrate --seed
	```
6. Iniciar el servidor:
	```bash
	php artisan serve
	```

## Estructura del proyecto
- `app/Http/Controllers`: Controladores de la lógica de negocio.
- `app/Models`: Modelos Eloquent.
- `resources/views`: Vistas Blade (UI).
- `routes/web.php`: Definición de rutas web.
- `database/migrations`: Migraciones de base de datos.
- `database/seeders`: Datos de ejemplo.

## Rutas API
Las rutas de la API están definidas en `routes/api.php` y permiten la integración con clientes externos o aplicaciones móviles. Algunas rutas requieren autenticación por token.
```
POST   /api/store           Registrar usuario (API)
POST   /api/login           Login de usuario (API)

// Rutas protegidas (requieren auth:api):
GET    /api/productos       Listar productos
POST   /api/productos       Crear producto
GET    /api/productos/{id}  Ver producto
PUT    /api/productos/{id}  Actualizar producto
DELETE /api/productos/{id}  Eliminar producto

GET    /api/clientes        Listar clientes
POST   /api/clientes        Crear cliente
GET    /api/clientes/{id}   Ver cliente
PUT    /api/clientes/{id}   Actualizar cliente
DELETE /api/clientes/{id}   Eliminar cliente

GET    /api/usuarios        Listar usuarios
POST   /api/usuarios        Crear usuario
GET    /api/usuarios/{id}   Ver usuario
PUT    /api/usuarios/{id}   Actualizar usuario
DELETE /api/usuarios/{id}   Eliminar usuario
```

## Rutas Web
Las rutas web están definidas en `routes/web.php` y gestionan la interfaz de usuario y autenticación vía sesión.
```
GET    /                   Redirección según sesión
GET    /login              Formulario de login
POST   /login              Autenticación
POST   /logout             Cerrar sesión
GET    /register           Formulario de registro
POST   /register           Registro de usuario

// Rutas protegidas (requieren sesión activa):
GET    /usuarios           Listar usuarios
GET    /usuarios/create    Formulario nuevo usuario
POST   /usuarios           Crear usuario
GET    /usuarios/{id}      Ver usuario
GET    /usuarios/{id}/edit Editar usuario
PUT    /usuarios/{id}      Actualizar usuario
DELETE /usuarios/{id}      Eliminar usuario

GET    /productos          Listar productos
... (CRUD análogo a usuarios)

GET    /clientes           Listar clientes
... (CRUD análogo a usuarios)

GET    /dashboard          Dashboard principal
```

## Características principales
- Gestión de usuarios con autenticación y control de acceso.
- Administración de productos con inventario y precios.
- Registro y gestión de clientes.
- Panel de control (dashboard) con indicadores clave.
- Interfaz moderna basada en Vuexy y Bootstrap.
- Seguridad y buenas prácticas en el manejo de datos.

## Uso
Acceda a la aplicación desde su navegador en [http://localhost:8000](http://localhost:8000) tras iniciar el servidor. Utilice las credenciales generadas por los seeders o registre un nuevo usuario.

## Licencia
Este proyecto es propiedad de elCorbacho. Uso académico y profesional permitido bajo acuerdo previo.
