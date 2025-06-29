# 🎉 InviteManager

## 📋 Descripción del Proyecto

**InviteManager** es una aplicación web diseñada para facilitar la gestión de eventos y el seguimiento de invitados. Permite crear eventos, añadir invitados, registrar asistencia y filtrarlos por parentesco (👨‍👩‍👧‍👦 familia, 👯‍♂️ amigos, 💼 colegas). Todo desde una interfaz intuitiva y moderna.

## 🚀 Características Principales

✅ **Gestión de Eventos** – Crea y administra múltiples eventos.  
✅ **Gestión de Invitados** – Añade, edita y elimina invitados por evento.  
✅ **Seguimiento de Asistencia** – Marca invitados como Confirmado ✅ o Pendiente ⏳.  
✅ **Filtro por Parentesco** – Filtra por Familia 👪, Amigos 🧑‍🤝‍🧑 o Colegas 👔.  
✅ **Filtros Combinados** – Aplica múltiples filtros simultáneamente.  
✅ **Detalles del Evento** – Visualiza información clave sin salir de la gestión.  
✅ **Modo Invitado (Demo)** – Prueba la app sin registrarte 🧪.

---

## 🛠️ Tecnologías Utilizadas

**Backend:** PHP (MVC básico)  
**Base de Datos:** MySQL  
**Frontend:** HTML, SCSS (Sass), JavaScript  
**Dependencias:** Composer (PHP) & npm (Frontend)  
**Automatización:** Gulp.js  
**Alertas:** SweetAlert2 🔔

---

## Instalación y Configuración

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

### 1. Clonar el Repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
cd InviteManager
```

### 2. Configuración de la Base de Datos

1.  Crea una base de datos MySQL (ej. `invitemanager_db`).
2.  Importa el esquema de la base de datos. Si no tienes un archivo `.sql`, necesitarás crear las tablas manualmente. Asegúrate de tener una tabla `usuarios` y una tabla `invitados`.
    *   **Tabla `invitados`:** Asegúrate de que la tabla `invitados` tenga la columna `parentesco`. Si no la tiene, ejecuta el siguiente query:
        ```sql
        ALTER TABLE invitados ADD parentesco VARCHAR(60);
        ```
    *   **Usuario Invitado (Opcional):** Para usar el modo invitado, inserta el siguiente usuario en tu tabla `usuarios`:
        ```sql
        INSERT INTO usuarios (nombre, apellido, email, password, confirmado, token, admin) VALUES
        ('Invitado', 'Demo', 'invitado@demo.com', '$2y$10$VjX.p0e.p9e/y9U/q0f8e.o9U/q0f8e.o9U/q0f8e.o9U/q0f8e', 1, '', 0);
        ```
        *(La contraseña es un hash de ejemplo y no se usa para iniciar sesión en modo invitado).*
3.  Configura la conexión a la base de datos en `includes/database.php` (o el archivo correspondiente).

### 3. Instalación de Dependencias PHP

Navega a la raíz del proyecto y ejecuta Composer:

```bash
composer install
```

### 4. Instalación de Dependencias Frontend

Navega a la raíz del proyecto y ejecuta npm:

```bash
npm install
```

### 5. Compilación de Assets (SCSS y JavaScript)

Usa Gulp para compilar los archivos SCSS a CSS y los archivos JavaScript:

```bash
npx gulp
```
Para desarrollo, puedes usar `npx gulp dev` para que Gulp observe los cambios en los archivos y los compile automáticamente.

### 6. Configuración del Servidor Web

Configura tu servidor web (Apache, Nginx, etc.) para que el `document root` apunte a la carpeta `public` del proyecto. Asegúrate de que PHP esté configurado correctamente.

## Uso de la Aplicación

1.  Abre tu navegador y navega a la URL donde configuraste el proyecto (ej. `http://localhost/`).
2.  Puedes iniciar sesión con una cuenta existente, crear una nueva, o usar el botón "Probar como Invitado" para acceder al dashboard de demostración.
3.  Desde el dashboard, puedes crear nuevos eventos y empezar a gestionar tus invitados.

## Próximos Pasos (Consideraciones Futuras)

Este proyecto está construido con una arquitectura PHP y JavaScript "vanilla". Para futuras mejoras y una mayor escalabilidad, se ha considerado la migración a un framework moderno de JavaScript (como React) para el frontend, lo que permitiría una gestión de estado más robusta y una arquitectura de componentes más modular.

---

