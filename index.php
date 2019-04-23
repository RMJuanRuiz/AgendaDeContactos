<?php 
    include 'inc/layout/header.php';
?>
<div class="contenedor-barra">
    <h1>Agenda de Contactos</h1>
</div>

<div class="bg-secundario contenedor sombra">
    <form action="#" id="contacto" method="">
        <legend>Agregar un contacto <span>Todos los campos son obligatorios</span></legend>

        <?php include 'inc/layout/formulario.php';?>

    </form>
</div>

<div class="contenedor sombra contactos">
    <div class="contenedor-contactos">
        <h2>Contactos</h2>

        <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar contactos">

        <p class="total-contactos">
            <span>2</span> Contactos
        </p>

        <div class="contenedor-tabla">
            <table id="listado-contactos" class="listado-contactos">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>                 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan</td>
                        <td>EAN</td>
                        <td>32245198452</td>
                        <td>
                            <a class="btn-editar btn" href="editar.php?id=1">
                                <i class="fas fa-user-edit"></i>
                            </a>

                            <button data-id="1" type="button" class="btn-borrar btn">
                                <i class="fas fa-user-times"></i>
                            </button>

                        </td>
                    </tr>

                    <tr>
                        <td>Juan</td>
                        <td>EAN</td>
                        <td>32245198452</td>
                        <td>
                            <a class="btn-editar btn" href="editar.php?id=1">
                                <i class="fas fa-user-edit"></i>
                            </a>

                            <button data-id="1" type="button" class="btn-borrar btn">
                                <i class="fas fa-user-times"></i>
                            </button>

                        </td>
                    </tr>


                    <tr>
                        <td>Juan</td>
                        <td>EAN</td>
                        <td>32245198452</td>
                        <td>
                            <a class="btn-editar btn" href="editar.php=id=1">
                                <i class="fas fa-user-edit"></i>
                            </a>

                            <button data-id="1" type="button" class="btn-borrar btn">
                                <i class="fas fa-user-times"></i>
                            </button>

                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div> 
</div>






<?php
    include 'inc/layout/footer.php';
?>