const formularioContactos = document.querySelector('#contacto'),
    listadoContactos = document.querySelector('#listado-contactos tbody'),
    inputBuscador = document.querySelector('#buscar');

eventListeners();

function eventListeners(){
    //Cuando el formulario de editar o crear se ejecuta
    formularioContactos.addEventListener('submit', leerFormulario);

    // Listener para eliminar contacto
    if(listadoContactos){
        listadoContactos.addEventListener('click', eliminarContacto);
    }

    // buscador
    inputBuscador.addEventListener('input', buscarContactos);

    // Número de contactos
    numeroContactos();
}


function leerFormulario(e){
    e.preventDefault(); //Para no actualizar la web, prevenir el envento por defecto
    
    //Variables para leer los datos de los inputs:
    const nombre = document.querySelector('#nombre').value,
    empresa = document.querySelector('#empresa').value,
    telefono = document.querySelector('#telefono').value,
    accion = document.querySelector('#accion').value;



    if(nombre === '' || /^\s+$/.test(nombre) || empresa === '' || /^\s+$/.test(empresa) || telefono === '' || /^\s+$/.test(telefono)){ // Uso de expresión regular para validar que no se envien espacios en blanco
        mostrarNotificacion("Todos los campos son obligatorios", "error");
    }
    else{
        //Crear llamado a AJAX
        const infoContacto = new FormData();
        infoContacto.append('nombre', nombre);
        infoContacto.append('empresa', empresa);
        infoContacto.append('telefono', telefono);
        infoContacto.append('accion', accion);

        //console.log(...infoContacto); // Para leer los datos del formulario

        if(accion === 'crear'){
            //Crea el contacto
            insertarBD(infoContacto);
        }else{
            // Editar contacto
            // Leer el ID
            const idRegistro = document.querySelector('#id').value;
            infoContacto.append('id', idRegistro);
            actualizarRegistro(infoContacto);
        }
    }
}
/* Insertar en la base de datos mediante AJAX */
function insertarBD(datos){
    // Llamado a jax
    
    //Crear el objeto
    const xhr = new XMLHttpRequest();

    //Abrir conexión
    xhr.open('POST', 'inc/modelos/modelo-contactos.php', true);

    //Pasar los datos
    xhr.onload = function(){
        if(this.status === 200){
            // console.log(JSON.parse(xhr.responseText)); // Pasa de json a objeto normal de JS

            //Leer respuesta de php
            const respuesta = JSON.parse(xhr.responseText);
            // console.log(respuesta);

            // Insertar un nuevo elemento a la tabla
            const nuevoContacto = document.createElement('tr');
            nuevoContacto.innerHTML = `
                <td>${respuesta.datos.nombre}</td>
                <td>${respuesta.datos.empresa}</td>
                <td>${respuesta.datos.telefono}</td>
            `;

            // Crear contenedor para los botones
            const contenedorAcciones = document.createElement('td');

            // Crear el icono de Editar
            const iconoEditar = document.createElement('i');
            iconoEditar.classList.add('fas', 'fa-user-edit');

            // Crear enlace para editar
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);
            btnEditar.href = `editar.php?id=${respuesta.datos.id_insertado}`;
            btnEditar.classList.add('btn', 'btn-editar');

            // Agregarlo al padre
            contenedorAcciones.appendChild(btnEditar);

            // Crear el icono de eliminar
            const iconoEliminar = document.createElement('i');
            iconoEliminar.classList.add('fas', 'fa-user-times');

            // Crear botón de eliminar
            const btnEliminar = document.createElement('button');
            btnEliminar.appendChild(iconoEliminar);
            btnEliminar.setAttribute('data-id', respuesta.datos.id_insertado);
            btnEliminar.classList.add('btn', 'btn-borrar');

            // Agregarlo al Padre
            contenedorAcciones.appendChild(btnEliminar);

            // Agregarlo al tr
            nuevoContacto.appendChild(contenedorAcciones);

            // Agregarlo con los contactos
            listadoContactos.appendChild(nuevoContacto);

            // Resetear el formulario
            document.querySelector('form').reset();

            // Mostrar notificacion
            mostrarNotificacion('Contacto creado exitosamente', 'correcto');

            // Actualizar el número de contactos
            numeroContactos();
        }
    }
    //Enviar los datos
    xhr.send(datos);
}

// Actualizar datos
function actualizarRegistro(datos){
    //console.log(...datos);
    // AJAX
    // Crear el objeto
    const xhr = new XMLHttpRequest();
    // Abrir la conexión
    xhr.open('POST', 'inc/modelos/modelo-contactos.php', true);
    // Leer la respuesta
    xhr.onload= function(){
        if(this.status === 200){
            const respuesta = JSON.parse(xhr.responseText);

            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Contacto editado correctamente', 'correcto');
            }else{
                mostrarNotificacion('Error... No se edito el contacto!', 'error');
            }
            // Después de 3 segundos redireccionar.
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 4000);

        }
    }
    // Enviar la petición
    xhr.send(datos);
}

// Eliminar un contacto
function eliminarContacto(e){
    if(e.target.parentElement.classList.contains('btn-borrar')){
        // Tomar id del elemento
        const id = e.target.parentElement.getAttribute('data-id');
        // console.log(id);
    
        // Preguntar a usuario
        const respuesta = confirm('¿Estás seguro de querer eliminar este contacto?');
        if(respuesta){
            // Llamado a AJAX

            // Crear el objeto
            const xhr = new XMLHttpRequest();

            // Abrir la conexión
            xhr.open('GET', `inc/modelos/modelo-contactos.php?id=${id}&accion=borrar`, true);

            // Leer la respuesta
            xhr.onload = function(){
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);
                    
                    // Eliminar registro del DOM
                    if(resultado.respuesta === 'correcto'){
                        // Eliminar del DOM
                        e.target.parentElement.parentElement.parentElement.remove();

                        // Mostrar notificación de que se eliminó el contacto
                        mostrarNotificacion("Se eliminó el contacto!", 'correcto');

                        // Actualizar el número de contactos
                        numeroContactos();
                    }else{
                        // Mostrar notificación de error si no se elimina del DOM
                        mostrarNotificacion('Hubo un error!', 'error')
                    }
                }
            }

            // Enviar la petición
            xhr.send();
        }else{
            
        }
    }
}

// Notificación en pantalla cuando los campos esten vacios:
function mostrarNotificacion(mensaje, clase){
    const notificacion = document.createElement('div'); //Crea un element (Div)
    notificacion.classList.add(clase, 'notificacion', 'sombra') //Asigna una clase
    notificacion.textContent = mensaje;

    //Formulario
    formularioContactos.insertBefore(notificacion, document.querySelector('form legend'))

    // Ocultar y mostrar notificación
    setTimeout(() => {
        notificacion.classList.add('visible');

        setTimeout(() => {
            notificacion.classList.remove('visible');

            setTimeout(() => {
                notificacion.remove();
            }, 500);
            
        }, 3000);
    }, 100);

}

// Buscar contactos
function buscarContactos(e){
    const expresion = new RegExp(e.target.value, "i"), // el i del final es para que no tome en cuenta si es mayuscula o minuscula.
        registros = document.querySelectorAll('tbody tr');
    
        registros.forEach(registro => {
            registro.style.display = 'none';

            // console.log(registro.childNodes[1]); // El childnodes [1] es para filtrar por los nombres.
            if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1){ // Textcontent para traer solo el texto, replace() hace, este if pasa como true aquellos nombres que inicien con las letras que uno coloque en el buscador.
                    registro.style.display = 'table-row';
            }
            numeroContactos();
            
        })
}

// Mostrar el número de contactos
function numeroContactos(){
    const totalContactos = document.querySelectorAll('tbody tr'),
        contenedorNumero = document.querySelector('.total-contactos span');
    
    let total = 0;
    totalContactos.forEach(contacto => {
        if(contacto.style.display == '' || contacto.style.display == 'table-row'){
            total++;
        }
    });
    
    contenedorNumero.textContent = total;
}