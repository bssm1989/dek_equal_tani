const addressData = {
    provinces: [
      { prvidgen: '01', prvnmegen: 'Bangkok' },
      { prvidgen: '02', prvnmegen: 'Chiang Mai' },
      // ... more province data
    ],
    amphurs: [
      { ampidgen: '01', ampnmegen: 'Amphur A', prvidgen: '01' },
      { ampidgen: '02', ampnmegen: 'Amphur B', prvidgen: '02' },
      // ... more amphur data
    ],
    tambons: [
      { tmbidgen: '01', tmbnmegen: 'Tambon X', ampidgen: '01' },
      { tmbidgen: '02', tmbnmegen: 'Tambon Y', ampidgen: '02' },
      // ... more tambon data
    ],
    villages: [
      { vllidgen: '01', vllnmegen: 'Village 1', tmbidgen: '01' },
      { vllidgen: '02', vllnmegen: 'Village 2', tmbidgen: '02' },
      // ... more village data
    ]
  };
  
  // Export the addressData object
  if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = addressData;
  }
  
  