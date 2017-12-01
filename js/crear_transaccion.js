$(document).ready(function() {
    
    function actualizar_monto(){
        var valor = $("#txt_monto").val();
        
        if ($('input[name="opcion_lado"]:checked').val() == 'debe'){
            $('#izquierda_debe').html(valor);
            $('#izquierda_haber').html('');
            
            $('#derecha_debe').html('');
            $('#derecha_haber').html(valor);
            
        } else {
            $('#izquierda_debe').html('');
            $('#izquierda_haber').html(valor);
            
            $('#derecha_debe').html(valor);
            $('#derecha_haber').html('');
        }
    }
    
    
    $("#txt_monto").keyup(function() {
        actualizar_monto();
    });
    
    
    $('input:radio[name="opcion_lado"]').change(function(){
        actualizar_monto();
    });
    
    $("#cuenta_izquierda").change(function(){
        var valor = $("#cuenta_izquierda option:selected").text();
        $("#nombre_cuenta_izquierda").html(valor);
    });
    
    $("#cuenta_derecha").change(function(){
        var valor = $("#cuenta_derecha option:selected").text();
        $("#nombre_cuenta_derecha").html(valor);
    });
});