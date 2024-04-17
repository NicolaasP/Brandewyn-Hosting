<?php
require_once("../logging/Log.php");
    class Item{
        private $log;
        public $id;
        public $title;
        public $description;
        public $price;
        public $views;
        public $path;
        public $defPic;

        public $pics;

        public function __construct($id, $title, $description, $price, $views, $path){
            $this->log = new Logger("Item");
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->price = $price;
            $this->views = $views;
            $this->path = $path . "/";
            $this->setDef();
        }

        function setDef(){
            $temp = $this->path . "1.png";
            $this->log->info("Checking for image: $temp");
            if(file_exists($temp)){
                $this->log->info("Images found");
                $this->defPic = $temp;
                $this->log->info("Image path: $temp");
                $this->readAll();
            }else{
                $this->log->info("No image found defaulting");
                $this->defPic = "../itemPictures/default/default.png";
            }
        }

        function readAll(){
            $this->log->info("Scanning: " . $this->path);
            // Get an array of filenames from the directory
            $files = scandir($this->path);
            $this->log->info("Found: " . count($files) ." files");

            // Check if the directory was read successfully
            if ($files === false) {
                return;
            } else {
                // Initialize an array to hold only the file names
                $fileNames = array();

                // Loop through the array and add each filename to the new array
                foreach ($files as $file) {
                    // Skip the '.' and '..' entries
                    if ($file !== '.' && $file !== '..') {
                        // Check if the entry is a file
                        if (is_file($this->path . '/' . $file)) {
                            $fileNames[] = $file;
                            $this->log->info("File: $file added to array");
                        }
                    }
                }
                $this->log->info("Found: " . count($fileNames) ." Pictures");
                $this->pics = $fileNames;
            }

        }
    }
?>