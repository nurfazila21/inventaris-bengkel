<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$id = intval($_GET['id']);

// Dummy data for example
$report = [
    'id' => $id,
    'item' => 'Komponen Mesin A',
    'mechanic' => 'Jane Doe',
    'received_date' => '2024-07-10',
    'status' => 'Tersedia'
    // Fetch data from database based on $id
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $item = $_POST['item'];
    $mechanic = $_POST['mechanic'];
    $received_date = $_POST['received_date'];
    $status = $_POST['status'];
    // Update logic here
    header('Location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Laporan - Inventaris Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #343a40; /* Warna gelap untuk tema profesional */
        }
        .footer {
            background-color: #343a40; /* Warna gelap untuk footer */
            padding: 10px;
            color: #fff; /* Warna teks putih untuk kontras */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-lg">
            <a class="navbar-brand" href="#"><i class="bi bi-tools"></i> Inventaris Bengkel </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-bounding-box"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2-vertical"></i> Pengaturan</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header -->

    <div class="container-lg">
        <h2>Edit Laporan Inventaris</h2>
        <form method="post">
            <div class="mb-3">
                <label for="item" class="form-label">Nama Komponen</label>
                <input type="text" class="form-control" id="item" name="item" value="<?php echo htmlspecialchars($report['item']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="mechanic" class="form-label">Nama Mekanik</label>
                <input type="text" class="form-control" id="mechanic" name="mechanic" value="<?php echo htmlspecialchars($report['mechanic']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="received_date" class="form-label">Tanggal Penerimaan</label>
                <input type="date" class="form-control" id="received_date" name="received_date" value="<?php echo htmlspecialchars($report['received_date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Tersedia" <?php if ($report['status'] === 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                    <option value="Dipakai" <?php if ($report['status'] === 'Dipakai') echo 'selected'; ?>>Dipakai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="monitoring_laporan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <div class="footer fixed-bottom text-center mb-2">
        &copy; 2024 Siti Ainul Mardiah
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
