<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Connection Failed");

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM chatbot WHERE id = $id");
    echo "<script>alert('Reply deleted successfully!'); window.location='manage_replies.php';</script>";
}

// Handle Edit Request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $new_reply = mysqli_real_escape_string($conn, $_POST['reply']);
    mysqli_query($conn, "UPDATE chatbot SET replies = '$new_reply' WHERE id = $id");
    echo "<script>alert('Reply updated successfully!'); window.location='manage_replies.php';</script>";
}

// Fetch all chatbot replies
$result = mysqli_query($conn, "SELECT * FROM chatbot ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chatbot Replies</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f4f4; }
        .container { width: 600px; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px gray; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; border-radius: 5px; }
        .btn-edit { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="container">
    <h3>Manage Chatbot Replies</h3>
    <table>
        <tr>
            <th>Query</th>
            <th>Reply</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['queries']; ?></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="text" name="reply" value="<?= $row['replies']; ?>">
                        <button type="submit" name="update" class="btn btn-edit">Update</button>
                    </form>
                </td>
                <td>
                    <a href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-delete">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
