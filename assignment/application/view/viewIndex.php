<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.css">
      <!-- X3DOM-->
      <link rel='stylesheet' type="text/css" href="css/x3dom.css">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="css/custom.css">

      <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
      
      <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
      <title>Soda Wonder</title>
  </head>
  <body id="body">
    <!-- Code uses remnants from labs 1-8 -->
    <?php //Split data gathered in the two different databases
      $data = $data;
    ?>

    <!-- logo and nav-->
    <nav class="navbar sticky-top navbar-expand-sm navbar_coca_cola" id="header">      
      <!--Brand-->
      <div class="logo">
        <a class="navbar-brand" href="javascript:swap('home')">
          <div>
            <div id="logo1_fetch"></div>
            <div id="logo2_fetch"></div>
          </div>
          <div id="logo3_fetch"></div>
        </a>
      </div>

      <!--Collapsible navbar-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!--Links-->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="javascript:swap('home')">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:swap('about')">About</a>
          </li>
          <!--Dropdown-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Drinks</a>
            <div class="dropdown-menu">
              <?php for ($i=0; $i < count ($data); $i++){ ?>
                <a class="dropdown-item" href="javascript:swap('<?php echo $data[$i]['brandPath'] ?>')"><?php echo $data[$i]['brandName']?></a>
              <?php }?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#statementModal">Statement</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">Contact</a>
          </li>
        </ul>
      </div>
    </nav>

    <br>
    <!-- Home page block element-->
    <div id="home" class="container main_contents">
    <!-- Main 3d image -->
      <div class="row">
        <div class="col-sm-12">
          <div id="background_welcome">
            <div id="main_text" class="col-xs-12 col-sm-4">
              <div id="title_welcome"></div>
              <div id="subtitle_welcome"></div>
              <div id="description_welcome"></div>
            </div>
          </div>
        </div>
      </div>

      <br>

      <!--GENERATE EACH card-->
      <?php for ($i=0; $i < count ($data); $i++){ 
        if ($i % 4 == 0 ){ //Makes it so that four elements are displayed a row on home page.
        ?>
        <div class="row">
        <?php
        }
        ?>
          <div class="col-sm-3">
            <div class="card">
              <a class="logohover" id="image_<?php echo $data[$i]['brandPath'] ?>" href="javascript:swap('<?php echo $data[$i]['brandPath'] ?>')"></a>
              
              <div class="card-body">
                <div class="card-title homeText" id="title_<?php echo $data[$i]['brandPath'] ?>"></div>
                <div class="card-subtitle homeText" id="subtitle_<?php echo $data[$i]['brandPath'] ?>"></div>
                <div class="card-text homeText"><p><?php echo $data[$i]['modelDescription'] ?></p></div>
                <a href="javascript:swap('<?php echo $data[$i]['brandPath'] ?>')" class="btn btn-primary">Find out more...</a>
              </div>
            </div>
          </div>
        <?php
      if ($i+1 % 4 == 0 || $i == count($data)-1  ){ //close div tag if the last before new row
      ?>
        </div>
      <?php
      }
      }?>
    </div>

    <div id="about" class="container main_contents"  style="display: none;">
    <!-- Main 3d image -->
      <div class="row">
        <div class="col-sm-12">
          <div>
            <div id="main_text" class="col-xs-12 col-sm-4">
              <div id="title_about"></div>
              <div id="description_about"></div>  
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main 3d image -->
    <!-- 'Nothome' block element... contains grid elements for Coke, Sprite, Dr Pepper, etc. -->
    <div id="nothome" class="container-fluid main_contents" style="display: none;">
      <div class="row">

        <!-- Web 3d window (should always be visible, but gets changed)-->
        <div class="col-sm-10">
          <div class="card text-left">
            <div class="card-header">
              <!-- Top navigation -->
              <ul class="nav nav-tabs card-header-tabs">

                <?php for ($i=0; $i < count ($data); $i++){ ?>
                  <li class="nav-item discern"> <!-- HIGHLIGHT BROKEN -->
                    <a class="nav-link" href="javascript:swap('<?php echo $data[$i]['brandPath'] ?>')" ><?php echo $data[$i]['brandName']?> </a>
                  </li>
                <?php } ?>
              </ul>
            </div>

            <!-- Start of X3D view-->
            <div class="card-body">
              <div class="container-fluid main_contents">

                <div class="model3D">
                  <x3d>
                    <scene>
                      <Switch id="switcher" whichChoice="0">
                        <?php for ($i=0; $i < count ($data); $i++){ ?>
                          <Transform>
                            <inline nameSpaceName="model<?php echo $i+1 ?>" mapDEFToId="true" onclick="animateModel();" url="<?php echo $data[$i]['modelPath']?>"></inline>
                          </Transform>
                        <?php }?> 
                      </Switch>
                    </scene>
                  </x3d>
                </div>

                <br>

                <!--X3D title + creation X3D code--> 
                <?php for ($i=0; $i < count ($data); $i++){ ?>
                  <div id="<?php echo $data[$i]['brandPath']?>" style="display: none;">
                    <h2><?php echo $data[$i]['x3dModelTitle']?></h2>
                    <p><?php echo $data[$i]['x3dCreationMethod']?></p>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Gallery window (should always be visible)-->
        <div class="col-sm-2">
          <div class="card text-left">
            <div class="card-header gallery-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link active">Gallery</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <!-- Dynamically generated -->
              <div id="title_gallery"></div>
              <div class="gallery" id="gallery_images"></div> <!-- for gallery_generator.js -->
              <div id="description_gallery"></div>
            </div>
          </div>
        </div>

      </div>

      <br>

      <!-- Row 2-->
      <div class="row" id="interaction">
        <div class="col-sm-3"> <!-- Camera controls-->
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link active">Camera Views</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div id="title_camera"></div>
              <div id="description_camera"></div>

              <?php for ($i=0; $i < count ($data); $i++){ ?>
                <div class="camera-btns" id="<?php echo $data[$i]['brandPath']?>cameracontrols" style="display:none;">
                <div class="btn-group">
                    <a href="javascript:changeCamera(0,'<?php echo $data[$i]['brandPath']?>')" class="btn btn-primary btn-responsive camera-font">Default</a>
                    <a href="javascript:changeCamera(1,'<?php echo $data[$i]['brandPath']?>')" class="btn btn-secondary btn-responsive camera-font">Back</a>
                    <a href="javascript:changeCamera(2,'<?php echo $data[$i]['brandPath']?>')" class="btn btn-success btn-responsive camera-font">Left</a>
                    <a href="javascript:changeCamera(3,'<?php echo $data[$i]['brandPath']?>')" class="btn btn-danger btn-responsive camera-font">Right</a>
                </div>
              </div>

              <?php } ?>

            </div>
          </div>
        </div>

        <div class="col-sm-3"> <!-- Animation options-->
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                  <a class="nav-link active">Animation Options</a>
                </li>
              </ul>
            </div>
            <div class="card-body">

            <div id="title_animation"></div>
            <div id="description_animation"></div>

              <?php for ($i=0; $i < count ($data); $i++){ ?>
                <div class="camera-btns" id="<?php echo $data[$i]['brandPath']?>animationcontrols" style="display:none;">
                <div class="btn-group">
                    <a href="#" onclick="spin('<?php echo $i+1?>');" class="btn btn-success btn-responsive camera-font">Start</a>
                    <a href="#" onclick="stopRotation('<?php echo $i+1?>');" class="btn btn-danger btn-responsive camera-font">Stop</a>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-sm-3"> <!-- Render and Lighting Options-->
          <div class="card">
            <div class="card-header">
              <!-- Top navigation -->
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active">Render & Lights</a></li>
              </ul>
            </div>
            <div class="card-body">
            <div id="title_renderlighting"></div>
            <div id="description_renderlighting"></div>

              <?php for ($i=0; $i < count ($data); $i++){ ?>
                <div class="camera-btns" id="<?php echo $data[$i]['brandPath']?>rendercontrols" style="display:none;">
                  <div class="btn-group">
                      <a href="javascript:wireframe(1)" class="btn btn-primary btn-responsive camera-font">Poly</a>
                      <a href="javascript:wireframe(2)" class="btn btn-primary btn-responsive camera-font">Wireframe</a>
                      <a href="javascript:wireframe(0)" class="btn btn-primary btn-responsive camera-font">Default</a>
                  </div>
                  <div class="btn-group">
                      <a href="javascript:lightingManipulate('on')" class="btn btn-danger btn-responsive camera-font">All Lights</a>
                      <a href="javascript:lightingManipulate('off')" class="btn btn-danger btn-responsive camera-font">Lights Off</a>
                      <a href="javascript:lightingManipulate('<?php echo $data[$i]['brandPath']?>')" class="btn btn-danger btn-responsive camera-font">Default</a>
                  </div>

                  
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-sm-3"> <!-- Texture Swapping Options-->
          <div class="card">
            <div class="card-header">
              <!-- Top navigation -->
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active">Texture Switching</a></li>
              </ul>
            </div>
            <div class="card-body">
            <div id="title_texture"></div>
            <div id="description_texture"></div>

              <?php for ($i=0; $i < count ($data); $i++){ ?>
                <div class="camera-btns" id="<?php echo $data[$i]['brandPath']?>texturecontrols" style="display:none;"> 
                <!-- Create different menu for each model. Each with 2 options + default -->
                <!-- Coca-Cola can be default,  Diet Coke and Coke Zero -->
                <!-- Sprite can be default,  Sprite Zero and Sprite Cherry -->
                <!-- Dr Pepper can be default,  Dr Pepper Zero Sugar and Dr Pepper Cream Soda ? -->
                <!-- Fanta can be default,  Fanta Cherry and Fanta Berry ? -->

                  <div class="btn-group">
                      <a href="javascript:textureSwap('<?php echo $data[$i]['brandPath']?>', 0)" class="btn btn-primary btn-responsive camera-font">Default</a> 
                      <a href="javascript:textureSwap('<?php echo $data[$i]['brandPath']?>', 1)" class="btn btn-secondary btn-responsive camera-font">Option 1</a> 
                      <a href="javascript:textureSwap('<?php echo $data[$i]['brandPath']?>', 2)" class="btn btn-success btn-responsive camera-font">Option 2</a> 
                  </div>

                  
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      
      
      <!-- Row 3 -->
      <div class="row">
        <!-- Description windows (change depending on selection)-->
        <?php for ($i=0; $i < count ($data); $i++){ ?>
          <div class="col-sm-12" id="<?php echo $data[$i]['brandPath']?>descrip" style="display:none;">
            <div class="card">
              <div class="card-body">
                <h2><?php echo $data[$i]['modelSubtitle']?></h2>
                <p><?php echo $data[$i]['modelDescription']?></p>
                <a href="http://www.coca-cola.co.uk/drinks/coca-cola/coca-cola" class="btn btn-primary">Find out more...</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

    </div>
    <!-- Nothome end-->  

    <!-- 3D App Footer -->
    <nav class="navbar navbar-expand-sm footer" id="footer">
      <div class="container">
        <div class="navbar-text float-left copyright">
          <p style="color:white; margin-bottom:0;"><span class="align-baseline">&copy 2024 Mobile Web 3D Applications
          |<a href="javascript:changeLook()" style="text-decoration:none">Change Look</a>|
          |<a href="javascript:changeBack()" style="text-decoration:none">Change Back</a>|
          </span></p>
        </div>
        <div class="navbar-text float-right social">
          <a href="#"><i class="fab fa-facebook-square fa-2x fa-pull-right"></i></a>
          <a href="#"><i class="fab fa-twitter fa-2x fa-pull-right"></i></a>
          <a href="#"><i class="fab fa-google-plus fa-2x fa-pull-right"></i></a>
          <a href="#"><i class="fab fa-github-square fa-2x fa-pull-right"></i></a>
        </div>
      </div>
    </nav>

    <!-- 3D App Modals-->
    <!-- Contact modal-->
    <!-- The modal-->
    <div class="modal fade" id="contactModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header" id="title_contact"></div>
                
                <!-- Modal body -->
                <div class="modal-body">
                  <div id="subtitle_contact"></div>
                  <div id="description_contact"></div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>

            </div>
          </div>
    </div>
    <div class="modal fade" id="statementModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header" id="title_originality"></div>
                
                <!-- Modal body -->
                <div class="modal-body" id="description_originality"></div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>

            </div>
          </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="scripts/js/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="scripts/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/8703412fa7.js" crossorigin="anonymous"></script>

    <script src="scripts/js/custom.js"></script>


    <script src="scripts/js/getJsonData.js"></script>

    

    <!--X3DOM JS-->
    <script type="text/javascript" src="scripts/js/x3dom.js"></script>

    <script type="text/javascript" src="scripts/js/gallery_generator.js"></script>

    <script src="scripts/js/jquery.fancybox.min.js" type="text/javascript"></script>
    
  </body>
</html>

