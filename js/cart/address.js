document.addEventListener('DOMContentLoaded',()=>{

    
    function validateInput(selector, regex, errorMessage) {
        let value = $(selector).val().trim();
        if (!regex.test(value)) {
            $(selector).addClass("is-invalid");
            $(selector).siblings(".invalid-feedback").text(errorMessage).show();
            return false;
        } else {
            $(selector).removeClass("is-invalid");
            $(selector).siblings(".invalid-feedback").hide();
            return true;
        }
    }
    
    function validateForm() {
        let isValid = true;
        
        isValid &= validateInput('input[name="customer_email"]', /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, "Enter a valid email address");
        
        $('input[name^="shipping"], input[name^="billing"]').each(function() {
            let fieldName = $(this).attr('name');
            let regex, errorMsg;
            
            if (fieldName.includes('first_name') || fieldName.includes('last_name')) {
                regex = /^[A-Za-z]+$/;
                errorMsg = "Only alphabets are allowed";
            } else if (fieldName.includes('phone_number')) {
                
                regex = /^[0-9]{10,15}$/;
                errorMsg = "Enter a valid phone number (10-15 digits)";
            } else if (fieldName.includes('zipcode')) {
                regex = /^[0-9]{5,10}$/;
                errorMsg = "Enter a valid zip code (5-10 digits)";
            } else if (fieldName.includes('street_address')) {
                regex = /^[A-Za-z0-9-\s]{2,}$/;
                errorMsg = "Enter at least 2 characters";
            } else if (fieldName.includes('city') || fieldName.includes('region') || fieldName.includes('country')) {
                regex = /^[A-Za-z0-9\s]{2,}$/;
                errorMsg = "Enter at least 2 characters";
            }
            
            if (regex) {
                isValid &= validateInput(this, regex, errorMsg);
            }
        });
        
        return isValid;
    }
    
    $('#checkout-form').on('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault(); // Stop form submission if validation fails
        }
    });
    
    $('#sameAsShipping').change(function() {
        if ($(this).is(':checked')) {
            $('#billing-form input:not([type="hidden"])').each(function() {
                let name = $(this).attr('name').replace('billing', 'shipping');
                $(this).val($('input[name="' + name + '"]').val());
                
            });
        } else {
            $('#billing-form input:not([type="hidden"])').val('');
        }
        validateForm();
    });
    
    $('input').on('input', function() {
        validateForm();
    });
});