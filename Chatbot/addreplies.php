<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Connection Failed");

if(isset($_POST['query']) && isset($_POST['reply'])) {
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    // Insert into chatbot table
    $sql = "INSERT INTO chatbot (queries, replies) VALUES ('$query', '$reply')";
    
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('Reply added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding reply');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chatbot Replies</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f4f4; }
        .container { width: 350px; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px gray; }
        input, button { margin-top: 10px; padding: 8px; width: 90%; }
    </style>
</head>
<body>

<div class="container">
    <h3>Add Chatbot Replies</h3>
    <form method="POST">
        <input type="text" name="query" placeholder="Enter Query" required><br>
        <input type="text" name="reply" placeholder="Enter Reply" required><br>
        <button type="submit">Add Reply</button>
    </form>
</div>

</body>
</html>
