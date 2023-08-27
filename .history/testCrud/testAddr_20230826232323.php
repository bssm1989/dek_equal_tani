<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <form id="editForm">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="addr1">Address 1:</label>
        <div id="addr1"></div>
        <input type="hidden" id="addr1-addressCode" name="addr1-addressCode">
      </div>

      <div class="form-group">
        <label for="addr2">Address 2:</label>
        <div id="addr2"></div>
        <input type="hidden" id="addr2-addressCode" name="addr2-addressCode">
      </div>

      <div class="form-group">
        <label for="addr3">Address 3:</label>
        <div id="addr3"></div>
        <input type="hidden" id="addr3-addressCode" name="addr3-addressCode">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="manage-addr.js"></script>
  <script>
    $(document).ready(function() {
      const addressData = {
        provinces: [...], // Your province data
        amphurs: [...],   // Your amphur data
        tambons: [...],   // Your tambon data
        villages: [...]   // Your village data
      };

      const addr1 = new AddressDropdowns('addr1', addressData);
      addr1.init();

      const addr2 = new AddressDropdowns('addr2', addressData);
      addr2.init();

      const addr3 = new AddressDropdowns('addr3', addressData);
      addr3.init();

      $("#editForm").validate({
        rules: {
          name: "required",
          "addr1-addressCode": "required",
          "addr2-addressCode": "required",
          "addr3-addressCode": "required"
        },
        messages: {
          name: "Please enter your name",
          "addr1-addressCode": "Please select an address",
          "addr2-addressCode": "Please select an address",
          "addr3-addressCode": "Please select an address"
        },
        submitHandler: function(form) {
          // Form validation passed, show form data in console
          const formData = $(form).serialize();
          console.log("Form data:", formData);
          return false; // Prevent form submission
        }
      });
    });
  </script>
</body>
</html>
