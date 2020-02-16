<div class="container contact-form">

    <form id="enquiry">
        <h3>Send Contact Form</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                </div>
                <div class="form-group">
                    <input type="number" name="phone" class="form-control" placeholder="Your Phone Number *" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="contact-image">
                        <img src="https://cdn3.iconfinder.com/data/icons/ui-glyph-blue-03-of-5/100/UI_Blue_3_of_3_4-512.png" alt="rocket_contact"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

    (function($) {
        $('#enquiry').submit(function (event) {

            event.preventDefault();

            var endpoint = '<?php echo admin_url('admin-ajax.php');?>';

            var form = $('#enquiry').serialize();

            var formdata = new FormData;

            // Send Action
            formdata.append('action', 'enquiry');

            // Send Data
            formdata.append('enquiry', form);

            $.ajax(endpoint, {
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,

                success: function (res) {
                    alert(res.data);
                },


                error: function (err) {

                }
            })

        })

    })(jQuery)

</script>