<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // for PHP8.3 auto discover command not working
        \Nwidart\Modules\Commands\CommandMakeCommand::class,
        \Nwidart\Modules\Commands\ControllerMakeCommand::class,
        \Nwidart\Modules\Commands\DisableCommand::class,
        \Nwidart\Modules\Commands\DumpCommand::class,
        \Nwidart\Modules\Commands\EnableCommand::class,
        \Nwidart\Modules\Commands\EventMakeCommand::class,
        \Nwidart\Modules\Commands\JobMakeCommand::class,
        \Nwidart\Modules\Commands\ListenerMakeCommand::class,
        \Nwidart\Modules\Commands\MailMakeCommand::class,
        \Nwidart\Modules\Commands\MiddlewareMakeCommand::class,
        \Nwidart\Modules\Commands\ModuleMakeCommand::class,
        \Nwidart\Modules\Commands\NotificationMakeCommand::class,
        \Nwidart\Modules\Commands\ProviderMakeCommand::class,
        \Nwidart\Modules\Commands\RouteProviderMakeCommand::class,
        \Nwidart\Modules\Commands\InstallCommand::class,
        \Nwidart\Modules\Commands\ListCommand::class,
        \Nwidart\Modules\Commands\ModuleDeleteCommand::class,
        \Nwidart\Modules\Commands\MigrateCommand::class,
        \Nwidart\Modules\Commands\MigrateRefreshCommand::class,
        \Nwidart\Modules\Commands\MigrateResetCommand::class,
        \Nwidart\Modules\Commands\MigrateRollbackCommand::class,
        \Nwidart\Modules\Commands\MigrateStatusCommand::class,
        \Nwidart\Modules\Commands\MigrationMakeCommand::class,
        \Nwidart\Modules\Commands\ModelMakeCommand::class,
        \Nwidart\Modules\Commands\PolicyMakeCommand::class,
        \Nwidart\Modules\Commands\RequestMakeCommand::class,
        \Nwidart\Modules\Commands\ResourceMakeCommand::class,
        \Nwidart\Modules\Commands\SeedCommand::class,
        \Nwidart\Modules\Commands\SeedMakeCommand::class,
        \Nwidart\Modules\Commands\TestMakeCommand::class,
        \Nwidart\Modules\Commands\UnUseCommand::class,
        \Nwidart\Modules\Commands\UpdateCommand::class,
        \Nwidart\Modules\Commands\UseCommand::class,
    
        // Custom commands
        \App\Console\Commands\CheckShippingStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Check shipping status every hour and auto-complete delivered orders
        $schedule->command('shipping:check-status')
                 ->hourly()
                 ->withoutOverlapping()
                 ->runInBackground()
                 ->onSuccess(function () {
                     Log::info('Shipping status check completed successfully');
                 })
                 ->onFailure(function () {
                     Log::error('Shipping status check failed');
                 });

        // Refresh Instagram feed cache hourly
        $schedule->call(function () {
            app(\App\Services\InstagramService::class)->refreshPosts();
            Log::info('Instagram feed cache refreshed');
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
