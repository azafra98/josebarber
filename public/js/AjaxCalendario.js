$(document).ready(function(){

    function fetch_customer_data(query = '')
    {
        $.ajax({
            url: "calendario/action",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(datos)
            {
                $('#mañana').html(datos.mañana);
                $('#tarde').html(datos.tarde);
            }
        })
    }

    $(document).on('change', '#dia', function(){
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("botonCitas").disabled = true;
        });
        var query = $(this).val();
        fetch_customer_data(query);
    });

});
