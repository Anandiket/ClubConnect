<?php
function execute_query($action_type, $table_name, $data, $conditions = []) {
    // Database connection parameters
    include "db_connection.php";

    // Check connection
    if (!$conn) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    switch ($action_type) {
        case 'insert':
            $fields = implode(", ", array_keys($data));
            $placeholders = implode(", ", array_fill(0, count($data), "?"));
            $sql = "INSERT INTO $table_name ($fields) VALUES ($placeholders)";
            $stmt = mysqli_prepare($conn, $sql);
            $types = str_repeat('s', count($data));
            mysqli_stmt_bind_param($stmt, $types, ...array_values($data));
            break;

        case 'update':
            $set_clause = implode(", ", array_map(function($key) { return "$key = ?"; }, array_keys($data)));
            $condition_clause = implode(" AND ", array_map(function($key) { return "$key = ?"; }, array_keys($conditions)));
            $sql = "UPDATE $table_name SET $set_clause WHERE $condition_clause";
            $stmt = mysqli_prepare($conn, $sql);
            $types = str_repeat('s', count($data) + count($conditions));
            mysqli_stmt_bind_param($stmt, $types, ...array_merge(array_values($data), array_values($conditions)));
            break;

        case 'delete':
            $condition_clause = implode(" AND ", array_map(function($key) { return "$key = ?"; }, array_keys($conditions)));
            $sql = "DELETE FROM $table_name WHERE $condition_clause";
            $stmt = mysqli_prepare($conn, $sql);
            $types = str_repeat('s', count($conditions));
            mysqli_stmt_bind_param($stmt, $types, ...array_values($conditions));
            break;

        default:
            return "Invalid action type.";
    }

    if (mysqli_stmt_execute($stmt)) {
        $result = ($action_type == 'insert') ? "New record inserted successfully" : "Operation completed successfully";
    } else {
        $result = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action_type = $_POST["action_type"];
    $table_name = $_POST["table_name"];
    $data = $_POST["data"];
    $conditions = [];

    if ($action_type === 'update' || $action_type === 'delete') {
        $conditions = ["Event_ID" => $_POST["event_id"]];
    }

    $result = execute_query($action_type, $table_name, $data, $conditions);
    echo $result;

    // Redirect to the desired page after form submission
    header("Location: committeepg.php?l_id=1&committee_ID=" . $data["committee_ID"] . "&f_id=2");

    exit;
}
?>
