var primeraFila; //variable global
// var tabla=$("#tblAprendices").dataTable();
// codigo javascript .archivo que se comunica con ajax
$(function () {

    primeraFila = $("#fila"); //almaceno el id de la fila
    // listarAprendiz();

    //Al dar click al boton al boton agregar 
    $("#btnAgregar").click(function () {
        $("#accion").val("Agregar");
        // alert("soy el boton de agregar");
        //    validar si hay algo en los inputs o que si la seleccion es diferente a "Seleccione";
        if ($("#txtNombre").val().length > 0 && $("#txtIdentificacion").val().length > 0 &&
            $("#txtApellido").val().length > 0 && $("#cbGenero").val() != "Seleccione" &&
            $("#fecha").val().length > 0 && $("#txtCorreo").val().length > 0) {
            agregarAprendiz();
             // si la tabla no estaa visible que la muestre
        //  listarAprendiz();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Datos vacios.',
                text: 'ingresa texto por favor!',
                // footer: '<a href>Why do I have this issue?</a>'
                // timer: 2000
              })
              
        }



    });
    //Al dar click al boton al boton consultar
    $("#btnConsultar").click(function () {
        $("#accion").val("Consultar");
        //    alert("soy el boton de consultar");
        if($("#txtIdentificacion").val().length > 0){
            consultarAprendiz();
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Falta escribir identificacion.',
                text: 'ingresa identificacion por favor!',
                // footer: '<a href>Why do I have this issue?</a>'
                // timer: 2000
              })
        }
       
    });

    //Al dar click al boton al boton actualizar
    $("#btnEditar").click(function () {
        $("#accion").val("editar");
        //    validar si hay algo en los inputs o que si la seleccion es diferente a "Seleccione";
        if ($("#txtNombre").val().length > 0 && $("#txtIdentificacion").val().length > 0 &&
            $("#txtApellido").val().length > 0 && $("#cbGenero").val() != "Seleccione" &&
            $("#fecha").val().length > 0 && $("#txtCorreo").val().length > 0) {
            //    alert("soy el boton de consultar");
            actualizarAprendiz();

            // limpiarDatosTabla();

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Consulte.',
                text: 'ingresa identificacion y dale click en consultar!',
                // footer: '<a href>Why do I have this issue?</a>'
                // timer: 2000
              })
        }

    });

    //Al dar click al boton al boton eliminar
    $("#btnEliminar").click(function () {
        $("#accion").val("eliminar");
        //    validar si hay algo en los inputs o que si la seleccion es diferente a "Seleccione";
        if ($("#txtNombre").val().length > 0 && $("#txtIdentificacion").val().length > 0 &&
            $("#txtApellido").val().length > 0 && $("#cbGenero").val() != "Seleccione" &&
            $("#fecha").val().length > 0 && $("#txtCorreo").val().length > 0) {


                // botones sweet alert
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: 'btn btn-success',
                      cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                  })
                  
                  swalWithBootstrapButtons.fire({
                    title: 'Seguro que deseas eliminar?',
                    text: "El usuario se va a eliminar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {
                        // elimina el aprendiz
                       eliminarAprendiz();
                      swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'Borraste correctamente el usuario.',
                        'success'
                      )
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'No borraste a nadies:)',
                        'error'
                      )
                    }
                  });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Consulte.',
                text: 'ingresa identificacion y elimina!',
                // footer: '<a href>Why do I have this issue?</a>'
                // timer: 2000
              })
        }


    });

    $("#btnListar").click(function () {
        $("#accion").val("listar");
        // si la tabla no estaa visible que la muestre
        var esVisible = $("#tblAprendices").is(":visible");
        if (esVisible) {
            
        }else{
            listarAprendiz();
        }
           
        
    

    });
});


function agregarAprendiz() {
    // $("#mensaje").html("");
    $.ajax({
        //URL de la peticion
        url: '../Controlador/AprendizController.php',
        //informacion que  va enviar
        data: $("#FrmAprendiz").serialize(),
        //tipo de dato
        dataType: 'json',
        //especifica si el tipo es POST O GET
        type: 'post',
        //valor booleano que indica eque si el navegador
        //debe alamacenar cache a la pagina solicitada
        cache: false,
        //Codigo para ejecutar la peticion
        success: function (resultado) {
            console.log(resultado); //para imprimir el resultado por consola
            if (resultado.estado) {
           
                Swal.fire({
                    icon: 'success',
                    title: 'Muy bien.',
                    text: resultado.mensaje,
                    footer: '<a> revisa la base de datos </a>',
                     timer: 2000
                  });
                  Limpiar();
                  listarAprendiz();
                
                //   table.destroy();
                  
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: resultado.mensaje,
                    footer: '<a>Tienes un error revisa por favor </a>'
                  })
                  
            }
        },
        //codigo para ejecutar si la peticion falla
        error: function (ex) {
            console.log(ex.responseText);
        }

    });

}


function Limpiar() {
    $("#txtIdentificacion").val("");
    $("#txtNombre").val("");
    $("#txtApellido").val("");
    $("#txtCorreo").val("");
    $("#fecha").val("");
    $("#cbGenero").val("Seleccione");
}





function consultarAprendiz() {

    $("#mensaje").html("");

    var identificacion = $("#txtIdentificacion").val();
    //limpia los datos
    Limpiar();

    $("#txtIdentificacion").val(identificacion);
    $.ajax({
        url: '../Controlador/AprendizController.php',
        data: $("#FrmAprendiz").serialize(),
        type: 'post',
        dataType: 'json',
        cache: false,
        success: function (resultado) {
            console.log(resultado);
            //si econtro algo que lo ponga
            if (resultado.estado) {
                $("#idAprendiz").val(resultado.datos.idEstudiante);
                $("#txtNombre").val(resultado.datos.esNombre);
                $("#txtApellido").val(resultado.datos.esApellido);
                $("#txtCorreo").val(resultado.datos.esCorreo);
                $("#cbGenero").val(resultado.datos.esGenero);
                $("#fecha").val(resultado.datos.esFecha);

                Swal.fire({
                    icon: 'info',
                    title: 'Resultado de la busqueda',
                    text: resultado.mensaje,
                    footer: '<a >Puedes editar de una vez </a>',
                    // tiempo que permanece el alerta en este caso son 5 segundos
                    timer: 5000
                  })
               
            }
            //si no bota error
            else {
                Swal.fire({
                    icon: 'warning',
                    title: 'no econtrado',
                    text: resultado.mensaje,
                    footer: '<a >Escribiste bien la identificacion? </a>',
                    // tiempo que permanece el alerta en este caso son 5 segundos
                    timer: 5000
                  })
            }
        },
        //codigo para ejecutar si la peticion falla
        error: function (ex) {
            console.log(ex.responseText);
        }

    });
}


function actualizarAprendiz() {
    $("#mensaje").html("");
    $.ajax({
        //URL de la peticion
        url: '../Controlador/AprendizController.php',
        //informacion que  va enviar
        data: $("#FrmAprendiz").serialize(),
        //tipo de dato
        dataType: 'json',
        //especifica si el tipo es POST O GET
        type: 'post',
        //valor booleano que indica eque si el navegador
        //debe alamacenar cache a la pagina solicitada
        cache: false,
        //Codigo para ejecutar la peticion
        success: function (resultado) {
            console.log(resultado); //para imprimir el resultado por consola
            if (resultado.estado) {
                Swal.fire({
                    icon: 'success',
                    title: 'Muy bien',
                    text: resultado.mensaje,
                    footer: '<a >Revisa la base de datos </a>',
                    // tiempo que permanece el alerta en este caso son 5 segundos
                    timer: 5000
                  })
                Limpiar();
                listarAprendiz();
                // destruir la tabla 
            
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Problemas',
                    text: resultado.mensaje,
                    footer: '<a >Consultaste bien? </a>',
                    // tiempo que permanece el alerta en este caso son 5 segundos
                    timer: 5000
                  })
            }
        },
        //codigo para ejecutar si la peticion falla
        error: function (ex) {
            console.log(ex.responseText);
        }

    });

}




function eliminarAprendiz() {

    $("#mensaje").html("");
    $.ajax({
        //URL de la peticion
        url: '../Controlador/AprendizController.php',
        //informacion que  va enviar
        data: $("#FrmAprendiz").serialize(),
        //tipo de dato
        dataType: 'json',
        //especifica si el tipo es POST O GET
        type: 'post',
        //valor booleano que indica eque si el navegador
        //debe alamacenar cache a la pagina solicitada
        cache: false,
        //Codigo para ejecutar la peticion
        success: function (resultado) {
            console.log(resultado); //para imprimir el resultado por consola
            if (resultado.estado) {
                Limpiar();
                listarAprendiz();
                
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Problemas',
                    text: resultado.mensaje,
                    footer: '<a >Consultaste bien? </a>',
                    // tiempo que permanece el alerta en este caso son 5 segundos
                    timer: 5000
                  });
            }
        },
        //codigo para ejecutar si la peticion falla
        error: function (ex) {
            console.log(ex.responseText);
        }

    });

}




function listarAprendiz() {
    //  $("#tblAprendices tr").remove();
    // destruye la tabla
    $('#tblAprendices').DataTable().destroy();

    //muestra la tabla
    $("#tblAprendices").show();
    // $("#mensaje").html("");
    //borra la fila
    $(".otraFila").remove();
    //agrega dato a la primera fila
    $("#tblAprendices tbody").append(primeraFila);

    var parametros = { accion: "listar" };
    $.ajax({
        //URL de la peticion
        url: '../Controlador/AprendizController.php',
        //informacion que  va enviar
        data: parametros,
        //especifica si el tipo es POST O GET
        type: 'post',
        //tipo de dato
        dataType: 'json',
        //valor booleano que indica eque si el navegador
        //debe alamacenar cache a la pagina solicitada
        cache: false,
        success: function (resultado) {
            console.log(resultado);
            var aprendices = resultado.datos;
            // aprendices es un object que tiene una propiedad llamada datos
            // datos es una propiedad de aprendices, el cual es un arreglo (Array)
            //el echa seria llamar al pbjecto aprendices y su propiedad.datos
            $.each(aprendices, function (index, aprendiz) {
                $("#tdIdentifica").html(aprendiz.esIndentificacion);
                $("#tdNombre").html(aprendiz.esNombre);
                $("#tdApellido").html(aprendiz.esApellido);
                $("#tdCorreo").html(aprendiz.esCorreo);
                $("#tdGenero").html(aprendiz.esGenero);
                $("#tdFecha").html(aprendiz.esFecha);
                $("#tblAprendices tbody").append($("#fila").clone(true).attr("class", "otraFila"));

            });
            //esta cogiendo la primera fila y la limpia
            $("#tblAprendices tbody tr").first().remove();
            //librera de dataTable
            $("#tblAprendices").dataTable({
                // cambiar lenuaje al dataTable
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                  }
            });
        },
        //codigo para ejecutar si la peticion falla
        error: function (ex) {
            console.log(ex.responseText);
        }

    });
}


