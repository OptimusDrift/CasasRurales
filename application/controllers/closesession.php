<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Closesession extends CI_Controller
{
    public function index()
    {
        session_start();
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        redirect('Welcome');
    }
}
