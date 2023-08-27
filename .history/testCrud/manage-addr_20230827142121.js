class AddressDropdowns {
  constructor(containerId, data) {
    this.containerId = containerId;
    this.data = data;
    this.provinceSelect = null;
    this.amphurSelect = null;
    this.tambonSelect = null;
    this.villageSelect = null;
  }

  init() {
    const container = document.getElementById(this.containerId);

    this.provinceSelect = this.createDropdown('Select Province', 'provinceSelect');
    this.amphurSelect = this.createDropdown('Select Amphur', 'amphurSelect');
    this.tambonSelect = this.createDropdown('Select Tambon', 'tambonSelect');
    this.villageSelect = this.createDropdown('Select Village', 'villageSelect');

    container.appendChild(this.provinceSelect);
    container.appendChild(this.amphurSelect);
    container.appendChild(this.tambonSelect);
    container.appendChild(this.villageSelect);

    this.provinceSelect.addEventListener('change', this.populateDropdowns.bind(this));
    this.amphurSelect.addEventListener('change', this.populateDropdowns.bind(this));
    this.tambonSelect.addEventListener('change', this.populateDropdowns.bind(this));

    // Populate the province dropdown initially
    this.populateProvinceDropdown();
  }

  populateProvinceDropdown() {
    this.populateDropdown(this.provinceSelect, this.data.provinces, 'prvidgen', 'prvnmegen');
  }

  createDropdown(placeholder, id) {
    const dropdown = document.createElement('select');
    dropdown.classList.add('dropdown');
    dropdown.id = `${this.containerId}-${id}`;
    const placeholderOption = document.createElement('option');
    placeholderOption.value = '';
    placeholderOption.textContent = placeholder;
    dropdown.appendChild(placeholderOption);
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
      const filteredAmphurs = this.data.amphurs.filter(amphur => amphur.prvidgen === selectedProvince);
      this.populateDropdown(this.amphurSelect, filteredAmphurs, 'ampidgen', 'ampnmegen');
    }
  
    if (amphurChanged) {
      const filteredTambons = this.data.tambons.filter(tambon => tambon.ampidgen === selectedProvince+selectedAmphur);
      this.populateDropdown(this.tambonSelect, filteredTambons, 'tmbidgen', 'tmbnmegen');
    }
  
    // Update the hidden input with the concatenated address code
    this.updateHiddenInput();
  }
  

  populateDropdown(dropdown, data, valueKey, textKey) {
    dropdown.innerHTML = '';
    const placeholderOption = document.createElement('option');
    placeholderOption.value = '';
    placeholderOption.textContent = `Select ${dropdown.id.charAt(0).toUpperCase() + dropdown.id.slice(1)}`;
    dropdown.appendChild(placeholderOption);

    data.forEach(item => {
      const option = document.createElement('option');
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
    const provinceCode = this.provinceSelect.value || '';
    const amphurCode = this.amphurSelect.value || '';
    const tambonCode = this.tambonSelect.value || '';
    const villageCode = this.villageSelect.value || '';

    // Ensure each part of the address code is 2 digits
    const paddedProvince = provinceCode.padStart(2, '0');
    const paddedAmphur = amphurCode.padStart(2, '0');
    const paddedTambon = tambonCode.padStart(2, '0');
    const paddedVillage = villageCode.padStart(2, '0');

    return `${paddedProvince}${paddedAmphur}${paddedTambon}${paddedVillage}`;
  }

}

// Export the AddressDropdowns class
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = AddressDropdowns;
}
