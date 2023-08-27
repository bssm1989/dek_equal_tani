<!DOCTYPE html>
<html>
<head>
  <title>Edit Form with Address</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <form id="editForm" class="needs-validation" novalidate>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">Please enter a name.</div>
      </div>

      <div class="form-group">
        <label for="addr1">Address 1:</label>
        <div id="addr1"></div>
      </div>

      <div class="form-group">
        <label for="addr2">Address 2:</label>
        <div id="addr2"></div>
      </div>

      <div class="form-group">
        <label for="addr3">Address 3:</label>
        <div id="addr3"></div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="data/address-data.js"></script>
  <script src="manage-addr.js"></script>
  <script>
    $(document).ready(function() {
      const addr1 = new AddressDropdowns('addr1', addressData);
      addr1.init();

      const addr2 = new AddressDropdowns('addr2', addressData);
      addr2.init();

      const addr3 = new AddressDropdowns('addr3', addressData);
      addr3.init();

      $('#editForm').validate({
        rules: {
          name: 'required',
        },
        messages: {
          name: 'Please enter a name.',
        },
        submitHandler: function(form) {
          if ($('#editForm').valid()) {
            console.log('Form submitted successfully.');
            console.log('Name:', $('#name').val());
            console.log('Address 1:', addr1.getConcatenatedAddressCode());
            console.log('Address 2:', addr2.getConcatenatedAddressCode());
            console.log('Address 3:', addr3.getConcatenatedAddressCode());
          }
        }
      });
    });
  </script>
</body>
</html>
