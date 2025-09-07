<?php
namespace App\Providers;

use App\Contracts\EmployeeRepositoryInterface;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ExportServiceInterface;
use App\Contracts\LoggingServiceInterface;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;
use App\Services\ExportService;
use App\Services\LoggingService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);

        // Service bindings
        $this->app->bind(EmployeeServiceInterface::class, EmployeeService::class);
        $this->app->bind(ExportServiceInterface::class, ExportService::class);
        $this->app->bind(LoggingServiceInterface::class, LoggingService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
