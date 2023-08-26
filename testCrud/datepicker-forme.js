class DatepickerForMe {
    debugger;
    constructor(containerSelector) {
        this.container = $(containerSelector);
        this.createUI();
        this.setupEventListeners();
    }

    createUI() {
        const dayInput = this.createSelect('day', [...Array(31).keys()].map(i => i + 1));
        const monthInput = this.createSelect('month', ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]);
        const yearInput = this.createSelect('year', [...Array(100).keys()].map(i => new Date().getFullYear() - i + 543));

        this.container.append(dayInput, monthInput, yearInput);
    }

    createSelect(id, options) {
        const select = $("<select>", { id, class: "custom-select2" });
        options.forEach((option, index) => {
            const optionElem = $("<option>", { value: index + 1, text: option });
            select.append(optionElem);
        });
        return select;
    }

    setupEventListeners() {
        const dayInput = $('#day');
        const monthInput = $('#month');
        const yearInput = $('#year');

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

        monthInput.on('change', updateDays);
        yearInput.on('change', updateDays);

        dayInput.select2({ tags: true }).on('select2:open', () => {
            setTimeout(() => {
                $('.select2-search__field').focus();
            }, 50);
        });
        monthInput.select2({ tags: true }).on('select2:open', () => {
            setTimeout(() => {
                $('.select2-search__field').focus();
            }, 50);
        });
        yearInput.select2({ tags: true }).on('select2:open', () => {
            setTimeout(() => {
                $('.select2-search__field').focus();
            }, 50);
        });
    }
}

// Export the class
export default DatepickerForMe;
