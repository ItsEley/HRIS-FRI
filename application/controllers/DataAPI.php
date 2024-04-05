<?php

use Mpdf\PsrHttpMessageShim\Response;

defined('BASEPATH') or exit('No direct script access allowed');

class DataAPI extends CI_Controller
{

    public function index()
    {
        $this->load->view('datatable_view');
    }


    public function insert_holiday()
    {

        // Set your API key
$api_key = 'zkQ4Ee61n5fyx9iv4psfjg6y7WxnPtad';

// Set the country code and year for which you want to get holidays
$country_code = 'PH'; // Example: United States
$year = date('Y'); // Example: 2022

// Construct the API endpoint URL
$api_url = "https://calendarific.com/api/v2/holidays?api_key=$api_key&country=$country_code&year=$year";

   

// Make the API request
$response = file_get_contents($api_url);


        // Check if the request was successful
        if ($response === false) {
            // Handle error
            echo 'Error fetching data from the API';
        } else {

            try {
                //code...
// Decode the JSON response if applicable
$data = json_decode($response, true);
$holiday_data = $data['response']['holidays'];

foreach ($holiday_data as $holiday) {
    // Check if a record with the same holiday name and start date exists
    $existing_holiday = $this->db->get_where('sys_holidays', array(
        'holiday_name' => $holiday['name'],
        'date_start' => $holiday['date']['iso']
    ))->row();

    // If no duplicate found, insert the holiday data
    if (!$existing_holiday) {
        // Construct the data array for insertion
        $data = array(
            'holiday_name' => $holiday['name'],
            'holiday_description' => $holiday['description'],
            'date_start' => $holiday['date']['iso'], // Assuming this is the start date of the holiday
            'date_end' => $holiday['date']['iso'], // Assuming this is the end date of the holiday, modify if necessary
            'is_workday' => 0, // Assuming this field indicates if it's a workday, change as per your table structure
            'date_created' => date('Y-m-d H:i:s') // Assuming you want to set the current date as date_created
        );

        // Insert data into the sys_holidays table
        $this->db->insert('sys_holidays', $data);
    }
}

                return "Holidays has been updated successfully!";
                // return $response;

            } catch (\Throwable $th) {
                //throw $th;
                return "An error occured! Updating holidays has failed due to $th";

            }
          
        }
    }
}
