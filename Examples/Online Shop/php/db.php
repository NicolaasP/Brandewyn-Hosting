<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
require_once("../logging/Log.php");
require_once("item.php");
class db {
    private $log;
    private $connected = false;
    private $connectionTries =  5;
    private $conn = null;
    private $uTable = "users";
    private $itemTable = "items";
    private $salt = "Branas";
    public function __construct() {
        $this->log = new Logger("DB");
        $this->log->info("DB created");
        $this->tryConnect();
    }

    public function __destruct(){
        if($this->conn === null){
            return;
        }
        $this->conn->close();
        $this->uTable = "";
        $this->salt = "";
        $this->log->info("DB connection ended");
    }

    function connect() {
        $servername = "sql38.cpt3.host-h.net";
        $username = "brandewynShop_w";
        $password = "9WKcFdB2ATlJ05W6zh7L";
        $dbname = "exampleShop";

        try{
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            if ($this->conn->connect_error) {
                $this->log->error("Connection error" . $this->conn->connect_error);
                $this->connected = false;
            } else {
                $this->connected = true;
                $this->log->info("Connected");
            }
        }catch(mysqli_sql_exception $e){
            $this->log->error("Connection error caught" . $e->getMessage());
        }
    }

    function tryConnect() {
        $i =  0;
        while (!$this->connected) {
            $this->log->info("Attempting to connect " . $i . "/" . $this->connectionTries);
            $this->connect();
            if ($i >= $this->connectionTries) {
                $this->log->error("Could not connect in " . $this->connectionTries . " tries");
                die('Failed to connect in ' . $this->connectionTries . ' Tries');
            }
            $i++;
        }
    }

    function createLoginCookie($userId, $save = true) {
        $this->log->info('Creating token');
    
        // Generate a new token
        $token = bin2hex(random_bytes(16)); // Generate a random token
    
        // Prepare the SQL statement to insert the token and creation time into the database
        $sql = "UPDATE $this->uTable SET token = '$token', tCreation = '" . date('Y-m-d H:i:s') . "' WHERE id = '$userId';";
    
        // Execute the SQL statement using your custom execute method
        $result = $this->execute($sql);



        if(!$this->checkAcceptCookies($userId)) {
            $this->log->error("User $userId has not accepted cookies canceling creation");
            return false;
        }
        
    
        // Check if the execution was successful
        if ($result) {
            $this->log->info("Token created successfully");
            // Set the cookie in the user's browser
            if($save){
                setcookie("token", $token, time() + 604800, "/", ".brandewynhosting.co.za", true, true);
            }
            // Return the new token
            return true;
        } else {
            $this->log->error("Failed to create token");
            // Handle the error (e.g., log it, return an error message, etc.)
            return false;
        }
    }

    function acceptCookies($id){
        return $this->execute("UPDATE $this->uTable SET cAccept = 1 WHERE id=$id");
    }

    function checkAcceptCookies($id){
        $this->log->info("Checking if user: $id accepted cookies");
        $result = $this->query("SELECT cAccept FROM $this->uTable WHERE id=$id;");
        if($result === -1 || $result === 0) {
            $this->log->info("Could not find user: $id");
            return false;
        }
        $row = $result->fetch_assoc();
        if(!$row["cAccept"]){
            $this->log->info("User $id has not accepted cookies");
            return false;
        }
        $this->log->info("User has accpeted cookies");
        return true;
    }

    function checkCookies($token, $verify = false) {
        $this->tryConnect();
        $this->log->info("checking cookies");
        $uID = $this->getUserIdFromToken($token);
        if ($uID == null || $uID === -1) {
            $this->log->warning("Token not found");
            return false;
        }
        if(!$this->checkTTL($uID)){
            return false;
        }
        if(!$this->isVerified($this->getUname($uID)) && !$verify){
            $this->log->warning("User: $uID not verified");
            return false;
        }
        $this->log->info("Cookie found and valid");

        if(!$verify && $this->createLoginCookie($uID)){
            $this->log->info("New Cookie created succefully");
        }else{
            $this->log->warning("Failed to create new cookie");
        }
        $_SESSION["uID"] = $uID;
        return true;
    }

    function checkTTL($uID) {
        $cookieTTL =  604800;
        $this->tryConnect();
        $this->log->info("Checking cookie TTL");
        $sql = 'SELECT tCreation FROM ' . $this->uTable . ' where id = ' . $uID . ';';
        $result = $this->query($sql);
        if(!$result || $result->num_rows <= 0 || $result === -1 || $result === 0) {
            $this->log->info('No stored cookie: ' . $result);
            return false;
        }
        if ((strtotime($result->fetch_row()[0]) + $cookieTTL) > time()) {
            $this->log->info("Cookie is within TTL");
            return true;
        }
        $this->log->info("Cookie has died");
        return false;
    }

    private function query($sql) {
        $this->tryConnect();
        $this->log->info("Query: " . $sql);
        $stmt = $this->conn->prepare($sql);
        $this->log->info("Query Prepared");
        $stmt->execute();
        $this->log->info("Query executed");
        $errno = $stmt->errno;
        $result = $stmt->get_result();
        $this->log->info("err: " . $errno);
        if($result === null || !$result || $errno){
            $this->log->info("results are null/error for\n$sql\n");
            return -1;
        }
        $this->log->info("Got results");
        $this->log->info("Rows=$result->num_rows");
        if($result->num_rows <= 0 || !$result){
            $this->log->info("No rows returned for\n$sql\n");
            return 0;
        }
        $this->log->info("Returning results for query");
        return $result;
    }

    private function execute($sql) {
        $this->tryConnect();
        $this->log->info("Execute: " . $sql);
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    private function fetchAll($sql) {
        $this->tryConnect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if(!$result){
            return -1;
        }
        $arr = array();
        while($row = $result->fetch_assoc()){
            $arr[] = $row;
        }
        return $arr;
    }

    function login($uname, $pwd){
        $this->log->info("Starting login");
        $pwd = sha1($uname . $pwd . $this->salt);
        $sql = "SELECT id, pwd from $this->uTable where uname = '$uname';";
        $result = $this->query($sql);
        if($result === null || $result == -1){
            $this->log->info("User $uname not registered");
            return -1;
        }
        
        $row = $result->fetch_assoc();
        $dbPwd = $row["pwd"];
        if(!($dbPwd === $pwd)) {
            $this->log->info("User: $uname entered the wrong password");
            return -1;
        }
        $id = $row["id"];
        $this->log->info("User $uname logged in succefully");
        return $id;
    }

    function getUserIdFromToken($token) {
    
        // Get the result
        $result = $this->query("SELECT id FROM $this->uTable WHERE token='$token';");
    
        // Check if a row was returned
        if ($result->num_rows >  0 && $result !== -1 && $result !== 0) {
            // Fetch the user ID
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            // No user found with the given token
            return -1;
        }
    }

    function userExists($uname) {
        $this->log->info('Username check');
        $sql = "SELECT id FROM $this->uTable WHERE uname='$uname';";
        $result = $this->query($sql);
        
        if ($result && $result->num_rows >  0 && $result !== -1 && $result !== 0) {
            $this->log->info("Username found");
            // User exists
            return true;
        } else {
            $this->log->info("Username not found");
            // User does not exist
            return false;
        }
    }

    function emailExists($email) {
        $this->log->info('Email check');
        $sql = "SELECT id FROM $this->uTable WHERE email = '$email'";
        $result = $this->query($sql);
        
        if ($result && $result->num_rows >  0 && $result !== -1 && $result !== 0) {
            $this->log->info("Email found");
            // User exists
            return true;
        } else {
            $this->log->info("Email not found");
            // User does not exist
            return false;
        }
    }

    function getID($uname){
        $sql = "SELECT id from $this->uTable where uname='$uname';";
        $result = $this->query($sql);
        if($result === -1 || $result === 0){
            return -1;
        }
        $row = $result->fetch_assoc();
        return $row["id"];
    }

    function getUname($id){
        $sql = "SELECT uname from $this->uTable where id = '$id';";
        $result = $this->query($sql);
        if($result === -1 || $result === 0){
            return -1;
        }
        $row = $result->fetch_assoc();
        return $row["uname"];
    }

    function getToken($id){
        $result = $this->query("SELECT token from $this->uTable where id = '$id';");
        if($result === -1 || $result === 0){
            return -1;
        }
        $row = $result->fetch_assoc();
        return $row["token"];
    }

    function register($uname, $pwd, $email) {
        $pwd = sha1($uname . $pwd . $this->salt);
        $this->log->info("Starting reg");
        if($this->userExists($uname)){
            $this->log->info("User $uname already exists");
            return -1;
        }
        if($this->emailExists($email)){
            $this->log->info("Email $email already in db");
            return -1;
        }
        $sql = "INSERT INTO $this->uTable(uname, pwd, email) values('$uname', '$pwd', '$email');";
        $result = $this->execute($sql);
        if(!$result){
            $this->log->info("error registering user $uname");
            return false;
        }
        $this->log->info("User: $uname registered!");
        $id = $this->getID($uname);
        if(!$this->createLoginCookie($id)){
            $this->log->error("Could not create cookie for: $id");
            return $id;
        }
        return $id;
    }

    function verify($id){
        $this->createLoginCookie($id, false);
        return $this->execute("UPDATE $this->uTable SET validated = 1 WHERE id = $id;");
    }

    function isVerified($uname){
        $this->log->info("Checking user verification: $uname");
        $result = $this->query("SELECT validated FROM $this->uTable WHERE uname = '$uname';");
        if($result === -1 || $result === 0){
            $this->log->warning("No results to verify");
            return false;
        }
        $row = $result->fetch_assoc();
        return $row['validated'];
    }

    function add2Cart($uID, $id){
        $this->log->info("Adding $id to $uID's cart");
        $result = $this->query("SELECT cart FROM " . $this->uTable . " WHERE id = $uID");
        if($result === -1){
            $this->log->info("Could not get cart");
            return -1;
        }elseif($result === 0){
            $nCart = $id;
        }else{
            $cart = $result->fetch_assoc()["cart"];
            if($cart === ""){
                $nCart = $id;
            }else{
                $nCart = $cart . "," . $id;
            }
        }
        return $this->setCart($uID, $nCart);
    }

    function setCart($uID, $cart){
        $this->log->info("Setting $uID's cart: $cart");
        if($this->execute("UPDATE " . $this->uTable . " SET cart='$cart' WHERE id=$uID;")){
            $this->log->info("Cart updated successfully");
            return true;
        }else{
            $this->log->warning("Failed to update cart for $uID");
            return -1;
        }
    }

    function getItems($s = '%'){
        $items = array();
        $result = $this->query("SELECT * FROM $this->itemTable WHERE title like '$s' ORDER BY views DESC;");
        if($result === -1 || $result === 0){
            $this->log->warning("No items found");
            return -1;
        }
        while($row = $result->fetch_assoc()){
            $items[] = new Item($row['id'], $row['title'], $row['descript'],
                                $row['price'], $row['views'], $row['path']);
        }
        return $items;
    }

    function getItem($id){
        $this->log->info('Getting item: $id');
        $result = $this->query('SELECT * FROM ' . $this->itemTable . ' WHERE id=' . $id . ';');

        if($result === -1 || $result === 0){
            $this->log->info('No Item found');
            return -1;
        }

        $row = $result->fetch_assoc();
        return new Item($id, $row['title'], $row['descript'],
                        $row['price'], $row['views'], $row['path']);
    }

    function getCart($uID){
        $result = $this->query("SELECT cart FROM users WHERE id=$uID");
        if($result === -1 || $result === 0 || $result === false){
            $this->log->warning("Failed to get cart");
            return -1;
        }
        $this->log->info("Got cart");
        return $result->fetch_assoc();
    }

    function getCartItems($ids){
        $this->log->info("Getting items");
        return $this->fetchAll("SELECT id, title, price, descript FROM items WHERE id IN (" . implode(',', array_keys($ids)) . ")");
    }

    function addView($id){
        $this->log->info("Adding view to: $id");
        return $this->execute("UPDATE items SET views = views + 1 where id='$id';");
    }
}