<?php 
    include './debug/ChromePhp.php';
    ChromePhp::log('controller.php: Hello World');
    ChromePhp::log($_SERVER);
    //create controller class for MVC design
    class Controller{

        //declare public variables
        public $load;
        public $model;


        //Create functions for controller class
        function __construct($pageURI = null) //constructor of theclass
        {
            //Create new objects for Load and Model
            $this->load = new Load();
            $this->model = new Model();
            //Determine what page you're on
            $this->$pageURI();

        }
        // Home page function
        function home()
        {
            $data = $this->model->dbGetData(); //get data from defined model method - model3D_info()
            $this->load->view('viewIndex', $data); //Tell loader what view to load and which dat to use
        }
        
        function apiCreateTable()
        {
            $data = $this->model->dbCreateTable();
            $this->load->view('viewMessage', $data);   
        }

        function apiInsertData(){
            $data = $this->model->dbInsertData();
            $this->load->view('viewMessage', $data);
        }
        function apiGetData(){
            $data = $this->model->dbGetData();
            $this->load->view('view3DAppData', $data);
        }
        
    }
?>