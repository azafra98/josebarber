$(document).ready(function(){

    var dia = document.getElementById("updateDia");
    if (dia != null)
        fetch_customer_data(dia.value);

    function fetch_customer_data(query = '')
    {
        $.ajax({
            url: "prueba/calendario",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data)
            {
                $('#horaUpdate').html(data.datos);
            }
        })
    }

    $(document).on('change', '#updateDia', function(){
        var query = $(this).val();
        fetch_customer_data(query);
    });

});
