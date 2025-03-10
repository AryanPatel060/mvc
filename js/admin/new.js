
// document.addEventListener('DOMContentLoaded', () => {
//     console.log("new loaded");
// error = false;
// msg = "";
// const name = document.getElementById('name');
// const form = document.getElementById('form');
// const errorDiv = document.getElementById('error');
// const mfgDate = document.getElementById('mfg_date');
// console.log(mfgDate);
// console.log(name);
// name.addEventListener('input', () => {
//     console.log(name.value);
//     if (name.value == "00") {
//         error = true;
//         msg = 'vakue is 00';
//     }
// })
// mfgDate.addEventListener('change', () => {
//     const mDate = new Date(mfgDate.value);
//     const today = new Date();

//     if (mDate > today) {
//         msg = "manufacutring date is invalid !";
//         error = true; 
//     }
//     else 
//     {
//         msg = '';
//         error = false;
//     }
//     console.log(mDate || 'name');
// })



// form.addEventListener('submit', (e) => {
//     if (error) {
//         e.preventDefault();
//         errorDiv.textContent = msg;
//     }
// })

// })

// ------------------------------------ edit image page -----------------------------------------------





// function changeImage(imageUrl, imageId) {
//     $("#focusimage").attr("src", imageUrl);
//     $("#focusimage").attr("data-id", imageId);
//     $(".img-thumbnail").removeClass("border-primary");

//     // Add border-primary to the selected image in the grid
//     $(".img-thumbnail").each(function () {
//         if ($(this).attr("src") === imageUrl) {
//             $(this).addClass("border-primary");
//         }
//     });
// }

// function deleteMainImage() {
//     let imageId = $("#focusimage").attr('data-id');
//     if (!imageId) {
//         alert("No image selected!");
//         return;
//     }

//     if (!confirm("Are you sure you want to delete this image?")) return;
//     console.log(imageId);
//     $.ajax({
//         url: "<?php echo $this->getUrl('*/*/delete')?>",
//         type: "POST",
//         data: {
//             imageid: imageId
//         },
//         success: function (response) {
//             alert("Image deleted successfully!");
//             // location.reload();
//         },
//         error: function () {
//             alert("Failed to delete image!");
//         }
//     });
// }

// function updateCoverImage() {
//     let imageId = $("#focusimage").attr('data-id');
//     if (!imageId) {
//         alert("No image selected!");
//         return;
//     }

//     if (!confirm("Are you sure you want to update cover image?")) return;
//     $.ajax({
//         url: "<?php echo $this->getUrl('*/*/updatecover') . '/' ?>",
//         type: "POST",
//         data: {
//             imageid: imageId
//         },
//         success: function (response) {
//             alert("Image updated successfully!");
//             location.reload();
//         },
//         error: function () {
//             alert("Failed to update image!");
//         }
//     });
// }

// function deleteSelectedImages() {
//     let selectedImages = [];
//     $(".image-checkbox:checked").each(function () {
//         selectedImages.push($(this).val());
//     });

//     if (selectedImages.length === 0) {
//         alert("Please select at least one image to delete.");
//         return;
//     }

//     if (!confirm("Are you sure you want to delete selected images?")) return;

//     console.log(selectedImages);

//     $.ajax({
//         url: "<?php echo $this->getUrl('*/*/delete') ?>",
//         type: "POST",
//         data: {
//             imageid: selectedImages
//         },
//         success: function (response) {
//             console.log(response);
//             alert("Selected images deleted successfully!");
//             // location.reload();
//         },
//         error: function () {
//             alert("Failed to delete selected images!");
//         }
//     });
// }

// ------------------------------------ edit image page end -----------------------------------------------
