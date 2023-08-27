<!DOCTYPE html>
<html>
<head>
<style>
  /* Style for the dropdown select */
  .dropdown {
    width: 150px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
  }
</style>
</head>
<body>

<div id="addr1"></div>
<div id="addr2"></div>
<script src="data/address-data.js"></script>
<script src="manage-addr.js"></script>
<script>
  // Initialize address dropdowns for the first div

  const addr1 = new AddressDropdowns('addr1', addressData);
  addr1.init();

  const addr2 = new AddressDropdowns('addr2', addressData);
  addr2.init();
</script>

</script>

</body>
</html>
