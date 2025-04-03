<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Connection Failed");

if(isset($_POST['text'])) {
    $userMessage = strtolower(trim(mysqli_real_escape_string($conn, $_POST['text'])));

    // Introduce a 2-second delay
    sleep(1);

    // If user types "list all queries"
    if ($userMessage == "list replies") {
        $query = "SELECT queries FROM chatbot";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $response = "📜 Available Queries:<br>";
            while ($row = mysqli_fetch_assoc($result)) {
                $response .= "🔹 " . htmlspecialchars($row['queries']) . "<br>";
            }
            echo $response;
        } else {
            echo "❌ No queries found in the database.";
        }
    } 
    // If user asks a normal query
    else {
        $query = "SELECT replies FROM chatbot WHERE LOWER(queries) = '$userMessage' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row['replies'];
        } else {
            echo "Sorry, I didn't understand that.";
        }
    }
} else {
    echo "Invalid request!";
}
?>
