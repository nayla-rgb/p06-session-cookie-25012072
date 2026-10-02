<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang</title>
</head>

<body>

<h1>Keranjang Belanja</h1>

<a href="index.php">← Kembali ke Produk</a>

<hr>

<?php if (empty($_SESSION['cart'])): ?>

    <p>Keranjang masih kosong.</p>

<?php else: ?>

    <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>

        <?php

        if (!isset($products[$id])) {
            continue;
        }

        $product = $products[$id];

        $subtotal = $product['harga'] * $quantity;

        $total += $subtotal;
        ?>

        <div>
            <h3><?= e($product['nama']) ?></h3>

            <p>
                Harga:
                Rp <?= number_format($product['harga'], 0, ',', '.') ?>
            </p>

            <p>
                Jumlah: <?= $quantity ?>
            </p>

            <p>
                Subtotal:
                Rp <?= number_format($subtotal, 0, ',', '.') ?>
            </p>
        </div>

        <hr>

    <?php endforeach; ?>

    <h2>
        Total:
        Rp <?= number_format($total, 0, ',', '.') ?>
    </h2>

<?php endif; ?>

</body>
</html>