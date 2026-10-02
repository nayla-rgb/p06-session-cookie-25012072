<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

$allowedThemes = ['light', 'dark'];

$theme = $_COOKIE['theme'] ?? 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['theme'])
) {

    $candidate = $_POST['theme'];

    if (in_array($candidate, $allowedThemes, true)) {

        setcookie('theme', $candidate, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        header('Location: index.php');
        exit;
    }
}

$flash = pullFlash();
?>

<form method="post">

    <label>Tema:</label>

    <select name="theme">

        <option value="light"
            <?= $theme === 'light' ? 'selected' : '' ?>>
            Light
        </option>

        <option value="dark"
            <?= $theme === 'dark' ? 'selected' : '' ?>>
            Dark
        </option>

    </select>

    <button type="submit">
        Simpan Tema
    </button>

    <body style="
    background: <?= $theme === 'dark' ? '#222' : '#fff' ?>;
    color: <?= $theme === 'dark' ? '#fff' : '#000' ?>;
">

</form>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Nayla</title>
</head>

<body>

<h1>Toko Nayla</h1>

<p>
    Isi Keranjang:
    <?= cartCount($_SESSION['cart']) ?>
</p>

<?php if ($flash): ?>
    <p><?= e($flash) ?></p>
<?php endif; ?>

<h2>Daftar Produk</h2>

<?php foreach ($products as $id => $product): ?>

    <div>
        <h3><?= e($product['nama']) ?></h3>

        <p>
            Harga:
            Rp <?= number_format($product['harga'], 0, ',', '.') ?>
        </p>

        <form method="post" action="actions.php">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" value="<?= $id ?>">

            <button type="submit">
                Tambah ke Keranjang
            </button>
        </form>
    </div>

<?php endforeach; ?>

</body>
</html>