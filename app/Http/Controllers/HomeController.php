<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Services\CPanel;

class HomeController extends Controller
{
    public function index() {

        $cPanel = new cPanel("replace_with_cpanel_id", "replace_with_cpanel_password", "replace_with_server_ip_address");
        $subdomains = $cPanel->get_subdomains();

        // dump($subdomains);

        return view('welcome', compact('subdomains'));
    }

    public function add_subdomain( Request $request ) {
        $name = $request->validate([
           'name' => ['required', 'alphanumeric'],
       ]);

        $cPanel = new cPanel("replace_with_cpanel_id", "replace_with_cpanel_password", "replace_with_server_ip_address");
        $result = $cPanel->add_subdomain($name);
    }
}
