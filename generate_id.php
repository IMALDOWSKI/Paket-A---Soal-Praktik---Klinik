<?php
include 'koneksi.php';

function generateNextID($prefix, $table, $id_field) {
    global $conn;
    
    // Get the last ID from the table
    $query = "SELECT $id_field FROM $table ORDER BY $id_field DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $last_id = $row[$id_field];
        
        // Extract the numeric part
        $numeric_part = substr($last_id, strlen($prefix));
        $next_number = intval($numeric_part) + 1;
        
        // Format with leading zeros (3 digits)
        $next_id = $prefix . str_pad($next_number, 3, '0', STR_PAD_LEFT);
    } else {
        // First record
        $next_id = $prefix . '001';
    }
    
    return $next_id;
}
?>
