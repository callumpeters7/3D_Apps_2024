//JS Document
$(document).ready(function(){

    //AJAX service request to get the main text data from the JSON data store
    $.getJSON('./scripts/json/data.json', function(jsonObj) {

        //======== Home page ==========
            //Logo text
                $('#logo1_fetch').html('<h1>' + jsonObj.pageTextData[0].title + '</h1>');
                $('#logo2_fetch').html('<h1>' + jsonObj.pageTextData[0].subtitle + '</h1>');
                $('#logo3_fetch').html('<p>' + jsonObj.pageTextData[0].description + '</p>');

            // Main welcome part
                $('#title_welcome').html('<h2>' + jsonObj.pageTextData[1].title + '</h2>');
                $('#subtitle_welcome').html('<h3>' + jsonObj.pageTextData[1].subtitle + '</h3>');
                $('#description_welcome').html('<p>' + jsonObj.pageTextData[1].description + '</p>');
                document.querySelector("#background_welcome").style.backgroundImage = `url(${jsonObj.pageTextData[1].url})`;

            //Coke column text
                $('#image_coke').html('<img class="card-img-top" src="' + jsonObj.pageTextData[2].url + '"/>');
                $('#title_coke').html('<h2>' + jsonObj.pageTextData[2].title + '</h2>');
                $('#subtitle_coke').html('<h3>' + jsonObj.pageTextData[2].subtitle + '</h3>');

            //Sprite column text
                $('#image_sprite').html('<img class="card-img-top" src="' + jsonObj.pageTextData[3].url + '"/>');
                $('#title_sprite').html('<h2>' + jsonObj.pageTextData[3].title + '</h2>');
                $('#subtitle_sprite').html('<h3>' + jsonObj.pageTextData[3].subtitle + '</h3>');

            //Dr Pepper column text
                $('#image_drpepper').html('<img class="card-img-top" src="' + jsonObj.pageTextData[4].url + '"/>');
                $('#title_drpepper').html('<h2>' + jsonObj.pageTextData[4].title + '</h2>');
                $('#subtitle_drpepper').html('<h3>' + jsonObj.pageTextData[4].subtitle + '</h3>');
            
            //Fanta column text
                $('#image_fanta').html('<img class="card-img-top" src="' + jsonObj.pageTextData[5].url + '"/>');
                $('#title_fanta').html('<h2>' + jsonObj.pageTextData[5].title + '</h2>');
                $('#subtitle_fanta').html('<h3>' + jsonObj.pageTextData[5].subtitle + '</h3>');

        //======== Misc pages/sections ==========
            //About page
                $('#title_about').html('<h2>' + jsonObj.pageTextData[6].title + '</h2></br>');
                $('#description_about').html('<p>' + jsonObj.pageTextData[6].description + '</p>');

            //Contact modal
                $('#title_contact').html('<h4 class="modal-title">' + jsonObj.pageTextData[7].title + '</h4>');
                $('#subtitle_contact').html('<p>' + jsonObj.pageTextData[7].subtitle + '</p>');
                $('#description_contact').html('<p>' + jsonObj.pageTextData[7].description + '</p>');

            //Statement of originality modal
                $('#title_originality').html('<h4 class="modal-title">' + jsonObj.pageTextData[8].title + '</h4>');
                $('#description_originality').html('<p>' + jsonObj.pageTextData[8].description + '</p>');
        
        //======== 3D Model Page ==================
            //3D Models and Descriptions
                //3d models are fetched from SQLite instead as they are kept in data store.

            //3D Model Gallery
                $('#title_gallery').html('<h5>' + jsonObj.pageTextData[9].title + '</h5>');
                $('#description_gallery').html('<p>' + jsonObj.pageTextData[9].description + '</p>');

        //======== Options =========
            //Camera Views Text
                $('#title_camera').html('<h5>' + jsonObj.pageTextData[10].title + '</h5>');
                $('#description_camera').html('<p>' + jsonObj.pageTextData[10].description + '</p>');

            //Animation Options Text
                $('#title_animation').html('<h5>' + jsonObj.pageTextData[11].title + '</h5>');
                $('#description_animation').html('<p>' + jsonObj.pageTextData[11].description + '</p>');

            //Render and Lighting Options Text
                $('#title_renderlighting').html('<h5>' + jsonObj.pageTextData[12].title + '</h5>');
                $('#description_renderlighting').html('<p>' + jsonObj.pageTextData[12].description + '</p>');

            //Texture Switching Options Text
                $('#title_texture').html('<h5>' + jsonObj.pageTextData[13].title + '</h5>');
                $('#description_texture').html('<p>' + jsonObj.pageTextData[13].description + '</p>');
    });
});