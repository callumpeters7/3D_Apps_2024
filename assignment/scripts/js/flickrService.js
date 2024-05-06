$(document).ready(function(){
    loadImages();
});
function loadImages()
{
    //Grab the image type you are looking for
    var txt = document.getElementById('txt').value;
    console.log(txt);
    //Create URI for flickr
    var urlFlickr = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
    //Use jquery getjson to fetch object
    $.getJSON(urlFlickr, {tags :txt, tagmode:"all", format:"json"}, function(data) {
        //console.log()
        console.log(data);

        //Build a handler to grab the data you want
        $('#title').html(data.title);
        $('#link').html(data.link);
        $('#description').html(data.description);
        $('#modified').html(data.modified);
        $('#generator').html(data.generator);
        var htmlCode = "";
        //Returns array of items
        $.each(data.items, function(i,item){
            //Remember gallery code in lab 5?
            htmlCode += '<div class="imgBox">' + '<div><h3> Title: ' + item.title + '</h3></div>';
            htmlCode += '<img src="' + item.media.m + '"/>';
            htmlCode += '<div><h4> Published: ' + item.published + '</h4></div></div>';
            //Set loop variable
            if (i==3) return false;
        });
        //Assign the htmlcode to images id
        $('#images').html(htmlCode);
    });
}