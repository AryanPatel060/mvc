
document.addEventListener('DOMContentLoaded', () => {

    function validateCheckout() {
        let isShippingSelected = $("input[name='shippingMethod']:checked").length > 0;
        let isPaymentSelected = $("input[name='paymentMethod']:checked").length > 0;
        let isAddressAvailable = $(".addresscard").length > 1; // Checks if address cards exist
        console.log($(".addresscard").length );
        console.log(isAddressAvailable);


        if (isShippingSelected && isPaymentSelected && isAddressAvailable) {
            $(".checkoutbtn").removeClass("disabled-link"); // Enable
        } else {
            $(".checkoutbtn").addClass("disabled-link"); // Disable
            console.log($(".checkoutbtn"));
        }
    }

    // Prevent navigation if disabled
    $(".checkoutbtn").on("click", function (e) {
        validateCheckout();
        if ($(this).hasClass("disabled-link")) {
            e.preventDefault(); // Stop navigation
            alert("Please select shipping, payment, and address to proceed.");
        }
    });

    // Initial check when page loads
    validateCheckout();

    // Event Listeners to trigger validation
    $("input[name='shippingMethod']").on("change", validateCheckout);
    $("input[name='paymentMethod']").on("change", validateCheckout);
});



