
document.addEventListener('DOMContentLoaded', () => {

    $("#exportProductdata").click(function () {
        $.ajax({
            url: "http://localhost/MVC/admin/product_index/exportProducts",
            type: "GET",
            success: function (res) {
                console.log("File Downloaded");
            },
            error: function (res) {
                console.log("error in downloading");
            }
        })
    });


    // ------------------------ category  filter ---------------------------

    // console.log($("#gridform").find("input"));
    // data = {}
    // let formData = new FormData();
    // $("#gridform").find("input").on("change", function () {
    //     formData.append(($(this).attr("id").split("-"))[1], $(this).val()); // Adds the changed input
    //     console.log(Array.from(formData.entries()));
    //     data[($(this).attr("id").split("-"))[1]] = $(this).val();
    //     console.log(data);
    //     $.ajax({
    //         url:"http://localhost/MVC/admin/category_index/list/",
    //         type:"GET",
    //         data:data,
    //         success:function (res)
    //         {
    //             // console.log(res);
    //             $("#grid-container").html(res);
    //         }

    //     })
    // });
});