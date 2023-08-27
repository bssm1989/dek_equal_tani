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
                <div id="addr1">
                <div class="notification"></div> 
                </div>

            </div>

            <div class="form-group">
                <label for="addr2">Address 2:</label>
                <div id="addr2">
                <div class="notification"></div> 
                </div>
            </div>

            <div class="form-group">
                <label for="addr3">Address 3:</label>
                <div id="addr3">
                <div class="notification"></div> 
                </div>
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
            $.validator.addMethod('eightDigits', function(value, element) {
                return this.optional(element) || /^[0-9]{8}$/.test(value);
            }, 'Please enter an 8-digit code.');

            $('#editForm').validate({
                rules: {
                    name: 'required',
                    'addr1-addressCode': {
                        required: true,
                        eightDigits: true
                    },
                    'addr2-addressCode': {
                        required: true,
                        eightDigits: true
                    }
                },
                messages: {
                    name: 'Please enter your name',
                    'addr1-addressCode': {
                        required: 'Please enter an address code',
                        eightDigits: 'Please enter an 8-digit code.'
                    },
                    'addr2-addressCode': {
                        required: 'Please enter an address code',
                        eightDigits: 'Please enter an 8-digit code.'
                    }
                },
                errorPlacement: function(error, element) {
                    // Show the error message inside the corresponding notification div
                    element.closest('.notification').html(error);
                },
                submitHandler: function(form) {
                    // Form submission code here
                },
            });
        });
    </script>

</body>

</html>