<?php
require_once 'db.php';
require_once 'header.php';

$stmt = $pdo->query("SELECT id, title, artist, created_at FROM songs ORDER BY created_at DESC");
$songs = $stmt->fetchAll();
?>

<a href="create.php">➕ Add New Song</a>

<table>
    <tr>
        <th>Title</th>
        <th>Artist</th>
        <th>Date Created</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($songs as $song): ?>
    <tr>
        <td><?= htmlspecialchars($song['title']) ?></td>
        <td><?= htmlspecialchars($song['artist']) ?></td>
        <td><?= $song['created_at'] ?></td>
        <td>
            <a href="edit.php?id=<?= $song['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $song['id'] ?>" onclick="return confirm('Delete this song?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once 'footer.php'; ?>