<?php

namespace App\Http\Livewire;

use App\Services\CPanel;
use App\Services\Softaculous;
use Livewire\Component;

class AddSubdomain extends Component
{
    /** @var string */
    public $name = '';

    public function render() {
        return view('livewire.add-subdomain');
    }

    public function add_subdomain() {
        $data = $this->validate([
            'name' => [ 'required', 'alpha_dash' ],
        ]);

        $cPanel = new cPanel("replace_with_cpanel_id", "replace_with_cpanel_password", "replace_with_server_ip_address");
        $result = $cPanel->add_subdomain($data['name']);

        $domain_name = $data['name'] . '.replace_with_rootdomain';

        $wpinstall_result = Softaculous::install_wordpress($domain_name);

        return redirect()->intended(route('home'));
    }
}
