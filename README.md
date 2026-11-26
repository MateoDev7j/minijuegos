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
 
## Resumen de aportaciones de Vicente Gabriel Piñar Ojeda
 
En esta actualización se ha desarrollado la capa de presentación de la plataforma: las vistas con las que interactúa el usuario (inicio de sesión, registro, listado de juegos y subida de juegos), junto con la plantilla común y la vista de error. Todas ellas se muestran a través de la clase `Pages`, que carga la cabecera, la vista solicitada y el pie de página en ese orden, y reciben del controlador únicamente las variables que necesitan.
 
### Plantilla común (`Views/Layout/`)
 
* **`header.php`:**
  * Estructura inicial del documento HTML5: `<!DOCTYPE html>`, idioma `es`, codificación `utf-8` y etiqueta `viewport` para adaptarse a distintos tamaños de pantalla.
  * Enlace a la hoja de estilos `assets/css/style.css`.
  * Cabecera del sitio con el título del proyecto, que enlaza a `index.php`, y un mensaje de bienvenida.
* **`footer.php`:**
  * Pie de página dividido en tres secciones: **Enlaces útiles**, **Contacto** y **Legal**.
  * Barra inferior con el aviso de copyright.
  * Cierre de las etiquetas `</body>` y `</html>` abiertas en la cabecera, de modo que cualquier vista queda envuelta en un documento HTML completo.
### Vistas de autenticación (`Views/auth/`)
 
* **`login.php`:**
  * Formulario de inicio de sesión por `POST` hacia `auth/login`, con los campos de correo electrónico y contraseña agrupados en el array `usuario[...]`.
  * Muestra la lista de errores devueltos por el controlador (`$errores`) dentro de un aviso con `role="alert"`.
  * Conserva el correo escrito por el usuario tras un intento fallido, sin volver a mostrar nunca la contraseña.
  * Aviso opcional de registro correcto (`$registrado`) y enlace a la página de registro para quienes no tienen cuenta.
* **`registro.php`:**
  * Formulario de creación de cuenta por `POST` hacia `auth/registro`, con nombre de usuario, correo electrónico, contraseña y confirmación de contraseña.
  * Muestra los errores de validación y de duplicados (usuario o correo ya registrados) devueltos por el controlador.
  * Conserva el nombre de usuario y el correo tras un error; las contraseñas no se rellenan de nuevo.
  * Enlace a la página de inicio de sesión para quienes ya tienen cuenta.
### Vistas de juegos (`Views/juegos/`)
 
* **`index.php`:**
  * Listado de los juegos subidos, mostrados como tarjetas con categoría, título, autor, descripción y fecha de subida (si existe).
  * Botón de descarga del archivo ZIP de cada juego.
  * Estado vacío: cuando no hay juegos, se muestra un mensaje con un enlace para subir el primero.
* **`subir.php`:**
  * Formulario de subida de juegos con título, descripción, categoría y archivo ZIP.
  * Uso de `enctype="multipart/form-data"`, imprescindible para que el archivo llegue al servidor.
  * Las categorías del desplegable se generan dinámicamente a partir de la constante `CATEGORIAS` de `config.php`, y el límite de tamaño mostrado se calcula a partir de `MAX_ZIP`, de forma que si cambian en la configuración la vista se actualiza sola.
  * El campo de archivo restringe la selección a `.zip` (`accept`).
  * Muestra los errores de validación y conserva los datos escritos tras un error.
### Vista de error (`Views/error/`)
 
* **`error404.php`:** Página mostrada cuando se solicita una ruta inexistente. Es utilizada por `ErrorController::show_error404()`, que además envía el código de estado HTTP correspondiente.
### Estilos (`public/assets/css/`)
 
* **`style.css`:**
  * Regla global `box-sizing: border-box` y tipografía `Arial, Helvetica, sans-serif` en todo el sitio.
  * Color de fondo `aliceblue` para la página.
  * Estilos de la cabecera (`.header-content`) y del pie de página (`.footer-content`), con fondo oscuro y texto blanco; el pie usa `display: flex` para colocar sus secciones en una fila.
  * Altura del 100 % en `html` y `body` y eliminación de los márgenes por defecto del navegador.
### Seguridad y buenas prácticas
 
* **Escapado de salida:** todos los datos que se imprimen en las vistas (valores de formulario, mensajes de error, datos de los juegos y rutas) pasan por la función auxiliar `e()`, basada en `htmlspecialchars()`, para evitar ataques XSS.
* **Separación de lógica y presentación:** las vistas solo contienen HTML y estructuras de control sencillas (`if`, `foreach`); la lógica y la validación se mantienen en controladores, modelos y clases `Request`.
* **Documentación en el código:** cada vista indica en un comentario inicial qué variables recibe del controlador.
* **Reutilización:** una única plantilla de cabecera y pie compartida por todas las páginas.
* **Accesibilidad básica:** cada campo tiene su `<label>` asociado mediante `for`/`id`, y los avisos usan los roles `alert` y `status`.
* **URLs dinámicas:** los enlaces y las acciones de los formularios se construyen con la constante `DEFINE_URL`, sin rutas escritas a mano.
---
# Fin de aportaciones de Vicente Gabriel Piñar Ojeda
---
