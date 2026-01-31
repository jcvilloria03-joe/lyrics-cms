<?php
require_once 'db.php';

$id = intval($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM songs WHERE id = ?");
$stmt->execute([$id]);
$song = $stmt->fetch();

if (!$song) {
    die('Song not found.');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title  = trim($_POST['title']);
    $artist = trim($_POST['artist']);
    $lyrics = trim($_POST['lyrics']);

    if ($title === '' || $artist === '' || $lyrics === '') {
        $error = 'All fields are required.';
    } else {
        $update = $pdo->prepare(
            "UPDATE songs SET title = ?, artist = ?, lyrics = ? WHERE id = ?"
        );
        $update->execute([$title, $artist, $lyrics, $id]);
        header('Location: index.php');
        exit;
    }
}

require_once 'header.php';
?>

<h3>Edit Song</h3>

<?php if ($error): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label>Title</label>
    <input type="text" name="title" value="<?= htmlspecialchars($song['title']) ?>">

    <label>Artist</label>
    <input type="text" name="artist" value="<?= htmlspecialchars($song['artist']) ?>">

    <label>Lyrics</label>
    <textarea name="lyrics"><?= htmlspecialchars($song['lyrics']) ?></textarea>

    <br><br>
    <button type="submit">Update</button>
    <a href="index.php">Cancel</a>
</form>

<?php require_once 'footer.php'; ?>