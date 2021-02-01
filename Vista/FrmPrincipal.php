<?php
//Importar variables a la tabla de símbolos actual desde un array
extract($_REQUEST);

?>
<!-- Manejo de rutas -->

<!-- ruta relativas -->
<!-- /Proyecto_GestionAprendiz/Vista/FrmPrincipal.php -->
<!-- ruta absoluta  con el servidor phpServer-->
<!-- /Vista/FrmPrincipal.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- importando bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  

    <!-- llamar el archivo jquery -->
    <script src="funciones.js" type="text/javascript"></script>

    <!-- importando el css personlizado -->
    <link rel="stylesheet" href="../Vista/Css/FrmEstilos.css">

    <!-- importar alertas sweet alert -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

      <!-- Llamar DataTable -->
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
   <!-- esstilos dataTables -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> -->
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">

    <title>Gestion Aprendiz</title>
</head>

<body>
    <header>

    </header>
    <div class="container">
        <form name="FrmAprendiz" id="FrmAprendiz">

            <table border="1" class=" table table-bordered table-striped table-dark">
                <thead>
                    <tr id="cabezera">
                        <th colspan="2" style="text-align: center;"> GESTION APRENDIZ </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="nombres">Identificacion : </td>
                        <td>
                            <div class="form-group">
                                <!-- mandamos a lcs inputs la poccion de los datos siendo 0 el id.... -->
                                <input name="txtIdentificacion" id="txtIdentificacion" required="" value="" class="form-control" type="number" placeholder="Ingresa Identificacion">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="nombres">Nombre :</td>
                        <td>
                            <div class="form-group">
                                <input value="" required="" id="txtNombre" name="txtNombre" class="form-control" type="text" placeholder="Ingrese Nombre">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="nombres">Apellido :</td>
                        <td>
                            <div class="form-group">
                                <input name="txtApellido" id="txtApellido" value="" class="form-control" type="text" placeholder="Ingrese Apellido">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="nombres">Correo :</td>
                        <td>
                            <div class="form-group">
                                <input name="txtCorreo" id="txtCorreo" value="" class="form-control" type="email" placeholder="Ingrese Correo">
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="nombres">Genero :</td>
                        <td>
                            <div class="form-group">
                                <select name="cbGenero" id="cbGenero" class="form-control">
                                    <option value="Seleccione"> Seleccione Genero </option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td class="nombres">Fecha de Nacimiento :</td>
                        <td>
                        <!-- validar que ingrese fecha  -->
                            <div class="form-group">
                                <input name="fecha" id="fecha" value="" 
                                max="<?php echo date("Y-m-d"); ?>" type="date" class="form-control">
                            </div>

                        </td>
                    </tr>

                    <td colspan="2">
                        <div class="row justify-content-center ">
                            <!-- 
      <input type="button" value="Agregar" name="btnAgregar"
       id="btnAgregar"  class="btn btn-success btn-m"/> -->
                            <button type="button"    id="btnAgregar" name="btnAgregar" value="Agregar" class="btn btn-primary btn-lg "> Guardar</button>
                            <button type="button"   id="btnConsultar" name="btnConsultar" value="Consultar" class="btn btn-primary btn-lg"> Buscar</button>
                            <button type="button"   id="btnEditar" name="btnEditar" value="editar" class="btn btn-primary btn-lg"> Editar</button>
                            <button type="button"   id="btnListar" name="btnListar" class="btn btn-primary btn-lg"> Listar</button>
                            <button type="button"    id="btnEliminar" name="btnEliminar" value="eliminar" class="btn btn-danger btn-lg"> Eliminar</button>

                        </div>

                    </td>



                </tbody>

            </table>
            <!-- campo oculto para saber que boton escojio -->
            <input type="hidden" id="accion" name="accion" value="">
            <!-- campo oculto que me tre el id del aprendiz -->
            <input type="hidden" id="idAprendiz" name="idAprendiz" value="">

        </form>


        <!-- // variable que llega el mensaje en un div de bootstra
            // $mensaje=@$msj;
            // echo $mensaje; -->

        <!-- <div class="alert alert-success">
            <strong id="mensaje">Informacion</strong>
        </div> -->



    </div>

    <!-- Tabla de Aprendices 
    oculta con siplay none-->
<table border="1" id="tblAprendices"  class="table table-bordered  table-hover   " 
style="width: 80%; display:none">
    <thead class="">
        <tr class="cabezaraTabla2" style="text-align: center">
            <th>Identificación</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Genero</th>
            <th>Fecha Nacimiento</th>
      
         </tr>
    </thead>
    <tbody>                   
        <tr id="fila" class="primeraFila">
            <td id="tdIdentifica"></td>
            <td id="tdNombre"></td>
            <td id="tdApellido"></td>
            <td id="tdCorreo"></td>
            <td id="tdGenero"></td>
            <td id="tdFecha"></td>
        </tr>
    </tbody>
</table>







</body>

</html>