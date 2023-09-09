import DatepickerForMe from './datepicker-forme.js';

// Create instances for each datepicker container
const datepicker1 = new DatepickerForMe('#datepicker-container');
const datepicker2 = new DatepickerForMe('#datepicker2');

// Add event listener to the submit button
const submitButton = document.getElementById('submit-button');
submitButton.addEventListener('click', () => {
    console.log("Submit button clicked");
    const selectedDate1 = datepicker1.getValue('#datepicker-container');
    const selectedDate2 = datepicker2.getValue('#datepicker2');
    console.log("Selected Date from datepicker1:", selectedDate1);
    console.log("Selected Date from datepicker2:", selectedDate2);
});
