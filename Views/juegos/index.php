<?php /** Variable: $juegos (array; vacío si no hay ninguno). */ ?>
<h1>Juegos subidos</h1>

<?php if (empty($juegos)): ?>
    <section class="panel centrado">
        <p>Todavía no hay juegos subidos.</p>
        <a class="boton" href="<?= e(DEFINE_URL) ?>juego/subir">Sube el primero</a>
    </section>
<?php else: ?>
    <div class="rejilla">
        <?php foreach ($juegos as $juego): ?>
            <article class="tarjeta">
                <span class="etiqueta"><?= e($juego['categoria'] ?? '') ?></span>
                <h2><?= e($juego['titulo'] ?? '') ?></h2>
                <p class="autor">Autor: <?= e($juego['autor'] ?? '') ?></p>
                <p><?= e($juego['descripcion'] ?? '') ?></p>
                <?php if (isset($juego['fecha'])): ?>
                    <p class="nota">Subido el <?= e($juego['fecha']) ?></p>
                <?php endif; ?>
                <!-- 'archivo' es la ruta relativa a public (uploads/juegos/xxxx.zip) -->
                <a class="boton" href="<?= e(DEFINE_URL . ($juego['archivo'] ?? '')) ?>" download>Descargar ZIP</a>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
