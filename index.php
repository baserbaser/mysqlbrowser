<?php
require_once 'config.inc.php';


try{
    $connection = new mysqli($host, $username, $password);
}catch(Exception $e){
    echo "I can not connect.Please check config.inc.php";    
    die;
}

if ($connection->connect_error) {
    die("<div class='alert alert-danger'>Connection Error: " . htmlspecialchars($connection->connect_error) . "</div>");
}

// Veritabanlarını al
$sql = "SHOW DATABASES";
$result = $connection->query($sql);

if (!$result) {
    die("<div class='alert alert-danger'>Query Error: " . htmlspecialchars($connection->error) . "</div>");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>MySQL Db List</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">
        <i class="fas fa-database me-2"></i>MySQL DB List
    </h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title text-dark">
                                <i class="fas fa-folder-open text-info me-2"></i>
                                <?= htmlspecialchars($row['Database']) ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Db not found</div>
    <?php endif; ?>

</div>

<!-- Font Awesome (İkonlar için) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>

<?php
// Bağlantıyı kapat
$connection->close();
?>
