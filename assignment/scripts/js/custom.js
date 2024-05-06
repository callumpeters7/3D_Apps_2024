$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});

//For active navigation switching
let navItems = document.querySelectorAll('li.discern a');

var counter = 0;
var spinning = false;
var wirecounter =0;

    function swap(selected)
    {
        // First don't display all div id contents
        document.getElementById('home').style.display = 'none';

        document.getElementById('about').style.display = 'none';

        document.getElementById('nothome').style.display = 'none';

        document.getElementById('coke').style.display = 'none';
        document.getElementById('cokedescrip').style.display = 'none';
        document.getElementById('cokecameracontrols').style.display='none';
        document.getElementById('cokeanimationcontrols').style.display='none';
        document.getElementById('cokerendercontrols').style.display='none';
        document.getElementById('coketexturecontrols').style.display='none';

        document.getElementById('sprite').style.display = 'none';
        document.getElementById('spritedescrip').style.display = 'none';
        document.getElementById('spritecameracontrols').style.display='none';
        document.getElementById('spriteanimationcontrols').style.display='none';
        document.getElementById('spriterendercontrols').style.display='none';
        document.getElementById('spritetexturecontrols').style.display='none';

        document.getElementById('drpepper').style.display = 'none';
        document.getElementById('drpepperdescrip').style.display = 'none';
        document.getElementById('drpeppercameracontrols').style.display='none';
        document.getElementById('drpepperanimationcontrols').style.display='none';
        document.getElementById('drpepperrendercontrols').style.display='none';
        document.getElementById('drpeppertexturecontrols').style.display='none';

        document.getElementById('fanta').style.display = 'none';
        document.getElementById('fantadescrip').style.display ='none';
        document.getElementById('fantacameracontrols').style.display='none';
        document.getElementById('fantaanimationcontrols').style.display='none';
        document.getElementById('fantarendercontrols').style.display='none';
        document.getElementById('fantatexturecontrols').style.display='none';

        //document.getElementById('gallery').style.display = 'none';
        //document.getElementById('3dview').style.display = 'none';

        
        // Display only selected contents
        switch(selected){
            case 'home':
            case 'about':
                document.getElementById(selected).style.display = 'block';
                break;
            case 'coke':
                document.getElementById('cokedescrip').style.display ='block';
                document.getElementById('cokecameracontrols').style.display='block';
                document.getElementById('cokeanimationcontrols').style.display='block';
                document.getElementById('cokerendercontrols').style.display='block';
                document.getElementById('coketexturecontrols').style.display='block';
                document.getElementById('nothome').style.display = 'block';
                document.getElementById(selected).style.display = 'block';
                document.getElementById("switcher").setAttribute("whichChoice", "0");
                changeCamera(0,"coke");
                lightingManipulate("coke");
                
                break;  
            case 'sprite':
                document.getElementById('spritedescrip').style.display ='block';
                document.getElementById('spritecameracontrols').style.display='block';
                document.getElementById('spriteanimationcontrols').style.display='block';
                document.getElementById('spriterendercontrols').style.display='block';
                document.getElementById('spritetexturecontrols').style.display='block';
                document.getElementById('nothome').style.display = 'block';
                document.getElementById("switcher").setAttribute("whichChoice", "1");
                changeCamera(0,"sprite");
                lightingManipulate("sprite");
                break;  
            case 'drpepper':
                document.getElementById('drpepperdescrip').style.display ='block';
                document.getElementById('drpeppercameracontrols').style.display='block';
                document.getElementById('drpepperanimationcontrols').style.display='block';
                document.getElementById('drpepperrendercontrols').style.display='block';
                document.getElementById('drpeppertexturecontrols').style.display='block';
                document.getElementById('nothome').style.display = 'block';
                document.getElementById(selected).style.display = 'block';
                document.getElementById("switcher").setAttribute("whichChoice", "2");
                changeCamera(0,"drpepper");
                lightingManipulate("drpepper");
                break;  
            case 'fanta':
                document.getElementById('fantadescrip').style.display ='block';
                document.getElementById('fantacameracontrols').style.display='block';
                document.getElementById('fantaanimationcontrols').style.display='block';
                document.getElementById('fantarendercontrols').style.display='block';
                document.getElementById('fantatexturecontrols').style.display='block';
                document.getElementById('nothome').style.display = 'block';
                document.getElementById(selected).style.display = 'block';
                document.getElementById("switcher").setAttribute("whichChoice", "3");
                changeCamera(0,"fanta");
                lightingManipulate("fanta");
                break;  
            default:
                document.getElementById('home').style.display = 'block'; //just redirect home if not found
                break;              
        }
    };

    function brandtonum(brand){
        num=""
        switch(brand){
            case "coke":
                num=1
                break;
            case "sprite":
                num=2
                break;
            case "drpepper":
                num=3
                break;
            case "fanta":
                num=4
                break;

        }
        return num;
    }

    function textureSwap(brand,option){
        num = brandtonum(brand);
        choice = num + 13;
        switch(option){
            case 1:
                $.getJSON('./scripts/json/data.json', function(jsonObj) {
                    document.getElementById('model'+num+'__texture').setAttribute('url', jsonObj.pageTextData[choice].url2);
                });
                break;
            case 2:
                $.getJSON('./scripts/json/data.json', function(jsonObj) {
                    document.getElementById('model'+num+'__texture').setAttribute('url', jsonObj.pageTextData[choice].url3);
                });
                break;
            default:
            case 0:
                $.getJSON('./scripts/json/data.json', function(jsonObj) {
                    document.getElementById('model'+num+'__texture').setAttribute('url', jsonObj.pageTextData[choice].url1);
                });
                break;
        }
    }

    function changeCamera(changer,brand){
        num = brandtonum(brand);

        switch(changer){
            case 0:
                document.getElementById('model'+num+'__Camera001'+brand).setAttribute('bind', 'true');
                break;
            case 1:
                document.getElementById('model'+num+'__Camera002'+brand).setAttribute('bind', 'true');
                break;
            case 2:
                document.getElementById('model'+num+'__Camera003'+brand).setAttribute('bind', 'true');
                break;
            case 3:
                document.getElementById('model'+num+'__Camera004'+brand).setAttribute('bind', 'true');
                break;
            case 4:
                break;
        }

    }

    function wireframe($res){
        var e = document.querySelectorAll('x3d');
        e = e[0]; //clumsy code sorry
        if ($res != wirecounter){
            if (wirecounter == 2 && $res == 0) {
                e.runtime.togglePoints(true);
            }
            if (wirecounter == 2 && $res == 1) {
                e.runtime.togglePoints(true);
                e.runtime.togglePoints(true);
            }
            if (wirecounter == 1 && $res == 2){
                e.runtime.togglePoints(true);
            }
            if (wirecounter == 1 && $res == 0){
                e.runtime.togglePoints(true);
                e.runtime.togglePoints(true);
            }
            if (wirecounter == 0 && $res == 1){
                e.runtime.togglePoints(true);
            }
            if (wirecounter == 0 && $res == 2){
                e.runtime.togglePoints(true);
                e.runtime.togglePoints(true);
            }
            wirecounter = $res;
        }
    }

    function lightingManipulate($chosen){
        $chose = 0;
        switch($chosen){
            case "on":
                $chose = "on";
                break;
            case "coke":
                $chose = "coke";
                break;
            case "sprite":
                $chose = "spri";
                break;
            case "drpepper":
                $chose = "drpe";
                break;
            case "fanta":
                $chose = "fant";
                break;
        }
        $navItems = document.querySelectorAll('PointLight');

        for ($b of $navItems){
            if ($chose == "on"){
                $b.setAttribute("on", "TRUE");
            } else if ($b.getAttribute("id").slice(-4) == $chose){
                $b.setAttribute("on", "TRUE");
            } else {
                $b.setAttribute("on", "FALSE");
            }
        };
    }

    function changeLook()
    {
        counter += 1;
        switch(counter) {
            case 1:
                document.getElementById('body').style.backgroundColor = "red";
                document.getElementById('header').style.backgroundColor = "#ff0000";
                document.getElementById('footer').style.backgroundColor = "#ff9900";
                break;
            case 2:
                document.getElementById('body').style.backgroundColor = "#ff6600";
                document.getElementById('header').style.backgroundColor = "#ff9999";
                document.getElementById('footer').style.backgroundColor = "#996699";
                break;
            case 3:
                document.getElementById('body').style.backgroundColor = "coral";
                document.getElementById('header').style.backgroundColor = "darkcyan";
                document.getElementById('footer').style.backgroundColor = "darksalmon";
                break;
            case 4:
                document.getElementById('body').style.backgroundColor = "lightgrey";
                document.getElementById('header').style.backgroundColor = "chocolate";
                document.getElementById('footer').style.backgroundColor = "dimgrey";
                break;
            case 5:
                counter = 0;
                document.getElementById('body').style.backgroundColor = "rgb(170, 224, 219)";
                document.getElementById('header').style.backgroundColor = "#760003";
                document.getElementById('footer').style.backgroundColor = "#760003";
                break;
        }
        // Use to change the style dynamically
    };

    function changeBack(){
        document.getElementById('body').style.backgroundColor = 'rgb(170, 224, 219)';
        document.getElementById('header').style.backgroundColor = "#760003";
        document.getElementById('footer').style.backgroundColor = "#760003";
        counter = 0;
    };

    function spin(num)
    {
        spinning = !spinning;
        document.getElementById('model'+num+'__RotationTimer').setAttribute('enabled', spinning.toString());
    }

    function stopRotation(num)
    {
        spinning = false;
        document.getElementById('model'+num+'__RotationTimer').setAttribute('enabled', spinning.toString());
    }

    function animateModel(num)
    {
        if(document.getElementById('model'+num+'__RotationTimer').getAttribute('enabled')!= 'true')
            document.getElementById('model'+num+'__RotationTimer').setAttribute('enabled', 'true');
        else
            document.getElementById('model'+num+'__RotationTimer').setAttribute('enabled', 'false');
    }

    