class AddressDropdowns {
  constructor(containerId, data) {
    this.containerId = containerId;
    this.data = data;
    this.provinceSelect = null;
    this.amphurSelect = null;
    this.tambonSelect = null;
    this.villageSelect = null;
  }
  setInitialValuesFromHiddenInput() {
    const hiddenInput = document.getElementById(`${this.containerId}-addressCode`);
    console.log('hiddenInput.value', hiddenInput.value);

    if (hiddenInput && hiddenInput.value !== '00000000') {
      console.log('hiddenInput.value', hiddenInput.value);
    
      const addressCode = hiddenInput.value;
      const provinceCode = addressCode.slice(0, 2);
      const amphurCode = addressCode.slice(2, 4);
      const tambonCode = addressCode.slice(4, 6);

      this.provinceSelected = provinceCode;
      // this.populateDropdowns(); // This will populate the amphur dropdown based on the selected province
      this.amphurSelected = amphurCode;
      // this.populateDropdowns(); // This will populate the tambon dropdown based on the selected amphur
      this.tambonSelected = tambonCode;
      // No need to populate the village dropdown on page load
    }
  }
  init() {
    const container = document.getElementById(this.containerId);

      // Create a row div to hold the dropdowns and labels
   this.row = document.createElement("div");
    this.row.classList.add("row", "g-3");
        // Create columns for each dropdown
        debugger;
  this.colDiv1 = document.createElement("div");
  this.colDiv1.classList.add("col-12", "col-sm-4");

  this.colDiv2 = document.createElement("div");
  colDiv2.classList.add("col-12", "col-sm-4");

  this.colDiv3 = document.createElement("div");
  colDiv3.classList.add("col-12", "col-sm-4");

    this.provinceSelect = this.createDropdown("เลือกจังหวัด", "provinceSelect");
    this.amphurSelect = this.createDropdown("เลือกอำเภอ", "amphurSelect");
    this.tambonSelect = this.createDropdown("เลือกตำบล", "tambonSelect");
    this.villageSelect = this.createDropdown("เลือกหมู่บ้าน", "villageSelect");

    // Add classes to each dropdown for Bootstrap styling
    this.provinceSelect.classList.add("form-select", "valid");
    this.amphurSelect.classList.add("form-select", "valid");
    this.tambonSelect.classList.add("form-select", "valid");
    this.villageSelect.classList.add("form-select", "valid");

    // Create labels for each dropdown
    const provinceLabel = document.createElement("label");
    provinceLabel.textContent = "จังหวัด";
    provinceLabel.for = this.provinceSelect.id;
    provinceLabel.classList.add("form-label");

    const amphurLabel = document.createElement("label");
    amphurLabel.textContent = "อำเภอ";
    amphurLabel.for = this.amphurSelect.id;
    amphurLabel.classList.add("form-label");

    const tambonLabel = document.createElement("label");
    tambonLabel.textContent = "ตำบล";
    tambonLabel.for = this.tambonSelect.id;
    tambonLabel.classList.add("form-label");

    this.colDiv1.appendChild(provinceLabel);
    this.colDiv1.appendChild(this.provinceSelect);
    this.colDiv2.appendChild(amphurLabel);
    this.colDiv2.appendChild(this.amphurSelect);
    this.colDiv3.appendChild(tambonLabel);
    this.colDiv3.appendChild(this.tambonSelect);

    this.row.appendChild(this.colDiv1);
    this.row.appendChild(this.colDiv2);
    this.row.appendChild(this.colDiv3);
    

    container.appendChild(this.row);
    container.appendChild(provinceLabel);
    container.appendChild(this.provinceSelect);
    container.appendChild(amphurLabel);
    container.appendChild(this.amphurSelect);
    container.appendChild(tambonLabel);
    container.appendChild(this.tambonSelect);

    this.provinceSelect.addEventListener(
      "change",
      this.populateDropdowns.bind(this)
    );
    this.amphurSelect.addEventListener(
      "change",
      this.populateDropdowns.bind(this)
    );
    this.tambonSelect.addEventListener(
      "change",
      this.populateDropdowns.bind(this)
    );

    // Populate the province dropdown initially
    this.setInitialValuesFromHiddenInput();
    this.populateProvinceDropdown();
    if(this.provinceSelected){
      this.provinceSelect.value = this.provinceSelected;
      this.populateDropdowns();
    }
    if(this.amphurSelected){
      this.amphurSelect.value = this.amphurSelected;
      this.populateDropdowns();
    }
    if(this.tambonSelected){
      this.tambonSelect.value = this.tambonSelected;
      this.populateDropdowns();
    }
  }
  populateProvinceDropdown() {
    this.populateDropdown(
      this.provinceSelect,
      this.data.provinces,
      "prvidgen",
      "prvnmegen"
    );
  }

  createDropdown(placeholder, id) {
    const dropdown = document.createElement("select");
    dropdown.classList.add("dropdown");
    dropdown.id = `${this.containerId}-${id}`;
    const placeholderOption = document.createElement("option");
    placeholderOption.value = "";
    placeholderOption.textContent = placeholder;
    dropdown.appendChild(placeholderOption);

    // Update the labels based on the provided Thai translations
    const labels = {
      provinceSelect: "เลือกจังหวัด",
      amphurSelect: "เลือกอำเภอ",
      tambonSelect: "เลือกตำบล",
    };

    const translatedLabel = labels[id] || "";

    placeholderOption.textContent = translatedLabel;
    return dropdown;
  }

  populateDropdowns() {
    const selectedProvince = this.provinceSelect.value;
    const selectedAmphur = this.amphurSelect.value;

    // Check if the selected province or amphur has changed
    const provinceChanged = selectedProvince !== this.selectedProvince;
    const amphurChanged = selectedAmphur !== this.selectedAmphur;

    // Update the selected province and amphur
    this.selectedProvince = selectedProvince;
    this.selectedAmphur = selectedAmphur;

    if (provinceChanged) {
      const filteredAmphurs = this.data.amphurs.filter(
        (amphur) => amphur.prvidgen === selectedProvince
      );
      this.populateDropdown(
        this.amphurSelect,
        filteredAmphurs,
        "ampidgen",
        "ampnmegen"
      );
    }

    if (amphurChanged) {
      const filteredTambons = this.data.tambons.filter(
        (tambon) => tambon.ampidgen === selectedProvince + selectedAmphur
      );
      this.populateDropdown(
        this.tambonSelect,
        filteredTambons,
        "tmbidgen",
        "tmbnmegen"
      );
    }

    // Update the hidden input with the concatenated address code
    this.updateHiddenInput();
  }

  populateDropdown(dropdown, data, valueKey, textKey) {
    dropdown.innerHTML = "";

    // Update the placeholder option based on dropdown id
    const labels = {
      provinceSelect: "เลือกจังหวัด",
      amphurSelect: "เลือกอำเภอ",
      tambonSelect: "เลือกตำบล",
      villageSelect: "เลือกหมู่บ้าน",
    };

    const translatedLabel = labels[dropdown.id.split("-")[1]] || "";

    const placeholderOption = document.createElement("option");
    placeholderOption.value = "";
    placeholderOption.textContent = translatedLabel;
    dropdown.appendChild(placeholderOption);

    // Populate the dropdown with translated options
    data.forEach((item) => {
      const option = document.createElement("option");
      option.value = item[valueKey];
      option.textContent = item[textKey];
      dropdown.appendChild(option);
    });
    this.updateHiddenInput();
  }

  updateHiddenInput() {
    const concatenatedAddressCode = this.getConcatenatedAddressCode();
    const hiddenInputId = `${this.containerId}-addressCode`;
    const hiddenInput = document.getElementById(hiddenInputId);
    if (hiddenInput) {
      hiddenInput.value = concatenatedAddressCode;
    }
  }

  getConcatenatedAddressCode() {
    const provinceCode = this.provinceSelect.value || "";
    const amphurCode = this.amphurSelect.value || "";
    const tambonCode = this.tambonSelect.value || "";
    const villageCode = this.villageSelect.value || "";

    // Ensure each part of the address code is 2 digits
    const paddedProvince = provinceCode.padStart(2, "0");
    const paddedAmphur = amphurCode.padStart(2, "0");
    const paddedTambon = tambonCode.padStart(2, "0");
    const paddedVillage = villageCode.padStart(2, "0");

    return `${paddedProvince}${paddedAmphur}${paddedTambon}${paddedVillage}`;
  }
}

// Export the AddressDropdowns class
if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
  module.exports = AddressDropdowns;
}
