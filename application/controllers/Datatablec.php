<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatablec extends CI_Controller {

    public function index()
    {
        $this->load->view('datatable_view');
    }

    

    public function ajax_get_data()
    {
 
        
        // Select data from the employees table
        $query = $this->db->select('id, fname, age, sex')
                          ->get('employee');

        // Return the result as JSON
        echo json_encode($query->result());
    }


    
    public function calendar_get()
    {    

        $query = $this->db->query('
        SELECT * FROM `sys_holidays` 
        ');
        foreach ($query->result() as $row) {
         echo '{';
           echo "title : '$row->holiday_name',";
           echo "start : '$row->holiday_date'";
         echo '},';
       }

        // Return the result as JSON
        echo json_encode($query->result());
    }



    
    public function convertJSDateToPHP($dateString) {
        // Extract the date and timezone from the string
        $dateTimeParts = explode(" ", $dateString);
        $date = implode(" ", array_slice($dateTimeParts, 1, 4));
        $timezone = $dateTimeParts[5];
    
        // Convert to PHP date
        $phpDate = date_create_from_format('M d Y H:i:s', $date);
    
        // Set the timezone
        date_timezone_set($phpDate, new DateTimeZone($timezone));
    
        // Format the date
        return date_format($phpDate, 'Y-m-d H:i:s');
    }

    
    public function calendar_set()
    {    
        $response = array();
		$event = $this->input->post('title');
        $date_start = $this->input->post('start');
        $date_end = $this->input->post('end');

        echo $date_start;

		$data = array(
			/*column name*/
			'holiday_name' => $event,
            'date_start' => convertJSDateToPHP($date_start),
            'date_end' => convertJSDateToPHP($date_end)


		);

        print_r($data);

		$sql = $this->db->insert('sys_holidays', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
        
    }






    


}
