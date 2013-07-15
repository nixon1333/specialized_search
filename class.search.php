<?php

/**
 * Different Search using AND, OR
 * Note: Requires PHP 5 or later
 * @package Search
 * @author Ashraful Islam Nixon <nixon613@gmail.com>
 * @copyright (c) 2013, Ashraful Islam Nixon
 */

/**
 * Handle all Searching methods of Search
 * @package Search
 */

class Search{
   
 /////////////////////////////////////////////////
 // PROPERTIES, PRIVATE
 /////////////////////////////////////////////////
    /**
     * contains the search tokens
     * @var array
     * @access private
     */
    private $tokens;


 /////////////////////////////////////////////////
 // METHODS, VARIABLES
 /////////////////////////////////////////////////  
    /**
     * Constructor
     * @param string $searchString Given Search string
     */
    public function __construct($searchString)
    {
        $this->tokens = explode(" ", $searchString); //break the given string into tokens
    }
    
    /**
     * Create searching logic
     * @access private
     * @return string
     */
    public function searchLogic()
    {
        $queryString = ""; // query string holder
        $arrayCount = 0; // array count for placing values in query string
        $logicFlag = 0; // flag for detecting wheather the method should jenerate the logical query or not
        foreach ($this->tokens as $value) // check the array for special tokens OR,AND
        {
            if($arrayCount == 0)
            {
                // creating the OR query sting for initial token 
                // we are assuming there will be no SPECIAL token at the beginning
                $queryString = $queryString . " search_info_content LIKE '%$value%'"; 
            }
            elseif ($arrayCount > 0 && ($logicFlag == 0)) // checking from 2nd token and the logic flag is off 
            {
                if($value == "AND") // if SPECIAL token AND found
                {       
                    $logicFlag = 1; // set the flag true because next token will be joined with AND logic
                }
                elseif($value == "OR") // if SPECIAL token OR found
                {    
                    $logicFlag = 2; // set the flag true because next token will be joined with OR logic
                }
                else
                {
                    // if no special token
                    $queryString = $queryString . " OR" . " search_info_content LIKE '%$value%'"; // generate normal query string
                }
            }
            elseif ($arrayCount > 0 && $logicFlag > 0) // checking from 2nd token and the logic flag is on
            {
                if($logicFlag == 1)
                {
                    $queryString = $queryString . " AND search_info_content LIKE '%$value%'"; // preperaing to implement special logic query string
                }
                else if($logicFlag == 2)
                {
                    $queryString = $queryString . " OR search_info_content LIKE '%$value%'"; // preperaing to implement special logic query string
                }
                
                $logicFlag = 0; // free the flag
            }
            
            $arrayCount++;
        }
        
        return $queryString;
    }
}

?>