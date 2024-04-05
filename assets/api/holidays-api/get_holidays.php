<?php
// Set your API key
$api_key = 'zkQ4Ee61n5fyx9iv4psfjg6y7WxnPtad';

// Set the country code and year for which you want to get holidays
$country_code = 'PH'; // Example: United States
$year = '2024'; // Example: 2022

// Construct the API endpoint URL
$api_url = "https://calendarific.com/api/v2/holidays?api_key=$api_key&country=$country_code&year=$year";

// Make the API request
$response = file_get_contents($api_url);

// Check if the request was successful
if ($response === false) {
    echo "Error: Unable to fetch data from Calendarific API.";
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    print_r($data);
}

 // Check if the response contains any holidays
    // if (isset($data['response']['holidays']) && !empty($data['response']['holidays'])) {
    //     // Loop through each holiday and display its details
    //     foreach ($data['response']['holidays'] as $holiday) {
    //         echo "Name: " . $holiday['name'] . "<br>";
    //         echo "Date: " . $holiday['date']['iso'] . "<br>";
    //         echo "Type: " . $holiday['type'] . "<br>";
    //         echo "Description: " . $holiday['description'] . "<br>";
    //         echo "------------------------<br>";
    //     }
    // } else {
    //     echo "No holidays found for the specified country and year.";
    // }
?>


