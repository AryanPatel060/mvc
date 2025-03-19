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

        $(".shippingmethod").change(function () {
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
                success: function (response) {
                    console.log(response);

                    $('.scc').html(response);
                },
                error: function () {
                    $('#result').html('<p style="color: red;">Error fetching data</p>');
                }
            });

        });
        $(".paymentmethod").change(function () {
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
                success: function (response) {
                    console.log(response);

                    $('.scc').html(response);
                },
                error: function () {
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


class FormValidator {
    constructor(form) {
        this.form = form; // Assigning the form dynamically
        this.validationRules = {
            "validate-email": this.validateEmail,
            "validate-number": this.validateNumber,
            "validate-name": this.validateName,
            "validate-address": this.validateAddress,
            "validate-phonenumber": this.validatePhoneNumber,
            "validate-zipcode": this.validateZipCode,
            "validate-region": this.validateRegion,
            "validate-required": this.validateRequired,
        };

        this.observeInputs();
        this.setupFormSubmission();
    }

    // Email Validation
    validateEmail(input) {
        const emailPattern = /^[^\s@]+[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(input.value) ? "" : "Invalid email format";
    }

    // Number Validation
    validateNumber(input) {
        return /^\d+$/.test(input.value) ? "" : "Only numbers allowed";
    }
    validatePhoneNumber(input) {
        return /^[0-9]{10,15}$/.test(input.value) ? "" : "Only numbers and length should be 10 - 15 characters allowed";
    }
    validateZipCode(input) {
        return /^[0-9]{5,10}$/.test(input.value) ? "" : "Only numbers and length should be 5-10 characters allowed";
    }
    validateName(input) {
        return /^[A-Za-z]+$/.test(input.value) ? "" : "Only alphabets are allowed";
    }
    validateRegion(input) {
        return /^[A-Za-z\s]+$/.test(input.value) ? "" : "No special characters except space";
    }
    validateAddress(input) {
        return /^[A-Za-z0-9-,\s]+$/.test(input.value) ? "" : "Only alphanumerical are allowed";
    }

    // Required Field Validation
    validateRequired(input) {
        return input.value.trim() ? "" : "This field is required";
    }

    // Validate a single input
    validateInput(input) {
        let errorMessage = "";
        Object.keys(this.validationRules).forEach((rule) => {
            if (input.classList.contains(rule)) {
                let error = this.validationRules[rule](input);
                console.log( typeof(error) , error);
                if (error) {
                    errorMessage = error;
                }// Last error will be shown           
            }
            
        });
        
        this.showError(input, errorMessage);
        this.toggleSubmitButton();
    }

    // Show error message
    showError(input, message) {
        let errorDiv = input.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains("error-message")) {
            errorDiv = document.createElement("div");
            errorDiv.classList.add("error-message", "text-danger", "mt-1");
            input.parentNode.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    // Toggle submit button based on validation
    toggleSubmitButton() {
        const allInputs = this.form.querySelectorAll("input");
        let isValid = true;

        allInputs.forEach((input) => {
            if (input.nextElementSibling && input.nextElementSibling.classList.contains("error-message") && input.nextElementSibling.textContent !== "") {
                isValid = false;
            }
        });

        const submitButton = this.form.querySelector("button[type='submit']");
        if (submitButton) {
            submitButton.disabled = !isValid;
        }
    }

    // Observe inputs for validation
    observeInputs() {
        this.form.addEventListener("input", (event) => {
            if (event.target.tagName === "INPUT") {
                this.validateInput(event.target);
            }
        });

        // MutationObserver for dynamically added inputs
        let observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    if (node.tagName === "INPUT") this.validateInput(node);
                });
            });
        });

        observer.observe(this.form, { childList: true, subtree: true });
    }

    setupFormSubmission() {
        this.form.addEventListener("submit", (event) => {
            let isValid = true;
            const allInputs = this.form.querySelectorAll("input");

            allInputs.forEach((input) => {
                this.validateInput(input);
                if (input.nextElementSibling && input.nextElementSibling.classList.contains("error-message") && input.nextElementSibling.textContent !== "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault(); // Block form submission
                alert("Please fix validation errors before submitting.");
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form").forEach((form) => {
        new FormValidator(form);
        // console.log(form);
    });
});
