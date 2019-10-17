<?php


// Create Authorization class- parameters ($market)* 
// 1- Search in authorization table for authorization access_token.* 
// 2- If record exist and token_expiration is not expired, Get the token.* 
// 3- If record exist and token is expired run* request() and update the value.* 
// 4- If record doesn't exist run request()* and insert the value.
class Authorization {
    public $market;
    function _construct($market) {
        $this->market = $market;
    }

function get_access_token() {
    $result = db_query("SELECT 'access_token', 'token_expiration' FROM {authorization} WHERE market = ':market'", array(
        ':market' => $this->market,
    ))->fetchALL();
    return $result;
}

function add_access_token($token, $expiration) {
// $result = db_query("INSERT INTO {authorization} (access_token, token_expiration, market) VALUES (%s, %d)", $token , $expiration);
    $result = db_insert('authorization')
        ->fields(
            array(
                'access_token' => $token,
                'token_expiration' => $expiration,
                'market' => $this->market,
            ))
            ->execute();
    return $result;
}

function update_access_token($token, $expiration) {
    $query = db_update($token, $expiration)
        ->fields(
            array(
                'access_token' => $token,
                'token_expiration' => $expiration,
            ))
        ->condition('market', $this->market)
        ->execute();
    return $result;
}

function token_check() {
    $result = get_access_token($this->market);

    $access_token = $result->access_token;
    $token_expiration = $result->token_expiration;

    $isExpired = token_expiration - REQUEST_TIME; 

    if(!isset($access_token)){
        $token_callback = request();
        $token = $token_callback->access_token;
        $expiration = $token_callback->token_expiration; 
        $insert_result = add_access_token($token, $expiration);
                //add response catcher here

    }
    elseif($isExpired < 0){
        $token_callback = request();
        $token = $token_callback->access_token;
        $expiration = $token_callback->token_expiration; 
        $update_result = update_access_token($token, $expiration);

    }
    else {

    }
}




function request(){
    $api_call = curl GET METHOD url of token authorization
     username password 
    Request will have Header,
    
    return $api_object;
}

}


