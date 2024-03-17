<?php

// API endpoint URL
$url = 'https://holidayapi.com/v1/holidays?pretty&key=a3721957-310a-4127-b58a-0944efcf62e2&country=PH&year=2023';

// Make the API call using file_get_contents
$response = file_get_contents($url);

// Check if the request was successful
if ($response === false) {
    // Handle error
    echo 'Error fetching data from the API';
} else {
    // Decode the JSON response if applicable
    $data = json_decode($response, true);

    // Do something with the data
    // print_r($data);
}

if($data['status'] == '200'){

    echo count($data['holidays']);

    for($i = 0 ; $i < count($data['holidays'])- 1; $i++){
        echo $data['holidays'][$i]['name'];
    }
    



}

?>
