<?php
include 'connect_db.php';

$filterProduk = $_GET['produk'] ?? '';
$filterSales = $_GET['sales'] ?? '';
$filterBulan = $_GET['bulan'] ?? '';
$currentMonth = date('m');
$currentYear = date('Y');

$query = "SELECT leads.id_leads, leads.tanggal, sales.nama_sales, produk.nama_produk, leads.nama_lead, leads.no_wa, leads.kota 
          FROM leads
          JOIN sales ON leads.id_sales = sales.id_sales
          JOIN produk ON leads.id_produk = produk.id_produk
          WHERE 1=1";

if (empty($filterProduk) && empty($filterSales) && empty($filterBulan)) {
    $query .= " AND MONTH(leads.tanggal) = $currentMonth AND YEAR(leads.tanggal) = $currentYear";
}

if (!empty($filterProduk)) {
    $query .= " AND produk.nama_produk LIKE '%$filterProduk%'";
}

if (!empty($filterSales) && !empty($filterBulan)) {
    $query .= " AND sales.nama_sales = '$filterSales' AND MONTH(leads.tanggal) = '$filterBulan'";
}

if (empty($filterSales) && !empty($filterBulan)) {
    $query .= " AND MONTH(leads.tanggal) = '$filterBulan'";
}

if (!empty($filterSales) && empty($filterBulan)) {
    $query .= " AND sales.nama_sales = '$filterSales'";
}

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Leads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6 space-y-8">
    <h3 class="text-lg font-semibold">Cari Berdasarkan Nama Produk:</h3>
    <form method="GET" class="flex items-center space-x-4">
        <input type="text" name="produk" placeholder="Masukkan nama produk" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Cari</button>
    </form>

    <h3 class="text-lg font-semibold">Cari Berdasarkan Sales dan Bulan:</h3>
    <form method="GET" class="flex items-center space-x-4">
        <select name="sales" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Pilih Sales --</option>
            <?php
            $salesRes = mysqli_query($con, "SELECT nama_sales FROM sales");
            while ($row = mysqli_fetch_assoc($salesRes)) {
                echo "<option value='" . $row['nama_sales'] . "'>" . $row['nama_sales'] . "</option>";
            }
            ?>
        </select>
        <select name="bulan" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Pilih Bulan --</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                echo "<option value='$val'>" . date('F', mktime(0, 0, 0, $i, 10)) . "</option>";
            }
            ?>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Cari</button>
    </form>

    <h3 class="text-lg font-semibold">Data Leads</h3>
    <table class="table-auto border-collapse border border-gray-300 w-full text-sm text-left bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">ID Input</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                <th class="border border-gray-300 px-4 py-2">Sales</th>
                <th class="border border-gray-300 px-4 py-2">Produk</th>
                <th class="border border-gray-300 px-4 py-2">Nama Leads</th>
                <th class="border border-gray-300 px-4 py-2">No WA</th>
                <th class="border border-gray-300 px-4 py-2">Kota</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='hover:bg-gray-100'>
                <td class='border border-gray-300 px-4 py-2'>$no</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['id_leads']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['tanggal']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['nama_sales']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['nama_produk']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['nama_lead']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['no_wa']}</td>
                <td class='border border-gray-300 px-4 py-2'>{$row['kota']}</td>
            </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">Kembali</a>
</body>

</html>