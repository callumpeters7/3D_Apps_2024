<?php
class Model {

    //Property declaration, in this case we are declaring a variable or handler that points to DB connection
    //Will become PDO object
    public $dbhandle;
    //Method to simulate model data
    public function __construct()
    {
        //Set up db source name
        $dsn = 'sqlite:./db/test1.db';

        //Then create connection with PDO()
        try{
            //change connnection string for diff. databases (Current: SQLLite)
            $this->dbhandle = new PDO($dsn, 'user', 'password', array(
                                                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                    PDO::ATTR_EMULATE_PREPARES => false,
            ));
            //this->dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'Database connection created</br></br>';
        }
        catch (PDOEXception $e){
            echo "Couldn't connect to the database.";
            //gen error message
            print new Exception($e->getMessage());
        }
    }
    function dbCreateTable()
    {
        try {
            $this->dbhandle->exec("CREATE TABLE Model_3D (
                Id INTEGER PRIMARY KEY, 
                x3dModelTitle TEXT, 
                x3dCreationMethod TEXT, 
                modelPath TEXT, 
                modelSubtitle TEXT, 
                modelDescription TEXT, 
                brandName TEXT,
                brandPath TEXT)");
            return "Model_3D table is successfully created inside test1.db file";
        }
        catch (PD0EXception $e){
            print new Exception($e->getMessage());
        }
        $this->dbhandle = NULL;
    }

    function dbInsertData(){ //Insert models into DB
        try{
            $this->dbhandle->exec(
                "INSERT INTO Model_3D (Id, x3dModelTitle, x3dCreationMethod, modelPath, modelSubtitle, modelDescription, brandName, brandPath)
                    VALUES (1, 'Coca Cola X3D Model', 'This X3D model of a Coca-Cola can has been created in 3ds Max, exported to VRML97 and converted using the instantreality transcoders, to X3D for display online.', 'assets/x3d/coke.x3d', 'The story of Coca-Cola', 'The iconic beverage, Coca-Cola, traces its origins back to the late 1800s, when pharmacist John Pemberton concoted a syrupy tonic in Atlanta, Georgia, in 1886. Initially marketed as a medicinal drink, Coca-Cola soon evolved into a popular soda, thanks to its refreshing taste. It then rapidly devleloped into a global phenomenon, becoming a symbol of American culture.', 'Coke', 'coke'); " . 
                "INSERT INTO Model_3D (Id, x3dModelTitle, x3dCreationMethod, modelPath, modelSubtitle, modelDescription, brandName, brandPath)
                    VALUES (2, 'Sprite X3D Model', 'This X3D model of a Sprite bottle has been created in 3ds Max, exported to VRML97 and converted using the instantreality transcoders, to X3D for display online.', 'assets/x3d/sprite.x3d', 'The story of Sprite', 'Sprite emerged as a product of the Coca-Cola Company in 1961. Originally developed in West Germany as Fanta Klare Zitrone, it was rebranded as Sprite when it was introduced to the United States, and it stuck. Primarily made as a competitor to 7-UP, Sprite gained popularity as a refreshing caffeine-free alternative to Coca-Cola.', 'Sprite', 'sprite'); " .
                "INSERT INTO Model_3D (Id, x3dModelTitle, x3dCreationMethod, modelPath, modelSubtitle, modelDescription, brandName, brandPath)
                    VALUES (3, 'Dr Pepper X3D Model', 'This X3D model of a Dr. Pepper bottle has been created in 3ds Max, exported to VRML97 and converted using the instantreality transcoders, to X3D for display online.', 'assets/x3d/drpepper.x3d', 'The story of Dr Pepper', 'Dr Pepper has a storied history dating back to 1885. Pharmacist Charles Alderton created the recipe in Waco, Texas, which was originally served at Morrisons Old Corner Drug Store. In 1904, the beverage was officially trademarked, and the Dr Pepper Company was established, bringing in widespread commercial success. Dr Pepper remains a beloved part of American soda culture, referred to as the oldest major soft drink in the United States.', 'Dr Pepper', 'drpepper'); " .
                "INSERT INTO Model_3D (Id, x3dModelTitle, x3dCreationMethod, modelPath, modelSubtitle, modelDescription, brandName, brandPath)
                    VALUES (4, 'Fanta X3D Model', 'This X3D model of a Fanta can has been created in 3ds Max, exported to VRML97 and converted using the instantreality transcoders, to X3D for display online.', 'assets/x3d/fanta.x3d', 'The story of Fanta', 'Fanta has its roots in World War II-era Germany, when Coca-Colas operations were cut off from importing syrup due to trade embargoes. Max Keith, the head of Coca-Colas German operations, tasked his team with creating a new beverage using locally available ingredients. The result was Fanta, introduced in 1941. After the war, Fanta was rebranded and reformulated with different flavors, becoming a global success under the Coca-Cola Company.', 'Fanta', 'fanta'); ");
                return "X3D model data inserted successfully inside test1.db";
        }
        catch (PD0EXception $e){
            print new Exception($e->getMessage());
        }
        $this->dbhandle = NULL;
    }

    function dbGetData(){
        try{
            //Prepare statement to get all records
            $sql = 'SELECT * FROM Model_3D';
            //Use PDO query
            $stmt = $this->dbhandle->query($sql);
            //set up array to return results
            $result = null;
            //Set up var to index each row
            $i = 0;
            //Use PDO fetch to retrieve results
            while ($data = $stmt->fetch()) {
                $result[$i]['x3dModelTitle'] = $data['x3dModelTitle'];
                $result[$i]['x3dCreationMethod'] = $data['x3dCreationMethod'];
                $result[$i]['modelPath'] = $data['modelPath'];
                $result[$i]['modelSubtitle'] = $data['modelSubtitle'];
                $result[$i]['modelDescription'] = $data['modelDescription'];
                $result[$i]['brandName'] = $data['brandName'];
                $result[$i]['brandPath'] = $data['brandPath'];
                //increment
                $i++;
            }
        }
        catch (PD0EXception $e){
            print new Exception($e->getMessage());
        }
        //Close connection
        $this->dbhandle = NULL;
        return $result;
    }
}
?>