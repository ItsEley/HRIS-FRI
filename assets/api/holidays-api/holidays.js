const fs = require('fs');

// Read the contents of the JSON file
fs.readFile('C:\\xampp\\htdocs\\HRIS-FRI\\assets\\api\\holidays-api\\result_holidays.json', 'utf8', (err, data) => {
  if (err) {
    console.error('Error reading file:', err);
    return;
  }

  try {
    // Parse the JSON data
    const holidaysData = JSON.parse(data);
    // console.log('Data:', holidaysData);

    let count = 0;
    holidaysData.forEach(element => {
      if (element.primary_type != 'Season' && element.primary_type != 'Common local holiday') {
        console.log("Holiday [" + count + "]: ", element.name);
        console.log("Description : ", element.description);
        console.log("Date : ", element.date.iso);
        console.log("Primary_type : ", element.primary_type);
    
        console.log('=========================== \n');
        count++;
    }
    
    });
  } catch (error) {
    console.error('Error parsing JSON:', error);
  }
});
