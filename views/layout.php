<?php
// Supondo que você já tenha definido $title e $content em outro arquivo,
// aqui é o layout principal (layout.php)

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($title ?? 'VERSOTECH') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php?route=users">VERSOTECH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main class="container my-5">
        <?= $content ?? '' ?>
    </main>

    <footer class="bg-white text-center py-3 shadow-sm mt-auto">
        <div class="container">
            <small class="text-muted">&copy; <?= date('Y') ?> VERSOTECH</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>