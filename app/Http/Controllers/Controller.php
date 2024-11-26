<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Base controller class that all other controllers extend from.
 * 
 * This controller provides access to Laravel's core controller features
 * by extending the framework's base controller and including common traits.
 */
class Controller extends BaseController
{
    /**
     * Use Laravel's authorization and validation traits.
     * 
     * AuthorizesRequests: Provides methods for authorizing user actions
     * ValidatesRequests: Provides methods for validating incoming requests
     */
    use AuthorizesRequests, ValidatesRequests;
}
