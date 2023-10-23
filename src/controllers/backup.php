<?php
include '../config/connectDB.php';
$dump = "C:/xampp/mysql/bin/mysqldump --host=localhost --user=root --password= --databases web_tour > C:/xampp/htdocs/web-tour/db_webtour.sql";
exec($dump, $output, $returnVar);

if ($returnVar === 0) {
    echo "<script>
    alert('Backup thành công');
    window.location.href = '/web-tour/index.php';
    </script>";
} else {
    echo "<script>
    alert('Backup không thành công');
    window.location.href = '/web-tour/index.php';
    </script>";
}
?>
