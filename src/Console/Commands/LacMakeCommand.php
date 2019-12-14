<?php

namespace Kdion4891\Lac\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class LacMakeCommand extends Command
{
    protected $signature = 'lac:make {model}';
    protected $description = 'Generate new Laravel AJAX CRUD model scaffolding.';
    private $files;
    private $replaces;
    private $stubs_path = __DIR__ . '/../../../resources/stubs';

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $model_title = trim(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', ' $0', $this->argument('model')));
        $model_titles = Str::plural($model_title);

        $this->replaces = [
            'DummyModelClass' => $this->argument('model'),
            'DummyControllerClass' => $this->argument('model') . 'Controller',
            'DummyMigrationClass' => 'Create' . str_replace(' ', '', $model_titles) . 'Table',
            'DummyTable' => Str::snake($model_titles),
            'DummyModelNav' => $model_titles,
        ];

        $this->createController();
        $this->createModel();
        $this->createMigration();
        $this->insertNavItem();
        $this->insertRoutes();
    }

    private function createController()
    {
        $file = 'Http/Controllers/' . $this->replaces['DummyControllerClass'] . '.php';
        $path = app_path($file);

        if ($this->files->exists(($path))) {
            $this->warn('Controller already exists: <info>' . $file . '</info>');
            return;
        }

        $stub = $this->replace($this->files->get($this->stubs_path . '/controller.stub'));
        $this->files->put($path, $stub);
        $this->line('Controller created: <info>' . $file . '</info>');
    }

    private function createModel()
    {
        $file = $this->replaces['DummyModelClass'] . '.php';
        $path = app_path($file);

        if ($this->files->exists(($path))) {
            $this->warn('Model already exists: <info>' . $file . '</info>');
            return;
        }

        $stub = $this->replace($this->files->get($this->stubs_path . '/model.stub'));
        $this->files->put($path, $stub);
        $this->line('Model created: <info>' . $file . '</info>');
    }

    private function createMigration()
    {
        $name = '_create_' . $this->replaces['DummyTable'] . '_table.php';
        $existing = glob(database_path('migrations/*' . $name));

        if (!empty($existing)) {
            $this->warn('Migration already exists: <info>*' . $name . '</info>');
            return;
        }

        $file = date('Y_m_d_His') . $name;
        $stub = $this->replace($this->files->get($this->stubs_path . '/migration.stub'));
        $this->files->put(database_path('migrations/' . $file), $stub);
        $this->line('Migration created: <info>' . $file . '</info>');
    }

    private function insertNavItem()
    {
        $file = 'views/vendor/lac/layouts/nav.blade.php';
        $path = resource_path($file);

        if (!$this->files->exists($path)) {
            $this->warn('Nav file missing: <info>' . $file . '</info>');
            return;
        }

        $content = $this->files->get($path);
        $hook = '<!-- nav-item hook -->';

        if (strpos($content, $hook) === false) {
            $this->warn('Nav hook missing in: <info>' . $file . '</info>');
            $this->warn('Nav hook code required: <info>' . $hook . '</info>');
            return;
        }

        $stub = $this->replace($this->files->get($this->stubs_path . '/nav-item.stub'));

        if (strpos($content, $stub) !== false) {
            $this->warn('Nav item already exists in: <info>' . $file . '</info>');
            return;
        }

        $this->files->put($path, str_replace($hook, $hook . PHP_EOL . $stub, $content));
        $this->line('Nav item inserted in: <info>' . $file . '</info>');
    }

    private function insertRoutes()
    {
        $file = 'routes/web.php';
        $path = base_path($file);
        $content = $this->files->get($path);
        $stub = $this->replace($this->files->get($this->stubs_path . '/routes.stub'));

        if (strpos($content, $stub) !== false) {
            $this->warn('Routes already exist in: <info>' . $file . '</info>');
            return;
        }

        $this->files->append($path, PHP_EOL . $stub);
        $this->line('Routes inserted in: <info>' . $file . '</info>');
    }

    public function replace($content)
    {
        foreach ($this->replaces as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }
}
