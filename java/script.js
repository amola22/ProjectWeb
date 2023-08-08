function deleteRow(event, button) {
    event.preventDefault(); // prevent the default behavior of the button click
    var row = button.parentNode.parentNode; // get the row containing the clicked button
    row.parentNode.removeChild(row); // remove the row from the table
  }
  