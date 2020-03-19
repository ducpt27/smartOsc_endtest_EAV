$(document).ready(function() {
    $('#btn-form--submit').click(function() {
        $('form[name="form-product"]').submit();
    });
    $('form[name="form-product"]').validate({
        rules: validation['rules'],
        submitHandler: function(form) {
            $.ajax({
                type: form.method,
                url: form.action,
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function(html) {
                    resetForm();
                    if (html == "success") {
                        $('.notify').addClass('success');
                        $('.notify').text("Add product success");
                    } else {
                        $('.notify').addClass('err');
                        $('.notify').text(html);
                    }
                }
            });
        }
    });

    function resetForm() {
        $('form[name="form-product"]').each(function() {
            this.reset();
        });
    }
});