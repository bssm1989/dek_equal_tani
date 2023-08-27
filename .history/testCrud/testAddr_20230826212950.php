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

<script src="manage-addr.js"></script>
<script>
  // Initialize address dropdowns for the first div
  const addr1 = new AddressDropdowns('addr1');
  addr1.init();

  // Initialize address dropdowns for the second div
  const addr2 = new AddressDropdowns('addr2');
  addr2.init();
</script>

</body>
</html>
