<?php /** Variables que pasa el controlador: $errores y $datos. Las categorías salen de CATEGORIAS (config.php). */ ?>
<section class="panel estrecho">
    <h1>Subir un juego</h1>

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

    <!-- enctype es obligatorio: sin él el fichero no llega al servidor -->
    <form method="post" action="<?= e(DEFINE_URL) ?>juego/subir" enctype="multipart/form-data" novalidate>
        <label for="titulo">Título del juego</label>
        <input type="text" id="titulo" name="juego[titulo]" value="<?= e($datos['titulo'] ?? '') ?>" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="juego[descripcion]" rows="4" required><?= e($datos['descripcion'] ?? '') ?></textarea>

        <label for="categoria">Categoría</label>
        <select id="categoria" name="juego[categoria]" required>
            <option value="">Elige una categoría</option>
            <?php foreach (CATEGORIAS as $categoria): ?>
                <option value="<?= e($categoria) ?>"
                    <?= (($datos['categoria'] ?? '') === $categoria) ? 'selected' : '' ?>>
                    <?= e($categoria) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="archivo">Archivo ZIP (máximo <?= (int) (MAX_ZIP / 1024 / 1024) ?> MB)</label>
        <input type="file" id="archivo" name="archivo" accept=".zip,application/zip" required>

        <button type="submit" class="boton">Subir juego</button>
    </form>
</section>
