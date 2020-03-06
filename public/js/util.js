function mensaje_danger(msj){
    new PNotify({
        title: '¡Alerta!',
        text: msj,
        type: 'error',
        hide: true,
        styling: 'bootstrap3'
    });
}
function mensaje_success(msj){
    new PNotify({
        title: 'OK',
        text: msj,
        type: 'success',
        hide: true,
        styling: 'bootstrap3'
    })
}
function mensaje_warning(msj){
    new PNotify({
        title: '¡Advertencia!',
        text: msj,
        styling: 'bootstrap3'
    })
}


function abre_loading(mensaje) {
    //eliminamos si existe un div ya bloqueando
    cierra_loading();
         
    //si no enviamos mensaje se pondra este por defecto
    //var mensaje="Su solicitud está siendo procesada"/*linea agregada, en caso se envie el parametro mensaje borrar esta linea*/
    if (mensaje === undefined) mensaje = "Su solicitud está siendo procesada<br>Espere por favor";
         
    //centrar imagen gif
    height = 350;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
         
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
         
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
         
    //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div id='letra' style='text-align:center;height:" + alto + "px;' class=''><div style='color:#FFF;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold' class='original_condellbio-semibold'><div class='lds-css ng-scope'><div style='width:100%;height:100%' class='lds-facebook '><div></div><div></div><div></div></div></div><br>" + mensaje + "</div></div>";
         
    //creamos el div que bloquea grande------------------------------------------
    div = document.createElement("div");
    div.id = "WindowLoad"
    div.style.width = 100 + "%";
    div.style.height = 100 + "%";
    $("body").append(div);
         
    //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
    input = document.createElement("input");
    input.id = "focusInput";
    input.type = "text"
         
    //asignamos el div que bloquea
    $("#WindowLoad").append(input);
         
    //asignamos el foco y ocultamos el input text
    $("#focusInput").focus();
    $("#focusInput").hide();
         
    //centramos el div del texto
    $("#WindowLoad").html(imgCentro);
}

function cierra_loading(){
    $("#WindowLoad").remove();
}