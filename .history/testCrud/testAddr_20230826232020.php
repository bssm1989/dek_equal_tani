<!DOCTYPE html>
<html>
<head>
  <!-- Include necessary libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  
  <!-- Include your custom scripts -->
  <script src="data/address-data.js"></script>
  <script src="manage-addr.js"></script>

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

<!-- Edit Form -->
<form id="editForm" action="submit.php" method="post">
  <div>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
  </div>

  <!-- Address Div 1 -->
  <div id="addr1"></div>

  <!-- Address Div 2 -->
  <div id="addr2"></div>

  <!-- Address Div 3 -->
  <div id="addr3"></div>

  <!-- Hidden fields for concatenated address codes -->
  <input type="hidden" id="addr1-addressCode" name="addr1-addressCode">
  <input type="hidden" id="addr2-addressCode" name="addr2-addressCode">
  <input type="hidden" id="addr3-addressCode" name="addr3-addressCode">

  <button type="submit">Submit</button>
</form>

<script>
  $(document).ready(function() {
    // Initialize address dropdowns for each div
    const addr1 = new AddressDropdowns('addr1', addressData);
    addr1.init();

    const addr2 = new AddressDropdowns('addr2', addressData);
    addr2.init();

    const addr3 = new AddressDropdowns('addr3', addressData);
    addr3.init();

    // Initialize form validation
    $("#editForm").validate({
      rules: {
        name: "required",
        "addr1-addressCode": "required",
        "addr2-addressCode": "required",
        "addr3-addressCode": "required"
      },
      messages: {
        name: "Please enter your name",
        "addr1-addressCode": "Please select address",
        "addr2-addressCode": "Please select address",
        "addr3-addressCode": "Please select address"
      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
</script>

</body>
</html>
