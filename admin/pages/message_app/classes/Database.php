<?php 

class Database{

    private $conn;

    //construct
    function __construct(){
        $this->conn = $this->connect();
    }

    //connect to database
    private function connect() {

        $string = "mysql:host=localhost;dbname=college_mgmt";
        try{
            $connection = new PDO( $string, DBUSER, DBPASS );
            return $connection;
        } catch (PDOException $e ) {
            echo $e->getMessage();
            die;
        }

        return false;
    }

    //insert data in database
    public function write( $query, $data_array = [] ) {
        $conn = $this->connect();
        $statement = $conn->prepare( $query );
        foreach( $data_array as $key => $value ) {
            $statement->bindParam(':' . $key , $value );
        }
        $check = $statement->execute( $data_array);
        if( $check ) {
            return true;
        }
        return false;
    }

    //read data from database
    public function read( $query, $data_array = [] ) {
        $conn = $this->connect();
        $statement = $conn->prepare( $query );
        foreach( $data_array as $key => $value ) {
            $statement->bindParam(':' . $key , $value );
        }
        $check = $statement->execute( $data_array);
        if( $check ) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if( is_array( $result ) && count( $result ) > 0 ) {
                return $result;
            }
            return false;
        }
        return false;
    }

     //get users
     public function get_user( $userid ) {
        $conn = $this->connect();
        $arr['userid'] = $userid;
        $query = "SELECT * FROM users WHERE userid = :userid LIMIT 1";
        $statement = $conn->prepare( $query );
        $check = $statement->execute( $arr);
        if( $check ) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if( is_array( $result ) && count( $result ) > 0 ) {
                return $result[0];
            }
            return false;
        }
        return false;
    }

    //generate random id
    public function generate_id( $max ) {
        $rand = '';
        $rand_count = rand(0, $max);
        for( $i = 0; $i < $rand_count; $i++ ) {
            $r = rand(0,9);
            $rand .= $r;
        }
        return $rand;
    }
}
