<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_fetchers extends CI_Controller
{
    public function fetch_shifts()
    {
        // Fetch data from the database
        $query = $this->db->query('SELECT * FROM `sys_shifts`');

        // Check if the query was successful
        if ($query && $query->num_rows() > 0) {
            // Fetch the result rows as an array of objects
            $shifts = $query->result();

            // Output the HTML table rows directly
            foreach ($shifts as $shift) {
                echo '<tr>';
                echo '<td hidden>' . $shift->id . '</td>';
                echo '<td>' . $shift->group_ . '</td>';
                echo '<td>' . ($shift->description ? $shift->description : "No description") . '</td>';
                echo '<td>' . formatTimeOnly($shift->time_from) . '</td>';
                echo '<td>' . formatTimeOnly($shift->time_to) . '</td>';
                echo '<td>
                        <button type="button" class="edit-shift modal-trigger btn btn-rounded btn-primary p-1 px-2"
                            style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_shift"
                            data-shift-id="' . $shift->id . '">
                            <i class="fas fa-pencil m-r-5"></i>Edit
                        </button>
                        <button type="button" class="delete-shift modal-trigger btn btn-rounded btn-danger p-1 px-2"
                            style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_delete_shift"
                            data-shift-id="' . $shift->id . '" data-shift-label="' . $shift->group_ . '">
                            <i class="fas fa-trash m-r-5"></i>Delete
                        </button>
                    </td>';
                echo '</tr>';
            }
        } else {
            // Handle case when no rows are returned
            echo '<tr><td colspan="6">No shifts found.</td></tr>';
        }
    }
}
?>
