$(".custom-select2").select2({
    dropdownParent: $(".container"), // Use container as parent to control position
    minimumResultsForSearch: -1, // Disable default search box
});
const dayInput = $('#day');
const monthInput = $('#month');
const yearInput = $('#year');

// Fill the day dropdown
function updateDays() {
    const monthIndex = monthInput.val();
    let days = 31;
    if (monthIndex === "2") {
        const year = parseInt(yearInput.val()) - 543;
        if (year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0)) {
            days = 29;
        } else {
            days = 28;
        }
    } else if (["4", "6", "9", "11"].includes(monthIndex)) {
        days = 30;
    }
    dayInput.empty();
    for (let i = 1; i <= days; i++) {
        dayInput.append(new Option(i, i));
    }
}

// Thai months
const months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
months.forEach((month, index) => {
    monthInput.append(new Option(month, index + 1));
});

// Fill the year dropdown, considering the Buddhist era
const currentYearGregorian = new Date().getFullYear();
const currentYearBuddhist = currentYearGregorian + 543;
for (let i = currentYearBuddhist; i >= currentYearBuddhist - 100; i--) {
    yearInput.append(new Option(i, i));
}

// Initialize Select2 with the tags option
// put setTimeout to fix select2 focus bug
dayInput.select2({ tags: true }).on('select2:open', () => {
    setTimeout(function() {
        
    document.querySelector('.select2-search__field').focus();

    }, 50);
});
monthInput.select2({ tags: true }).on('select2:open', () => {
    setTimeout(function() {
    document.querySelector('.select2-search__field').focus();
    }, 50);
});
yearInput.select2({ tags: true }).on('select2:open', () => {
    setTimeout(function() {
    document.querySelector('.select2-search__field').focus();
    }, 50);
});


$(document).on('click', '.select2-container', function (e) {
    if ($(this).hasClass('select2-container--open')) {
        setTimeout(function() {
            $('.select2-search__field').focus();
        }, 0);
    }
});

// Add event listeners to update the days when the month or year is changed
monthInput.on('change', updateDays);
yearInput.on('change', updateDays);

updateDays();