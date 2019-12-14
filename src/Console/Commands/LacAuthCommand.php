<?php

namespace Kdion4891\Lac\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class LacAuthCommand extends Command
{
    protected $signature = 'lac:auth';
    protected $description = 'Implement Laravel AJAX CRUD auth scaffolding.';
    private $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $this->insertTraits();
        $this->insertAuthRoutes();
        $this->insertHomeRoute();
    }

    private function insertTraits()
    {
        $controller_traits = [
            'ConfirmPassword' => 'ConfirmsPasswords',
            'ForgotPassword' => 'SendsPasswordResetEmails',
            'Login' => 'AuthenticatesUsers',
            'Register' => 'RegistersUsers',
            'ResetPassword' => 'ResetsPasswords',
            'Verification' => 'VerifiesEmails',
        ];

        foreach ($controller_traits as $controller => $trait) {
            $file = 'Http/Controllers/Auth/' . $controller . 'Controller.php';
            $path = app_path($file);

            if (!$this->files->exists($path)) {
                $this->line('Controller file missing: <info>' . $file . '</info>');
                continue;
            }

            $content = $this->files->get($path);
            $replace = '\\Kdion4891\\Lac\\Traits\\Auth\\Lac' . $controller;

            if (strpos($content, $replace) !== false) {
                $this->warn('Trait already exists in: <info>' . $file . '</info>');
                continue;
            }

            $this->files->put($path, str_replace(' ' . $trait, ' ' . $replace, $content));
            $this->line('Trait replaced in: <info>' . $file . '</info>');
        }
    }

    private function insertAuthRoutes()
    {
        $file = 'routes/web.php';
        $path = base_path($file);
        $search = 'Auth::routes';
        $routes = "Auth::routes(['register' => false]);";

        if (strpos($this->files->get($path), $search) !== false) {
            $this->warn('Auth routes already exist in: <info>' . $file . '</info>');
            return;
        }

        $this->files->append($path, PHP_EOL . $routes . PHP_EOL);
        $this->line('Auth routes inserted in: <info>' . $file . '</info>');
    }

    private function insertHomeRoute()
    {
        $file = 'routes/web.php';
        $path = base_path($file);
        $content = $this->files->get($path);
        $search = "Route::get('/home', 'HomeController@index')->name('home');";
        $route = "Route::get('/home', '\Kdion4891\Lac\Http\Controllers\LacHomeController@index')->name('home');";

        if (strpos($content, $route) !== false) {
            $this->warn('Home route already exists in: <info>' . $file . '</info>');
            return;
        }

        if (strpos($content, $search) !== false) {
            $this->files->put($path, str_replace($search, $route, $content));
            $this->warn('Home route replaced in: <info>' . $file . '</info>');
            return;
        }

        $this->files->append($path, PHP_EOL . $route . PHP_EOL);
        $this->line('Home route inserted in: <info>' . $file . '</info>');
    }
}
