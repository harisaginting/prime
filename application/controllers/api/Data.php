<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
use \Firebase\JWT\JWT;
class Data extends REST_Controller {
    
    function get_get() {echo 'success';
    }
  
}