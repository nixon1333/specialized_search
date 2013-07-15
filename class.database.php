<?php

/**
 * Different Search
 * Note: Requires PHP 5 or later
 * @package Search
 * @author Ashraful Islam Nixon <nixon613@gmail.com>
 * @copyright (c) 2013, Ashraful Islam Nixon
 */


/**
 * Handle all databse methods of Search
 * @package Search
 */

class DBHandle{
    
 /////////////////////////////////////////////////
 // PROPERTIES, PRIVATE
 /////////////////////////////////////////////////
    /**
     * contains an object which represents the connection to a MySQL Server.
     * @var object
     * @access private
     */
    private $dbCon;
    
    /**
     * contains the info about the db connection which is on or off
     * Defeault value is false
     * @var bool
     * @access private
     */
    private $dbNotification = FALSE;
    
    /**
     * contains the results from query
     * @var object
     * @access private
     */
    private $queryResult;




    /////////////////////////////////////////////////
 // METHODS, VARIABLES
 /////////////////////////////////////////////////
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dbCon = new mysqli("localhost","root","01913981541","search"); // stablish a coonection with MYSQL
        if ($this->dbCon->connect_error) // the connectin is ok or not.
        {
            $this->__destruct();
        }
        else
        {
            $this->dbNotification = TRUE;
        }
    }
    
    /**
     * Destructor
     */
    public function __destruct()
    {
        if($this->dbNotification) // if connection is on
        {
         $this->dbCon->close(); // close the db connection if connnection is open   
        }
    }
    
    /**
     * Search the tokens
     * @param string $tokenString a string contains of tokens with command
     * @return object
     */
    public function searchToken($tokenString)
    {
        //$tokenString = "search_info_content LIKE '%nixon%' OR search_info_content LIKE '%sara%'"; DEMO STRING
        // search the tokens using mysql query
        $this->queryResult = $this->dbCon->query("SELECT search_info_year FROM search_info WHERE $tokenString");
        
        return $this->queryResult;
    }
    
    /**
     * Grab the whole results
     * @return object
     */
    public function grabAllPost()
    {
        // grab all the posts
        $allPost = $this->dbCon->query("SELECT search_info_content, search_info_year FROM search_info");
        
        return $allPost;
    }
}

?>