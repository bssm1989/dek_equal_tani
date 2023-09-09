class DatepickerForMe {
    
    constructor(containerSelector) {
        this.container = $(containerSelector);
        this.createUI(containerSelector);
        this.setupEventListeners(containerSelector);
    }

    createUI(containerSelector) {
        const spi = containerSelector.replace('#', '');
        
        const dayLabel = $("<label>", { for: 'day' + spi, text: 'Day', style: 'padding: 2px 5px 0;' });
        const dayInput = this.createSelect('day' + spi, [...Array(31).keys()].map(i => i + 1));
        
        const monthLabel = $("<label>", { for: 'month' + spi, text: 'Month', style: 'padding: 2px 5px 0;' });
        const monthInput = this.createSelect('month' + spi, ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]);
        
        const yearLabel = $("<label>", { for: 'year' + spi, text: 'Year', style: 'padding: 2px 5px 0;' });
        const yearInput = this.createSelect('year' + spi, [...Array(100).keys()].map(i => new Date().getFullYear() - i + 543));
        
        const inputGroup = $("<div>", { class: "input-group" })
            .append(dayLabel, dayInput)
            .append(monthLabel, monthInput)
            .append(yearLabel, yearInput);
        
        this.container.append(inputGroup);
    }
    
    

    createSelect(id, options) {
        const select = $("<select>", { id, class: "custom-select custom-select-lg" });
        options.forEach((option, index) => {
            const optionElem = $("<option>", { value: index + 1, text: option });
            select.append(optionElem);
        });
        return select;
    }

    setupEventListeners(containerSelector) {
        const spi = containerSelector.replace('#', '');

        const dayInput = $('#day'+spi);
        const monthInput = $('#month'+spi);
        const yearInput = $('#year'+spi);

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
                const option = new Option(i, i);
                dayInput.append(option);
            }
        }

        monthInput.on('change', updateDays);
        yearInput.on('change', updateDays);

     
        dayInput.select2({ tags: true }).on('select2:open', () => {
           
            setTimeout(function() {
                document.querySelector('.select2-search__field').focus();
                }, 50);
        });
        // monthInput.select2({ tags: true }).on('select2:open', () => {
        //     setTimeout(function() {
        //     document.querySelector('.select2-search__field').focus();
        //     }, 50);
        // });
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
    }
    getValue(containerSelector) {
        const spi = containerSelector.replace('#', '');
        return {
            day: $('#day' + spi).val(),
            month: $('#month' + spi).val(),
            year: $('#year' + spi).val()
        };
    }
}

// No export statement here
export default DatepickerForMe;