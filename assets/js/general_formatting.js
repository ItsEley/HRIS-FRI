// Function to get substring between two strings
function getSubstringBetween(string, start, end) {
	let startPos = string.indexOf(start);
	let endPos = string.indexOf(end, startPos + start.length + 1);

	if (startPos !== -1 && endPos !== -1) {
		return string.substring(startPos + start.length, endPos);
	}

	return false; // Return false if start or end not found
}

// Function to format date and time
function formatDateTime(dateString) {
	let dateTime = new Date(dateString);
	return dateTime.toLocaleString("en-US", {
		month: "short",
		day: "numeric",
		year: "numeric",
		hour: "numeric",
		minute: "numeric",
		hour12: true,
	});
}

// Function to format date only
function formatDateOnly(dateString) {
	let dateTime = new Date(dateString);
	return dateTime.toLocaleString("en-US", {
		month: "short",
		day: "numeric",
		year: "numeric",
	});
}

// Function to format time only
function formatTimeOnly(dateString) {
	let dateTime = new Date(dateString);
	return dateTime.toLocaleString("en-US", {
		hour: "numeric",
		minute: "numeric",
		hour12: true,
	});
}

// Function to format address
function formatAddress(addressString) {
	return addressString.replace(/,+/, ",").replace(/^,+/, "");
}

// Function to generate a random number within a range
function generateRandomNumber(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}


function date_padding(number) {
    return (number < 10 ? '0' : '') + number;
}