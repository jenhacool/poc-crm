<?php

namespace POC\CRM\REST;

abstract class POC_CRM_Abstract_Controller
{
    protected $namespace = 'poc-crm/v1';

    abstract public function register_routes();
}