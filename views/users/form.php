<h1 class="mb-5 text-gradient fw-bold"><?= $action === 'store' ? 'Novo Usuário' : 'Editar Usuário' ?></h1>

<form action="index.php?route=<?= $action ?>" method="post" class="user-form">
    <?php if ($action === 'update'): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
    <?php endif; ?>

    <div class="input-group mb-4">
        <label for="name" class="input-label">Nome</label>
        <input
            type="text"
            id="name"
            name="name"
            class="input-field"
            value="<?= htmlspecialchars($user['name'] ?? '') ?>"
            placeholder="Digite o nome completo"
            required>
    </div>

    <div class="input-group mb-4">
        <label for="email" class="input-label">E-mail</label>
        <input
            type="email"
            id="email"
            name="email"
            class="input-field"
            value="<?= htmlspecialchars($user['email'] ?? '') ?>"
            placeholder="Digite o email"
            required>
    </div>

    <fieldset class="input-group mb-5">
        <legend class="input-label mb-3">Cores Favoritas</legend>
        <div class="colors-container">
            <?php foreach ($colors as $color): ?>
                <label class="color-checkbox" for="color_<?= $color['id'] ?>" style="--color: <?= htmlspecialchars($color['name']) ?>">
                    <input
                        type="checkbox"
                        id="color_<?= $color['id'] ?>"
                        name="colors[]"
                        value="<?= $color['id'] ?>"
                        <?= in_array($color['id'], $selectedColors) ? 'checked' : '' ?>>
                    <span class="color-swatch"></span>
                    <span class="color-name"><?= htmlspecialchars($color['name']) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-gradient"><?= $action === 'store' ? 'Criar Usuário' : 'Atualizar Usuário' ?></button>
        <a href="index.php?route=users" class="btn btn-outline-secondary ms-3">Cancelar</a>
    </div>
</form>