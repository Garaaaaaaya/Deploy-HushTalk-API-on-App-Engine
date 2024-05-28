<?php

ini_set('allow_url_fopen', 1);

switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {

    case '/':
    case '/index':
    case '/index.php':
    case '/index.php/':
        require 'index.php';
        break;    

    case '/get_mails':
    case '/get_mails.php':
    case '/get_mails.php/':
        require 'get_mails.php';
        break;

    case '/delete_mails':
    case '/delete_mails.php':
    case '/delete_mails.php/':
        require 'delete_mails.php';
        break;

    case '/post_mails':
    case '/post_mails.php':
    case '/post_mails.php/':
        require 'post_mails.php';
        break;

    case '/put_mails':
    case '/put_mails.php':
    case '/put_mails.php/.':
        require 'put_mails.php';
        break;

    case '/auth':
    case '/auth.php':
    case '/auth.php/.':
        require 'auth.php';
        break;

    case '/handler':
    case '/handler.php':
    case '/handler.php/.':
        require 'handler.php';
        break;

    case '/tokens':
    case '/tokens.php':
    case '/tokens.php/':
        require 'tokens.php';
        break;

    default:
        http_response_code(404);
        echo @parse_url($_SERVER['REQUEST_URI'])['path'];
        exit('Not Found');
}
?>