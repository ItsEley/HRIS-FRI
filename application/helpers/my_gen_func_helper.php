<?php


function getSubstringBetween($string, $start, $end) {
    $startPos = strpos($string, $start);
    $endPos = strpos($string, $end, $startPos + strlen($start) + 1);

    if ($startPos !== false && $endPos !== false) {
        $substring = substr($string, $startPos + strlen($start), $endPos - $startPos - strlen($start));
        return $substring;
    }

    return false; // Return false if start or end not found
}


function formatDateTime($dateString) {
    $dateTime = new DateTime($dateString);
    return $dateTime->format('M j, Y g:i A');
}

function formatDateOnly($dateString) {
    $dateTime = new DateTime($dateString);
    return $dateTime->format('M j, Y');
}

function formatTimeOnly($dateString) {
    $dateTime = new DateTime($dateString);
    return $dateTime->format('g:i A');
}


function formatAddress($addressString){
    $formatted_address = preg_replace('/,+/', ',', ltrim($addressString, ','));
    return $formatted_address;
}


function generateRandomNumber($min,$max) {
    // Generate a random number (NNNNN)  
    $randomNumber = mt_rand($min, $max);

    return $randomNumber;
}


function hashPassword($password) {
    // Generate a bcrypt hash of the password
    $options = [
        'cost' => 12, // You can adjust the cost according to your needs
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}


// Function to verify a password against its hash and return 1 or 0
function verify($plaintextPassword,$hashedPassword) {
   
    // Verify the password against its hash
    if (password_verify($plaintextPassword, $hashedPassword)) {
        return 1; // Return 1 if verification is successful
    } else {
        return 0; // Return 0 if verification fails
    }
}





// function generateEmployeeID($prefix,$name) {
//     // Default prefix


//     // Extract initials from name
//     $initials = "";
//     $words = explode(" ", $name);
//     foreach ($words as $word) {
//         $initials .= strtoupper(substr($word, 0, 1));
//     }

//     // Generate unique random number
//     $randomNumber = generateRandomNumber(0,99999);

//     // Construct ID
//     $employeeID = $prefix . $initials . "-" . str_pad($randomNumber, 5, '0', STR_PAD_LEFT);

//     return $employeeID;
// }






function generateEmployeeCode($name)
{
	// Split the name into parts
	$nameParts = explode(' ', $name);

	// Extract the first letter of the first name, middle name, and last name
	$fnameInitial = strtoupper(substr($nameParts[0], 0, 1));
	$mnameInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '';
	$lnameInitial = strtoupper(substr(end($nameParts), 0, 1));

	// Generate a random 5-digit number
	$randomDigits = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

	// Construct the employee code
	$employeeCode = "FC{$fnameInitial}{$mnameInitial}{$lnameInitial}-{$randomDigits}";

	return $employeeCode;
}



function format_text($string){

    $string = strtolower($string);
    $string = ucwords($string); 
    return $string;


}



?>