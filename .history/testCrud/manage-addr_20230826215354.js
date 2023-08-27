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
      const selectedTambon = this.tambonSelect.value;
  
      const filteredAmphurs = this.data.amphurs.filter(amphur => amphur.prvidgen === selectedProvince);
      const filteredTambons = this.data.tambons.filter(tambon => tambon.ampidgen === selectedAmphur);
      const filteredVillages = this.data.villages.filter(village => village.tmbidgen === selectedTambon);
  
      this.populateDropdown(this.amphurSelect, filteredAmphurs, 'ampidgen', 'ampnmegen');
      this.populateDropdown(this.tambonSelect, filteredTambons, 'tmbidgen', 'tmbnmegen');
      this.populateDropdown(this.villageSelect, filteredVillages, 'vllidgen', 'vllnmegen');
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
    }
  
    getConcatenatedAddressCode() {
      const provinceCode = this.provinceSelect.value || '';
      const amphurCode = this.amphurSelect.value || '';
      const tambonCode = this.tambonSelect.value || '';
      const villageCode = this.villageSelect.value || '';
      return `${provinceCode}${amphurCode}${tambonCode}${villageCode}`;
    }
  }
  
  // Export the AddressDropdowns class
  if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = AddressDropdowns;
  }
  