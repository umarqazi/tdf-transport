<?php  namespace LaravelAcl\Authentication\Controllers;

use View;

class DashboardController extends Controller{

    public function base()
    {
    	
        return View::make('admin.dashboard.default');
    }
} 