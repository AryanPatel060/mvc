document.addEventListener("DOMContentLoaded", function () {
    let qunt = $("#productquantity");
    $("#increseqnt").click(() => {
        qunt.val(Number(qunt.val()) + 1);
    });
    $("#decreseqnt").click(() => {
        if (Number(qunt.val()) > 1) {
            qunt.val(Number(qunt.val()) - 1);

        }

    });
    $("#addtocartbtn").click(
        () => {
            let formData = new FormData();
            formData.append('cart[product_id]', $("#product_id").val());
            formData.append('cart[product_quantity]', $("#productquantity").val());
            if (qunt.val() < 1) {
                errormsg = "Product Quantity can not be 0.";
                showMessage(errormsg);
            }
            else {
                $.ajax(
                    {
                        url: "http://localhost/MVC/checkout/cart/add",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            successmsg = "<strong>Success!</strong> Product has been added to your cart.";
                            showMessage(successmsg);
                            qunt.val(1);
                        }
                    }
                )
            }
        })
});
function showMessage(successmsg) {

    $("#cartSuccessMessage").html(successmsg);
    $("#cartSuccessMessage").removeClass("d-none");
    setTimeout(function () {
        $("#cartSuccessMessage").addClass("d-none");
    }, 3000);
}
