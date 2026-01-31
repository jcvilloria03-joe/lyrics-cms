<?php
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title  = trim($_POST['title'] ?? '');
    $artist = trim($_POST['artist'] ?? '');
    $lyrics = trim($_POST['lyrics'] ?? '');

    if ($title === '' || $artist === '' || $lyrics === '') {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO songs (title, artist, lyrics) VALUES (?, ?, ?)"
        );
        $stmt->execute([$title, $artist, $lyrics]);
        header('Location: index.php');
        exit;
    }
}

require_once 'header.php';
?>

<h3>Add New Song</h3>

<?php if ($error): ?>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label>Title</label>
    <input type="text" name="title">

    <label>Artist</label>
    <input type="text" name="artist">

    <label>Lyrics</label>
    <textarea name="lyrics"></textarea>

    <br><br>
    <button type="submit">Save</button>
    <a href="index.php">Cancel</a>
</form>

<?php require_once 'footer.php'; ?>