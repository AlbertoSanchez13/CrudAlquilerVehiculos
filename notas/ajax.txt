/* Enviar formularios via AJAX */
const formularios_ajax = document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {

    formularios.addEventListener("submit", function (e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Quieres realizar la acción solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                //Array de datos, cuando le demos al si capturamos todos los datos de los imputs
                //Array de datos, clave valor
                let data = new FormData(this);
                let method = this.getAttribute("method");
                let action = this.getAttibute("action");

                let encabezados = new Headers();

                //configuraciones de la api de fetch json
                let config = {
                    method: method,
                    headers: encabezados,
                    mode: 'cors',
                    cache: 'no-cache',
                    /* body son los datos que queremos enviar */
                    body: data
                };

                /* le pasamos el primer parametro que seria la url */
                /* Api de fetch */
                fetch(action, config)
                    /* aqui convertimos la respuesta en formato .json */
                    .then(respuesta => respuesta.json()) /* cuando resivamos la respuesta en formato json  */
                    .them(respuesta => { /* luego se ejecuta lo que esta dentro de las llaves */
                        return alertas_ajax(respuesta); /* aqui la funcion resive el json */
                    });
            }
        });

    });

});




function alertas_ajax(alerta) {

    if (alerta.tipo == "simple") {

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.tipo == "recargar") {

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });

    } else if (alerta.tipo == "limpiar") {

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
        });

        /* aqui el parametro alerta va tener el tipo:"redireccionar" */
    } else if (alerta.tipo == "redireccionar") {

        window.location.href = alerta.url;
    }


}


/* Boton cerrar sesion */






















/* https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach */
