<?php
include_once 'layout/header.php';
?>

<style>
    .item {
        position: relative;
    }

    .item .close-btn {
        position: absolute;
        top: 4px;
        right: 4px;
    }
</style>

<div class="container">
    <h4>Contact Form </h4>
    <a href="<?php echo url('/') ?> "> Back to List </a>
    <form method="post" action="<?php url('submit-form') ; ?>" id="DataEntryForm">
        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Buyer Name * </label>
                    <input type="text" data-validate="noSpecialChar|limit:5,50" class="form-control" name="buyer" required>
                    <div class="invalid-feedback">
                        Must be All Character without Special Character & minimum length 5
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Buyer Email *</label>
                    <input type="text" class="form-control" data-validate="email" name="buyer_email" required>
                    <div class="invalid-feedback">
                        Please input a valid email address
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>City  *</label>
                    <input type="text" class="form-control" data-validate="letter|limit:1,20" name="city" required>
                    <div class="invalid-feedback">
                        Only Letter.Min 1 Max 20
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Phone  *</label>
                    <input type="text" class="form-control" data-validate="mobile|limit:11,11"   name="phone" required>
                    <div class="invalid-feedback">
                        Must be Only mobile Number, start with 0
                    </div>
                </div>
            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label>Amount *</label>
                    <input type="number"  data-validate="number" class="form-control" name="amount" required>
                    <div class="invalid-feedback">
                        Must be Only Number
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Receipt ID *</label>
                    <input type="text" class="form-control" data-validate="limit:1,20" name="receipt_id" required>
                    <div class="invalid-feedback">
                        Must be text  . Min 1 and max 20.
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group" id="itemsArea">
                    <h6>Items *
                        <button type="button" class="btn btn-primary btn-sm float-right" id="addItem">Add Item</button>
                    </h6>
                    <div class="item  mb-2">
                        <input type="text" class="form-control" data-validate="letter|limit:1,50" name="items[]" required>
                        <div class="invalid-feedback">
                            must text. Min 1 max 50
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Note *</label>
                    <textarea class="form-control" data-validate="wordLimit:2,30" name="note" required> </textarea>
                    <div class="invalid-feedback">
                        Must input minimum 2 word and max 30 word
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label for="email">Entry By * :</label>
                <input type="text" class="form-control"  data-validate="number" name="entry_by" required>
                <div class="invalid-feedback">
                    Must be Only mobile Number
                </div>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>

<script src="assets/fieldValidator.js"></script>
<script>

    let newItem = `<div class="item  mb-2">
                        <input type="text" class="form-control" data-validate="letter|limit:1,50" name="items[]" required>
                        <div class="invalid-feedback">
                            must text. Min 1 max 50
                        </div>
                        <button type="button" class="btn btn-danger btn-sm close-btn" > × </button>
                    </div>`;

    addItem.onclick = function (event) {
        event.preventDefault();
        $("#itemsArea").append(newItem)
    };

    $("#itemsArea").on('click', '.close-btn', function () {
        $(this).closest('.item').remove();
    });



    // form validator

    $("#DataEntryForm").submit(function (e) {
        e.preventDefault();


        if (!fieldValidator.check(DataEntryForm)) {
            webToast.Danger({
                status: 'Sorry !',
                message: 'Please check your input'
            });
            return false;
        }

        let formData = new URLSearchParams([...new FormData(e.target).entries()]);

        fetch("<?php echo url('submit-form') ?>", {
            method: 'post',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: formData
        }).then(function (response) {
            if (response.status === 200) {
                DataEntryForm.reset();
                $("#dataEntryModal").modal('hide');

                webToast.Success({
                    status: 'Success !',
                    message: 'Data Saved Successfully'
                });

                setTimeout(function () {
                    window.location.replace("<?php echo url('/') ?>");
                }, 600);
            } else {
                webToast.Danger({
                    status: 'Sorry !',
                    message: 'Something went wrong.'
                });
            }

        })
    });

    fieldValidator.initValueChecker(DataEntryForm);

</script>


<?php
include_once 'layout/footer.php';
?>
