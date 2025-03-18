
document.addEventListener('DOMContentLoaded', () => {

    function validateCheckout() {
        let isShippingSelected = $("input[name='shippingMethod']:checked").length > 0;
        let isPaymentSelected = $("input[name='paymentMethod']:checked").length > 0;
        let isAddressAvailable = $(".card.shadow-sm").length > 0; // Checks if address cards exist

       

        if (isShippingSelected && isPaymentSelected && isAddressAvailable) {
            $(".checkout-btn").removeClass("disabled-link"); // Enable
        } else {
            $(".checkout-btn").addClass("disabled-link"); // Disable
        }
    }

    // Prevent navigation if disabled
    $(".checkout-btn").on("click", function (e) {
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



