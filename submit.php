<?php
include('connect_db.php');
if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $sales = $_POST['sales'];
    $nama_lead = $_POST['nama_lead'];
    $produk = $_POST['produk'];
    $no_wa = $_POST['no_wa'];
    $kota = $_POST['kota'];

    $query = mysqli_query($con, "INSERT INTO leads (tanggal, id_sales, id_produk, no_wa, nama_lead, kota) VALUE ('$tanggal', '$sales', '$produk', '$no_wa', '$nama_lead', '$kota')");
    if ($query) {
        echo "<script>alert('Submitted')</script>";
    } else {
        echo "<script>alert('Failed, error detected')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Leads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-4xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Selamat Datang Di Tambah Leads</h1>
            <a href="index.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">Kembali</a>
        </div>
        <form method="POST">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sales</label>
                    <select name="sales" class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">Pilih Sales</option>
                        <?php
                        include('connect_db.php');
                        $sales = mysqli_query($con, "SELECT * FROM sales");
                        while ($s = mysqli_fetch_array($sales)) {
                        ?>
                            <option value="<?php echo $s['id_sales'] ?>"><?php echo $s['nama_sales'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lead</label>
                    <input type="text" name="nama_lead" placeholder="Nama Lead" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                    <select name="produk" class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">Pilih Produk</option>
                        <?php
                        include('connect_db.php');
                        $produk = mysqli_query($con, "SELECT * FROM produk");
                        while ($p = mysqli_fetch_array($produk)) {
                        ?>
                            <option value="<?php echo $p['id_produk'] ?>"><?php echo $p['nama_produk'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Whatsapp</label>
                    <input type="text" name="no_wa" placeholder="No. Whatsapp" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="kota" placeholder="Asal Kota" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>
            <div class="flex gap-4">
                <button type="submit" name="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Simpan</button>
                <button type="reset" class="text-gray-600 hover:text-gray-800">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>