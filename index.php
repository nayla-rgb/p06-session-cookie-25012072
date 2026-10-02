<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

$flash = pullFlash();
?>

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