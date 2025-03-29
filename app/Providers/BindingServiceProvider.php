<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

class BindingServiceProvider extends ServiceProvider
{
    protected $interfaceSuffix = 'Interface';
    protected $searchPaths = [
        'Application/Services',
        'Infrastructure/Repositories',
        'Domain/Services'
    ];

    public function register(): void
    {
        $this->bindInterfaces();
    }

    protected function bindInterfaces(): void
    {
        $filesystem = new Filesystem();
        
        foreach ($this->searchPaths as $path) {
            $fullPath = app_path($path);
            if (!$filesystem->isDirectory($fullPath)) {
                continue;
            }

            // Get all interface files
            $interfaces = $filesystem->allFiles($fullPath . '/Interfaces');
            
            foreach ($interfaces as $interface) {
                $this->bindInterface($interface);
            }
        }
    }

    protected function bindInterface(SplFileInfo $interface): void
    {
        // Get the interface class name
        $interfaceClass = $this->getClassFromFile($interface);
        if (!$interfaceClass || !interface_exists($interfaceClass)) {
            return;
        }

        // Generate the implementation class name
        $implementationClass = $this->getImplementationClass($interfaceClass);
        if (!class_exists($implementationClass)) {
            return;
        }

        // Bind the interface to the implementation
        $this->app->bind($interfaceClass, $implementationClass);
    }

    protected function getClassFromFile(SplFileInfo $file): ?string
    {
        $namespace = $this->getNamespaceFromFile($file);
        $className = $file->getBasename('.php');
        return $namespace . '\\' . $className;
    }

    protected function getNamespaceFromFile(SplFileInfo $file): string
    {
        $path = $file->getPathname();
        $appPath = app_path();
        
        // Remove base path and file name
        $namespacePath = str_replace([$appPath, $file->getBasename()], '', $path);
        // Convert directory separators to namespace separators
        $namespace = str_replace('/', '\\', trim($namespacePath, '/'));
        
        return 'App\\' . $namespace;
    }

    protected function getImplementationClass(string $interfaceClass): string
    {
        // Remove 'Interface' suffix and 'Interfaces' from namespace
        return str_replace(
            ['\\Interfaces\\', $this->interfaceSuffix],
            ['\\', ''],
            $interfaceClass
        );
    }
} 