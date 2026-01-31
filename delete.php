<?php
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM songs WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;