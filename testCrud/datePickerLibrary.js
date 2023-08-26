function initializeDatePicker(elementId) {
    const container = document.getElementById(elementId);
    if (!container) return;

    container.innerHTML = `
        <label class="mr-2">วัน:</label>
        <select class="day form-control custom-select2 d-inline-block w-auto mr-3"></select>

        <label class="mr-2">เดือน:</label>
        <select class="month form-control custom-select2 d-inline-block w-auto mr-3"></select>

        <label class="mr-2">ปี:</label>
        <select class="year form-control custom-select2 d-inline-block w-auto"></select>
    `;

    const daySelect = $(container).find('.day');
    const monthSelect = $(container).find('.month');
    const yearSelect = $(container).find('.year');

    // Initialize Select2
    
    // Initialize Select2 with focus
    daySelect.select2({ dropdownParent: container, tags: true }).on('select2:open', () => {
        setTimeout(() => {
            document.querySelector('.select2-search__field').focus();
        }, 50);
    });
    monthSelect.select2({ dropdownParent: container, tags: true }).on('select2:open', () => {
        setTimeout(() => {
            document.querySelector('.select2-search__field').focus();
        }, 50);
    });
    yearSelect.select2({ dropdownParent: container, tags: true }).on('select2:open', () => {
        setTimeout(() => {
            document.querySelector('.select2-search__field').focus();
        }, 50);
    });

    // Thai months
    const months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    months.forEach((month, index) => {
        monthSelect.append(new Option(month, index + 1));
    });

    // Buddhist era years
    const currentYearGregorian = new Date().getFullYear();
    const currentYearBuddhist = currentYearGregorian + 543;
    for (let i = currentYearBuddhist; i >= currentYearBuddhist - 100; i--) {
        yearSelect.append(new Option(i, i));
    }

    function updateDays() {
        const month = parseInt(monthSelect.val());
        const year = parseInt(yearSelect.val()) - 543;
        let days = 31;
        if (month === 2) {
            days = (year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0)) ? 29 : 28;
        } else if ([4, 6, 9, 11].includes(month)) {
            days = 30;
        }

        daySelect.empty();
        for (let i = 1; i <= days; i++) {
            daySelect.append(new Option(i, i));
        }
    }
    updateDays();

    monthSelect.on('change', updateDays);
    yearSelect.on('change', updateDays);
}

function getDateValue(elementId) {
    const container = document.getElementById(elementId);
    if (!container) return;

    const day = $(container).find('.day').val();
    const month = $(container).find('.month').val();
    const year = $(container).find('.year').val();

    return {
        day: day,
        month: month,
        year: year
    };
}
