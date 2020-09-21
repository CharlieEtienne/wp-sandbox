<?php

namespace App\Services;

class Softaculous
{
    public static function installed_scripts() {
        // The URL
        $url = 'https://replace_with_cpanel_id:replace_with_cpanel_password@replace_with_server_ip_address:2083/frontend/paper_lantern/softaculous/index.live.php?'.
            '&api=serialize'.
            '&act=installations';

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        if(!empty($post)){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        // Get response from the server.
        $resp = curl_exec($ch);

        // The response will hold a string as per the API response method. In this case its PHP Serialize
        $res = unserialize($resp);

        if(!empty($res['error'])){

            // Error
            return $res['error'];

        }else{
            return $res['installations'];
        }
    }

    public static function get_domain_script( $domain ) {
        $installed_scripts = collect(self::installed_scripts()[26] ?? []);
        return $installed_scripts->where('softdomain', $domain) ?? false;
    }

    public static function get_domain_script_data( $domain ){
        $domain_script = self::get_domain_script($domain)->first();
        if(empty($domain_script)){
            return false;
        }
        return $domain_script ?? false;
    }

    public static function get_domain_script_insid( $domain ){
        $domain_script = self::get_domain_script($domain);
        if(empty($domain_script)){
            return false;
        }
        return $domain_script->keys()->first() ?? false;
    }

    public static function install_wordpress( $subdomain ) {
        // The URL
        $url = 'https://replace_with_cpanel_id:replace_with_cpanel_password@replace_with_server_ip_address:2083/frontend/paper_lantern/softaculous/index.live.php?' .
            '&api=serialize' .
            '&act=software' .
            '&soft=26';

        $post = array(
            'softsubmit'     => '1',
            'softdomain'     => $subdomain, // Must be a valid Domain
            'softdirectory'  => '', // Keep empty to install in Web Root
            'softdb'         => 'wpdb' . rand(100, 999),
            'admin_username' => 'replace_with_wp_username',
            'admin_pass'     => 'replace_with_wp_password',
            'admin_email'    => 'replace_with_admin_email',
            'language'       => 'fr_FR',
            'site_name'      => 'Mon site',
            'site_desc'      => '',
            'dbprefix'       => 'wpformation_',
            'softproto'      => 'https://'
        );

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        if( !empty($post) ) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        // Get response from the server.
        $resp = curl_exec($ch);

        // The response will hold a string as per the API response method. In this case its PHP Serialize
        $res = unserialize($resp);

        // Done ?
        if( !empty($res[ 'done' ]) ) {
            return $res;
        }
        // Error
        else {
            return $res[ 'error' ];
        }
    }

    public static function uninstall_wordpress( $domain_script ) {
        // The URL
        $url = 'https://replace_with_cpanel_id:replace_with_cpanel_password@replace_with_server_ip_address:2083/frontend/paper_lantern/softaculous/index.live.php?' .
            '&api=serialize' .
            '&act=remove' .
            '&insid=' . $domain_script;

        $post = array(
            'removeins'      => '1',
            'remove_dir'     => '1', // Pass this if you want the directory to be removed
            'remove_datadir' => '1', // Pass this if you want the data directory to be removed
            'remove_db'      => '1', // Pass this if you want the database to be removed
            'remove_dbuser'  => '1' // Pass this if you want the database user to be removed
        );

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        if( !empty($post) ) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        // Get response from the server.
        $resp = curl_exec($ch);

        return $resp;
    }
}
