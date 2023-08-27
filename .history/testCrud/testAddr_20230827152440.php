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
                <div id="addr1"  class="address">
                    <input type="hidden" id="addr1-addressCode" name="addr1-addressCode">

                    <div class="notification"></div>
                </div>

            </div>

            <div class="form-group">
                <label for="addr2">Address 2:</label>
                <div id="addr2"  class="address">
                    <input type="hidden" id="addr2-addressCode" name="addr2-addressCode">

                    <div class="notification"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="addr3">Address 3:</label>
                <div id="addr3"  class="address">
                    <input type="hidden" id="addr3-addressCode" name="addr3-addressCode">

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
                console.log('Custom validation method called:', value, element);

                const isValid = /^[0-9]{8}$/.test(value) && value !== '00000000';
                console.log('Validation result:', isValid);

                return this.optional(element) || isValid;
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
                ignore: [],
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

                    // Add red border to the address div
                    element.closest('.address').css('border', '2px solid red');
                },
                success: function(label, element) {
                    // Remove red border when validation succeeds
                    $(element).closest('.address').css('border', 'none');
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