<?php

namespace App\Http\Livewire;

use App\Services\CPanel;
use App\Services\Softaculous;
use Livewire\Component;

class DeleteSubdomain extends Component
{
    public $domain;

    public function delete_subdomain( $domain ) {
        $domain_script = Softaculous::get_domain_script($this->domain);

        Softaculous::uninstall_wordpress($domain_script);

        $cPanel = new cPanel("replace_with_cpanel_id", "replace_with_cpanel_password", "replace_with_server_ip_address");
        $result = $cPanel->delete_subdomain($this->domain);

        return redirect()->intended(route('home'));
    }
    public function render()
    {
        return view('livewire.delete-subdomain');
    }
}
