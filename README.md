# Plataforma_De_Videojuegos aportaciones del grupo:
---
# Registro de Cambios - Proyecto Minijuegos
---
**Autor:** Mateo Daniel Ortuño Ovando  
**Rama / Commit:** Merge de cambios de Mateo hacia `main`

---

## Resumen de Aportaciones de Mateo

En esta actualización se ha implementado la arquitectura base de enrutamiento, gestión de sesiones, autenticación de usuarios y subida/validación de videojuegos.

### Config & Bootstrap
* **Rutas (`config/`):** Se han actualizado y corregido las rutas del proyecto para que apunten correctamente a la raíz.
* **Gestión de sesión (`bootstrap.php`):** Se ha implementado una comprobación del estado de la sesión para iniciarla únicamente si no se encuentra activa (`session_start()`).

### Controladores (`Controllers/`)
* **`FrontController`:** Se ha actualizado la lógica de enrutamiento para leer dinámicamente el controlador y la acción solicitados, estableciendo un controlador y acción por defecto.
* **`AuthController`:** 
  * Implementación completa de inicio de sesión (`login`), registro y cierre de sesión (`logout`).
  * Creación de variables de sesión y método auxiliar de redirección (`redirigir()`).
  * Integración con el modelo (`JugadorModel` / `JuegoModel`) para verificar la existencia de usuarios y obtener los registros de jugadores en formato de array asociativo.
* **`JuegoController`:** 
  * Gestión del formulario de subida de juegos (metadatos como título, descripción, categoría y archivo comprimido en formato `.zip`).
  * Almacenamiento de registros válidos y redirección dinámica a las vistas correspondientes (ej. `juegos/index`, `auth/login`).

### Validaciones (`Requests/`)
* **`FormLoginRequest`:** Saneamiento y validación de credenciales recibidas por `POST`, con métodos para retornar los valores limpios y gestionar errores hacia el controlador.
* **`FormRegistroRequest`:** Saneamiento y validación de los datos enviados desde el formulario de registro de nuevos usuarios.
* **`FormSubirJuegoRequest`:** 
  * Saneamiento de los campos de texto del formulario de subida.
  * Validación de archivos adjuntos mediante variables nativas de PHP (`$_FILES`), controlando el nombre completo del archivo y verificando que no supere el tamaño máximo permitido.
---
# Fin de aportaciones de Mateo Daniel Ortuño Ovando
---
