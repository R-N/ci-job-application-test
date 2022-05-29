<?php

function now(){
    return date("Y-m-d H:i:s");
}

function header_json(){
    header('Content-Type: application/json');
}

function respond_json($context, $response, $code=200){
    $context->output
        ->set_content_type('application/json')
        ->set_status_header($code)
        ->set_output(json_encode($response));
}

function respond_message($context, $message, $code=200){
    respond_json($context, array(
        "message"=>$message
    ), $code);
}

function respond_exception($context, $ex){
    $context->output
        ->set_status_header($ex->getCode())
        ->set_output($ex->getMessage());
}

function array_multi_key_exists($array, $keys){
    return (count(array_intersect_key(array_flip($keys), $array)) === count($keys));
}

function filter_array($array, $keys){
    return array_intersect_key($array, array_flip($keys));
}

function check_required_fields($data, $required){
    $missing = array();
    foreach($required as $key){
        if (!array_key_exists($key, $data))
            array_push($missing, $key);
    }
    if ($missing)
        throw new MyException(implode(", ", $missing) . " must be provided", 400);
}

?>