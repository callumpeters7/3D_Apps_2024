<?php
    include '../../debug/ChromePhp.php';
    ChromePhp::log('modelDrinkDetails.php: Hello World');
    ChromePhp::log($_SERVER);

    //Get brand name
    ChromePhp::warn('modelDrinkDetails.php: Get Brand details');
    $brandName = $_GET['brand'];

    ChromePhp::warn('modelDrinkDetails.php: Make a connection to test1.db');
    //Connect to database table and retrieve the required brand data
    try {
        //Make a connection to drinks db
        $dbhandle = new PDO('sqlite:../../db/test1.db', 'user', 'password', array(
                                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                        PDO::ATTR_EMULATE_PREPARES => false,
                                                    ));
        ChromePhp::warn('modelDrinkDetails.php: Connected to test1.db');

        //Prepare SQL statement to select record matching brandname in view dropdown
        ChromePhp::warn('modelDrinkDetails.php: Prepare PDO SQL statement');
        $sql = 'SELECT * FROM Model_3D WHERE brand = "'. $brandName . '"';
        ChromePhp::warn( $sql);

        //Use PDO query to query database with SQL
        ChromePhp::warn('modelDrinkDetails.php: PDO query SQL statement');
        ChromePhp::warn($sql);
        $stmt = $dbhandle->query($sql);
        ChromePhp::warn($stmt);

        //Set up array to return results to view
        $result = null;
        //Set up var to index each row
        $i=0;

        //Use PDO fetchall() the results from database using while loop
        //Use while loop to loop through table rows - may be more than one record with the same brand name
        ChromePhp::warn('modelDrinkDetails.php: got this far');
        while ($data = $stmt->fetch()) {
            ChromePhp::warn('modelDrinkDetails.php: PDO fetch data from test1.db');
            ChromePhp::warn($data);
            //Write database contents to results array for sending back to view
            $result[$i]['brand'] = $data['brand'];
            $result[$i]['x3dModelTitle'] = $data['x3dModelTitle'];
            $result[$i]['x3dCreationMethod'] = $data['x3dCreationMethod'];
            $result[$i]['modelTitle'] = $data['modelTitle'];
            $result[$i]['modelSubtitle'] = $data['modelSubtitle'];
            $result[$i]['modelDescription'] = $data['modelDescription'];

            //Increment row index
            $i++;
            ChromePhp::warn('modelDrinkDetails.php: Here is the test1.db data');
            ChromePhp::warn($result);
        } 
    }
    catch(PDOEXception $e){
        ChromePhp::warn('modelDrinkDetails.php: Code error on server');
        print new Exception($e->getMessage());
    }

    //Close db connection
    $dbhandle=NULL;
    ChromePhp::warn('modelDrinkDetails.php: echo result to frontend in JSON packet');
    ChromePhp::warn($result);
    echo json_encode($result);
?>