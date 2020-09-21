# WP Sandbox

Quickly create subdomains and install a fresh WordPress site in it.

Use CPanel and Softaculous APIs. (Needs CPanel and Softaculous installed)

Created with "T.A.L.L. stack" (Tailwind, Alpine, Livewire, Laravel)

Absolutely no warranty, support, or maintenance. Use it at your own risks.

Quality of code = 0/100

But it works! (for now)

## How to install

1. Search/Replace these strings with something appropriate:
    - `replace_with_cpanel_id` 
    - `replace_with_cpanel_password`
    - `replace_with_server_ip_address`
    - `replace_with_rootdomain`
    - `replace_with_sites_dir_path`
    - `replace_with_wp_username`
    - `replace_with_wp_password`
    - `replace_with_admin_email`

2. Install composer dependencies:

    ```
    composer install
    ```

3. Install npm dependencies:

    ```
    npm install
    ```

4. Migrate database
   
    ```
    php artisan migrate
    ```
   
5. Registering is deactivated, to reactivate do this:
    1. Uncomment lines from 12 to 17 in `resources/views/livewire/auth/login.blade.php`
    2. Uncomment lines 29 and 30 in `routes/web.php`
    
6. Register yourself and comment lines above again if you want
