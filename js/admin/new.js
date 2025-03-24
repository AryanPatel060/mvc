
document.addEventListener('DOMContentLoaded',()=>{

    $("#exportProductdata").click(function (){
        $.ajax({
            url:"http://localhost/MVC/admin/product_index/exportProducts",
            type:"GET",
            success: function(res)
            {
                console.log("File Downloaded");
            },
            error: function(res)
            {
                console.log("error in downloading");
            }
        })
    });

});