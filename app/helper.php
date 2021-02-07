<?php


function e($val){
    return htmlspecialchars($val);
}

function addGetParam($params){
    $result = '';
    $get = $_GET;

    foreach ($params as $key=>$param) {
        $get[$key] = $param;
    }
    foreach ($get as $k => $v) {

        if($k == 'path'){
            continue;
        }
        $result .= $k . '=' . $v . '&';
    }
    $result = '/?' . trim($result, '&');
    return $result;
}

function isAdm($user){
    return !empty($user) ? (boolean)$user['adm'] : false;
}