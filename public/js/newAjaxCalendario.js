$(document).ready(function(){

    function fetch_customer_data(query = '')
    {
        $.ajax({
            url: "calendarioNuevo/actionNuevo",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(datos)
            {
                $('#newMañana').html(datos.mañana);
                $('#newTarde').html(datos.tarde);
            }
        })
    }


    $(document).on('change', '#newDia', function(){
        var query = $(this).val();
        fetch_customer_data(query);
    });
});
