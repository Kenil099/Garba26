<?php
// admin/songs/delete.php
$id = (int)($_GET['id'] ?? 0);
\App\Models\Song::delete($id);
header('Location: /admin/songs');
exit;
