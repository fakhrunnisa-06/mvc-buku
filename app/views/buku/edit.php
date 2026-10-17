<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h2>Edit Buku</h2>

    <?php if (!empty($_SESSION['flash'])): $f = $_SESSION['flash']; unset($_SESSION['flash']); ?>
        <p style="color:<?= $f['type'] === 'success' ? 'green' : 'red' ?>">
            <?= htmlspecialchars($f['message']) ?>
        </p>
    <?php endif; ?>

    <form method="post" action="index.php?page=buku&action=update">
        <input type="hidden" name="id" value="<?= (int) $buku['id'] ?>">

        <label>ISBN</label><br>
        <input type="text" name="isbn"
               value="<?= htmlspecialchars($buku['isbn']) ?>" required><br><br>

        <label>Judul</label><br>
        <input type="text" name="judul"
               value="<?= htmlspecialchars($buku['judul']) ?>" required><br><br>

        <label>Penulis</label><br>
        <input type="text" name="penulis"
               value="<?= htmlspecialchars($buku['penulis']) ?>" required><br><br>

        <label>Penerbit</label><br>
        <input type="text" name="penerbit"
               value="<?= htmlspecialchars($buku['penerbit']) ?>" required><br><br>

        <label>Tahun Terbit</label><br>
        <input type="number" name="tahun_terbit" min="1000" max="9999"
               value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" min="0"
               value="<?= (int) $buku['stok'] ?>" required><br><br>

        <button type="submit">Update</button>
        <a href="index.php?page=buku">Kembali</a>
    </form>
</body>
</html>