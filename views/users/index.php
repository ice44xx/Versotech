<h1 class="mb-5 text-gradient fw-bold">Usuários</h1>

<a href="index.php?route=create" class="btn btn-gradient mb-4 shadow-lg">Adicionar Usuário</a>

<div class="table-wrapper">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cores</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="fw-semibold"><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td class="colors-cell">
                        <?php foreach ($user['colors'] as $color): ?>
                            <span
                                class="color-dot"
                                style="background-color: <?= htmlspecialchars($color) ?>"
                                title="<?= htmlspecialchars($color) ?>"></span>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <a href="index.php?route=edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-edit">Editar</a>

                        <form action="index.php?route=delete&id=<?= $user['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que quer deletar este usuário?');">
                            <button type="submit" class="btn btn-sm btn-delete">Deletar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>