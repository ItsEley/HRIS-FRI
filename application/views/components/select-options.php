<?php

// Check if query executed successfully
if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
        // Output each department as an option
        echo '<option value="' . $row->id . '">' .  $row->department . '</option>';
    }
} else {
    // Handle no results from the database
    echo '<option value="">No departments found</option>';
}



?>