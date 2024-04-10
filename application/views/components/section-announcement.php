


<?php

if($for == "hr"){

    $select = "SELECT 
    a.id, a.type, a.title, a.content, 
    CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS author,
    a.to_all, 
    a.date_created, 
    GROUP_CONCAT(d.acro_dept ORDER BY d.acro_dept SEPARATOR ', ') AS departments,
    GROUP_CONCAT(d.department ORDER BY d.acro_dept SEPARATOR ', ') AS full_departments
    FROM 
        announcement a
    LEFT JOIN 
        announce_to t ON a.id = t.ann_id
    LEFT JOIN 
        department d ON t.dept_id = d.id
    LEFT JOIN 
        employee e ON a.author = e.id
    GROUP BY 
        a.id
    ORDER BY 
        a.date_created DESC";

}else if($for == "emp"){
    $select = "SELECT 
    a.id, a.type, a.title, a.content, 
    CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS author,
    a.to_all, a.date_created, 
    GROUP_CONCAT(d.acro_dept ORDER BY d.acro_dept SEPARATOR ', ') AS departments,
    GROUP_CONCAT(d.department ORDER BY d.acro_dept SEPARATOR ', ') AS full_departments
    FROM 
        announcement a
    LEFT JOIN 
        announce_to t ON a.id = t.ann_id
    LEFT JOIN 
        department d ON t.dept_id = d.id
    LEFT JOIN 
        employee e ON a.author = e.id
    GROUP BY 
        a.id
    HAVING 
        departments LIKE '%".$_SESSION['acro']."%' OR a.to_all = 1
    ORDER BY 
        a.date_created DESC";
}

?>



<div class="timeline-panel">
                  <?php
                  $query = $this->db->query($select);

                  // Check if the query was successful
                  if ($query) {
                     // Check if there are rows returned
                     if ($query->num_rows() > 0) {
                        // Fetch the result rows as an array of objects
                        $announcement = $query->result();

                        // Process the result rows
                        foreach ($announcement as $row) {
                           // Access properties of each shift object as needed
                           $data['id'] = $row->id;
                           $data['title'] = $row->title;
                           $data['content'] =  $row->content;
                           $data['author']  = ($row->author === NULL) ? "N/A" : $row->author;
                           $data['department'] = ($row->to_all == "1") ? "All" : $row->departments;
                           $data['date'] =  $row->date_created;

                           $this->load->view('components/card-announcement', $data);
                        }
                     } else {
                        // Handle case when no rows are returned
                        echo "No announcements yet.";
                     }
                  } else {
                     // Handle case when query fails
                     echo "Error executing query: " . $this->db->error()['message'];
                  }


                  ?>

               </div>