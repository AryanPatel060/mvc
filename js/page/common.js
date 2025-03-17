document.addEventListener("DOMContentLoaded", function () {



    // --------------------------------------- header ------------------------------
    document.querySelectorAll(".header-category-toggle").forEach(function (categoryLink) {
        categoryLink.addEventListener("click", function (event) {
            let subMenu = this.nextElementSibling;

            // If submenu exists, toggle visibility
            if (subMenu && subMenu.classList.contains("header-category-submenu")) {
                event.preventDefault(); // Prevent default only when toggling
                subMenu.classList.toggle("show");
            } else {
                // Allow navigation if it's a leaf category
                window.location.href = this.href;
            }
        });
    });
    // --------------------------------------- end header ------------------------------



    // ----------------------------------------------- Footer ----------------------------------------

    document.getElementById("backToTop").addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    // --------------------------------------- end Footer ------------------------------

    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            document.querySelectorAll('.tab-pane').forEach(content => {
                content.classList.remove('active');
            });

            document.getElementById(this.getAttribute('data-tab')).classList.add('active');
        });
    });

    // ----------------------------------------------- Product View ----------------------------------------
    function changeImage(imgSrc, element) {
        document.getElementById("mainImage").src = imgSrc;

        // Remove active class from all thumbnails
        document.querySelectorAll(".thumbnail-list img").forEach((img) => img.classList.remove("active"));

        // Add active class to clicked thumbnail
        element.classList.add("active");
    }

    // Attach event listener to all thumbnails dynamically
    document.querySelectorAll(".thumbnail-list img").forEach((thumbnail) => {
        thumbnail.addEventListener("click", function () {
            changeImage(this.src, this);
        });
    });


    // Tab Switching Logic
    document.querySelectorAll('.nav-link').forEach(tab => {
        console.log('hello')
        tab.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            document.querySelectorAll('.tab-pane').forEach(content => {
                content.classList.remove('active');
            });

            document.getElementById(this.getAttribute('data-tab')).classList.add('active');
        });


    // // ----------------------------------------------- cart start ----------------------------------------

        $(".shippingmethod").change(function() {
            shippingMethod = this.value;
            let formData = new FormData();
            formData.append('shippingMethod', shippingMethod);
            console.log(shippingMethod);

            $.ajax({
                url: "http://localhost/MVC/checkout/cart/addShipping", // Backend endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);

                    $('.scc').html(response);
                },
                error: function() {
                    $('#result').html('<p style="color: red;">Error fetching data</p>');
                }
            });

        });
        $(".paymentmethod").change(function() {
            paymentMethod = this.value;
            let formData = new FormData();
            formData.append('paymentMethod', paymentMethod);
            console.log(paymentMethod);

            $.ajax({
                url: "http://localhost/MVC/checkout/cart/addPayment", // Backend endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);

                    $('.scc').html(response);
                },
                error: function() {
                    $('#result').html('<p style="color: red;">Error fetching data</p>');
                }
            });

        });
    });

  

});
function increaseQuantity(button) {
    let qtyInput = $(button).siblings(".qty-input");
    let newQty = parseInt(qtyInput.val()) + 1;
    qtyInput.val(newQty);
    showUpdateButton(qtyInput);
}

function decreaseQuantity(button) {
    let qtyInput = $(button).siblings(".qty-input");
    let newQty = parseInt(qtyInput.val());
    if (newQty > 1) {
        newQty -= 1;
        qtyInput.val(newQty);
        showUpdateButton(qtyInput);
    }
}

function showUpdateButton(qtyInput) {
    let form = qtyInput.closest(".cart-form");
    form.find(".update-btn").show();
}



    // ----------------------------------------------- end Product View ----------------------------------------

    // // -------------------------------------------------------home banner--------------------------------------
    // var swiper = new Swiper(".home-banner-swiper", {
    //     loop: true, // Infinite loop
    //     autoplay: {
    //         delay: 3000,
    //         disableOnInteraction: false
    //     },
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true
    //     },
    //     navigation: {
    //         nextEl: ".home-banner-button-next",
    //         prevEl: ".home-banner-button-prev"
    //     }
    // });
    // // ----------------------------------------------- home Banner end ----------------------------------------

    // // ----------------------------------------------- home slider ----------------------------------------
    // var myProductSwiper = new Swiper(".myProductSwiper", {
    //     slidesPerView: 5,
    //     spaceBetween: 20,
    //     loop: true,
    //     autoplay: {
    //         delay: 2500,
    //         disableOnInteraction: false
    //     },
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true
    //     }
    // });
    // // ----------------------------------------------- home slider end ----------------------------------------



