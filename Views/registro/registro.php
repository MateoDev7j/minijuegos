<?php /** Variables que pasa el controlador: $errores (campo => mensaje) y $datos (sin contraseñas). */ ?>
<section class="panel estrecho">
    <h1>Crear cuenta</h1>

    <?php if ($errores !== []): ?>
        <div class="alerta alerta-error" role="alert">
            <p>Revisa estos campos:</p>
            <ul>
                <?php foreach ($errores as $mensaje): ?>
                    <li><?= e($mensaje) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= e(DEFINE_URL) ?>auth/registro" novalidate>
        <p>
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="usuario[username]"
               value="<?= e($datos['username'] ?? '') ?>" required>
        </p>
       
        <p>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="usuario[email]"
                value="<?= e($datos['email'] ?? '') ?>" required>
        </p>
        
        
        <p>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="usuario[password]" required>
        </p>
        
        
        <p>
            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="usuario[password_confirm]" required>
        </p>
        
        <button type="submit" class="boton">Crear cuenta</button>
    </form>

    <p class="nota">¿Ya tienes cuenta? <a href="<?= e(DEFINE_URL) ?>auth/login">Inicia sesión</a></p>
</section>