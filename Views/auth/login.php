<?php /** Variables que pasa el controlador: $errores y $datos (solo el correo). Opcional: $registrado. */ ?>
<section class="panel estrecho">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($registrado)): ?>
        <div class="alerta alerta-ok" role="status">Registro correcto, ya puedes iniciar sesión.</div>
    <?php endif; ?>

    <?php if ($errores !== []): ?>
        <div class="alerta alerta-error" role="alert">
            <ul>
                <?php foreach ($errores as $mensaje): ?>
                    <li><?= e($mensaje) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= e(DEFINE_URL) ?>auth/login" novalidate>
        <p>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="usuario[email]"
                value="<?= e($datos['email'] ?? '') ?>" required>
        </p>
        
        <p>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="usuario[password]" required>
        </p>
        

        <button type="submit" class="boton">Entrar</button>
    </form>

    <p class="nota">¿No tienes cuenta? <a href="<?= e(DEFINE_URL) ?>auth/registro">Regístrate</a></p>
</section>
