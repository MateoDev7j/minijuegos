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

## Resumen de aportaciones de Ihssane Torqui

En esta actualización se han desarrollado los modelos `JugadorModel` y
`JuegoModel`, encargados de gestionar la lectura, almacenamiento y
consulta de los datos de los jugadores y videojuegos de la plataforma.
Ambos modelos utilizan archivos JSON para persistir la información.

### Modelos (`Models/`)

-   **`JugadorModel`:**
    -   Implementación de la gestión de jugadores mediante
        almacenamiento en archivos JSON.
    -   Método `todos()`, encargado de recuperar todos los jugadores
        registrados.
    -   Método `existeUsername()`, que comprueba si un nombre de usuario
        ya está registrado, sin distinguir entre mayúsculas y
        minúsculas.
    -   Método `existeEmail()`, que comprueba si un correo electrónico
        ya existe en el sistema, independientemente de las mayúsculas y
        minúsculas.
    -   Método `crear()`, encargado de registrar nuevos jugadores,
        almacenando su nombre de usuario, correo electrónico y
        contraseña cifrada mediante `password_hash()`.
    -   Método `verificarCredenciales()`, que comprueba las credenciales
        durante el inicio de sesión utilizando `password_verify()`.
        Además, evita devolver la contraseña o su hash en los datos del
        jugador.
    -   Creación automática de los directorios necesarios para almacenar
        los datos cuando no existen.
-   **`JuegoModel`:**
    -   Implementación de la gestión de videojuegos mediante
        almacenamiento de información en archivos JSON.
    -   Método `todos()`, encargado de recuperar todos los videojuegos
        almacenados.
    -   Método `guardar()`, que permite guardar nuevos videojuegos junto
        con sus metadatos: título, descripción, autor y categoría.
    -   Gestión de la subida de archivos comprimidos ZIP, trasladándolos
        desde su ubicación temporal hasta la carpeta definitiva de
        almacenamiento.
    -   Generación de nombres únicos para los archivos ZIP mediante
        `random_bytes()` y `bin2hex()`, evitando conflictos entre
        archivos.
    -   Almacenamiento de la ruta del archivo, su nombre original y el
        resto de información del videojuego en el archivo JSON.
    -   Creación automática de los directorios necesarios para almacenar
        los videojuegos.
    -   Gestión de errores durante la subida de archivos y la conversión
        de datos a formato JSON.

### Gestión y persistencia de datos

-   Se ha utilizado JSON como sistema de almacenamiento de jugadores y
    videojuegos.
-   Se ha implementado la lectura y escritura de datos mediante
    funciones nativas de PHP.
-   Se ha utilizado `LOCK_EX` durante la escritura de los archivos JSON
    para evitar accesos simultáneos durante el proceso de escritura.
-   Se han añadido comprobaciones para gestionar archivos inexistentes,
    vacíos o con contenido JSON no válido.
---
# Fin de aportaciones de Ihssane Torqui
---