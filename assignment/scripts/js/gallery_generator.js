//JS Gallery Generator
//Create XMLrequest object for communication
var xmlHttp = new XMLHttpRequest();
//stores number of horizontal columns gallery has
var numberOfColums = 2;
//Stores generated HTML code
var htmlCode = "";
//Temporarily stores server response
var response;

$(document).ready(function(){
    //setup path to PHP function
    var send = "scripts/php/hook.php";
    //Open GET connection to web server
    xmlHttp.open("GET", send, true);
    //Tell server client has no outgoing message
    xmlHttp.send(null);
    //Check for valid response
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4){
            //response handler
            //alert(xmlHttp.responseText);
            //tokenise response
            response = xmlHttp.responseText.split("~");
            //Loop round response array
            for ($i=0;$i<response.length;$i++){
                //Continue to build html code
                htmlCode += '<a href=".'+ response[$i].trim() +'" data-fancybox data-caption="My X3D model render">';
                htmlCode += '<img class="card-img-top img-fluid img-thumbnail" alt="3d model image" src=".' + response[$i] + '"/></a>';
            }
            //Write HTML code
            document.getElementById('gallery_images').innerHTML = htmlCode;
        }
    }
});