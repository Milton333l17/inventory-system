<?php
require_once('controller/load.php');

include_once("layouts/header.php");
///////////////////////////////////////
//        agregar calendario         //
///////////////////////////////////////

?>

                        <div class="row">
                            <div class="col">
                              <div class="au-card" >
                                <div id="calendar"></div>
                              </div>
                             
                            </div><!-- .col -->
                          
                        </div>

                        <?php
include_once("layouts/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
  

  // setup a few events
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today,',
      center: 'title',
      right: 'month,listWeek'
    },
    dayClick:function(date,jsEvent,view){
        clear();
        $("#fecha").val(date.format());
        $("#calendario").modal();
    },

    events:'http://localhost/inventory-system/calendar2.php',
    
    eventClick:function(calEvent,jsEvent,view){
        $('#tituloEvento').html(calEvent.title);
        $('#id').val(calEvent.id);
        $('#descripcion').val(calEvent.descripcion);
        $('#titulo').val(calEvent.title);
        $('#color').val(calEvent.color);
        $('#textcolor').val(calEvent.textColor);
        FechaHora = calEvent.start._i.split(" ");
        $('#fecha').val(FechaHora[0]);
        $('#hora').val(FechaHora[1]);  
       

        $("#calendario").modal();
    },
    editable:true,
    eventDrop:function(calEvent){
        $('#id').val(calEvent.id);
        $('#descripcion').val(calEvent.descripcion);
        $('#titulo').val(calEvent.title);
        $('#color').val(calEvent.color);

        var fechaHora=calEvent.start.format().split("T");
        $('#fecha').val(fechaHora[0]);
        $('#hora').val(fechaHora[1]);  
        recolectarDatos();
        EnviarInformacion('modificar',NuevoEvento,true)

    }
  });

});
    </script>
    
<div class="modal fade" id="calendario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <input type="hidden" value="" name="id" id="id" class="form-control">

                        <input type="hidden" id="fecha" name="start" class="form-control">
           
 
      <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Hora</label>
                        </div>
                        <div class=" col-12 col-md-8 input-group clockpicker" data-autoclose="true">
                        <input type="text" id="hora" name="end" value="10:30" class="form-control">
                        </div>          
      </div>
      <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Titulo</label>
                        </div>
                        <div class="col-12 col-md-8">
                        <input type="text" id="titulo" name="titulo"  class="form-control">
                        </div>          
      </div>
      <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Descripcion</label>
                        </div>
                        <div class="col-12 col-md-8">
                        <textarea  id="descripcion" rows="3"  class="form-control" name="descripcion"></textarea>
                        </div>          
      </div>
      <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Color</label>
                        </div>
                        <div class="col-12 col-md-8">
                        <input type="color" id="color"  class="form-control" style="height:36px;width:230px;" value="#ff0000" name="color" >
                        </div>          
      </div>
      <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="select" class=" form-control-label">Color letra</label>
                        </div>
                        <div class="col-12 col-md-8">
                        <input type="color" id="textColor" class="form-control" style="height:36px;width:230px;" name="letra" >
                        </div>          
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="btnagregar">Agregar</button>
      <button type="submit" class="btn btn-warning"  id="btnmodificar">Modificar</button>
      <button type="submit" class="btn btn-danger" id="btneliminar" name="eliminar" >Borrar</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
      </div>
    </div>
  </div>
</div>
<script>
    var NuevoEvento;
    $('#btnagregar').click(function(){
        recolectarDatos();
        EnviarInformacion('agregar',NuevoEvento)
    });
    $('#btneliminar').click(function(){
        recolectarDatos();
        EnviarInformacion('eliminar',NuevoEvento)
    });
    $('#btnmodificar').click(function(){
        recolectarDatos();
        EnviarInformacion('modificar',NuevoEvento)
    });
function recolectarDatos(){
         NuevoEvento={
            id:$('#id').val(),
            title:$('#titulo').val(),
            start:$('#fecha').val()+" "+$('#hora').val(),
            color:$('#color').val(),
            descripcion:$('#descripcion').val(),
            id:$('#id').val(),
            textColor:$('#textColor').val(),
            end:$('#fechaf').val()+" "+$('#hora').val()

        };
}
function EnviarInformacion(accion,objEvento,modal){
  $.ajax({
    type:'POST',
    url:'calendar2.php?accion='+accion,
    data:objEvento,
    success:function(msg){
      if(msg){
         $('#calendar').fullCalendar('refetchEvents');
          if(!modal){
             $("#calendario").modal('toggle');
          }
     
      }
     
    },error:function(){
      alert("hay un error ...");
    }

  })
}
$('.clockpicker').clockpicker();
function clear(){
        $('#id').val('');
        $('#descripcion').val('');
        $('#titulo').val('');
        $('#color').val('');
}
</script>
