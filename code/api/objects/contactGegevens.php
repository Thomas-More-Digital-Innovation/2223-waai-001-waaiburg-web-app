<?php
class ContactGegevens{
 
    // database connection and table name
    private $conn;
    private $table_name = "contactGegevens";
 
    // object properties
    public $contactGegevensId;
    public $straat;
    public $huisNr;
    public $woonplaats;
    public $postcode;
    public $telNummer;
    public $email;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all contactgegevens
    function read(){
          
        // select all query
        $query = 'SELECT
                    `contactGegevensId`, `straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`, `createdAt`
                FROM
                    ' . $this->table_name . '
                ORDER BY
                    contactGegevensId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single contactgegevens data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `contactGegevensId`, `straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`, `createdAt`
                FROM
                    ' . $this->table_name . '
                WHERE
                    contactGegevensId= "'.$this->contactGegevensId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create contactgegevens
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .'
                        (`straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`)
                  VALUES
                        ("'.$this->straat.'", "'.$this->huisNr.'", "'.$this->woonplaats.'", "'.$this->postcode.'", "'.$this->telNummer.'", "'.$this->email.'", 1 )';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->contactGegevensId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update contactgegevens 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    straat="'.$this->straat.'", huisNr="'.$this->huisNr.'", woonplaats="'.$this->woonplaats.'", postcode="'.$this->postcode.'", telNummer="'.$this->telNummer.'", email="'.$this->email.'"
                WHERE
                    contactGegevensId="'.$this->contactGegevensId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Contactgegevens inactief maken
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    isActief=false
                WHERE
                    contactGegevensId= "'.$this->contactGegevensId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete contactgegevens
    function hardDelete(){
        
        // query to insert record
        $query = 'DELETE FROM
                    ' . $this->table_name . '
                WHERE
                    contactGegevensId= "'.$this->contactGegevensId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}