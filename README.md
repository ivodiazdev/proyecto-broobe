# Desafío Broobe - Laravel

[![Proyecto Broobe](https://via.placeholder.com/1200x400?text=Agrega+una+imagen+aquí)](https://github.com/usuario/proyecto-broobe)

Este proyecto es una aplicación desarrollada en Laravel que permite analizar métricas de páginas web. Sigue los pasos a continuación para instalar, configurar y ejecutar el proyecto en tu entorno local.

---

## **Requisitos del Sistema**
Asegúrate de que tu entorno de desarrollo cumpla con los siguientes requisitos:

- **PHP**: Versión 8.1 o superior
- **Composer**: Gestor de dependencias para PHP
- **Node.js**: Versión 14 o superior (opcional, para gestionar assets con Laravel Mix)
- **NPM**: Incluido con Node.js
- **Servidor de base de datos**: MySQL o MariaDB
- **Servidor web**: Apache o Nginx

---

## **Pasos de Instalación**

### 1. **Clonar el Repositorio**
Clona este repositorio en tu máquina local:
```bash
git clone https://github.com/usuario/proyecto-broobe.git

### 2. **Ingresar al Directorio del Proyecto**
```bash
cd proyecto-broobe
3. Instalar Dependencias
Ejecuta el siguiente comando para instalar las dependencias del proyecto:

bash
Copiar código
composer install
4. Configurar el Archivo .env
Copia el archivo de ejemplo .env.example y renómbralo a .env:

bash
Copiar código
cp .env.example .env
Configura las variables de entorno en el archivo .env, especialmente la conexión a la base de datos:

plaintext
Copiar código
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
5. Generar la Clave de la Aplicación
Genera una clave única para tu aplicación:

bash
Copiar código
php artisan key:generate
6. Configurar Permisos
Asegúrate de que las carpetas storage y bootstrap/cache tengan los permisos correctos:

bash
Copiar código
chmod -R 775 storage bootstrap/cache
Base de Datos
1. Ejecutar las Migraciones
Crea las tablas necesarias en la base de datos ejecutando las migraciones:

bash
Copiar código
php artisan migrate
2. Cargar los Seeders
Llena las tablas con datos iniciales:

bash
Copiar código
php artisan db:seed
Si necesitas ejecutar un seeder específico:

bash
Copiar código
php artisan db:seed --class=NombreDelSeeder
3. Reiniciar la Base de Datos (Opcional)
Si deseas reiniciar completamente las tablas y volver a ejecutarlas con los seeders:

bash
Copiar código
php artisan migrate:fresh --seed
Compilar los Assets (Opcional)
Si utilizas Laravel Mix para compilar CSS y JavaScript, ejecuta los siguientes comandos:

Instalar dependencias de Node.js:

bash
Copiar código
npm install
Compilar los assets para desarrollo:

bash
Copiar código
npm run dev
Compilar los assets para producción:

bash
Copiar código
npm run build
Iniciar el Servidor de Desarrollo
Inicia el servidor de desarrollo de Laravel:

bash
Copiar código
php artisan serve
Por defecto, la aplicación estará disponible en http://127.0.0.1:8000.

Pruebas
Ejecuta las pruebas disponibles en el proyecto con el siguiente comando:

bash
Copiar código
php artisan test
Notas Importantes
Antes de ejecutar las migraciones y seeders, asegúrate de que el servidor de base de datos esté corriendo.
Configura correctamente el archivo .env con los valores adecuados para tu entorno de desarrollo o producción.
Para cambios en las migraciones o seeders, usa el comando php artisan migrate:fresh --seed para recrear la base de datos desde cero.
Si tienes problemas con los permisos, asegúrate de configurar las carpetas storage y bootstrap/cache correctamente.
Créditos
Desarrollado por: [Tu Nombre]