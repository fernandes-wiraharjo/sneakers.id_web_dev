# Setup Scheduler and Queue Worker

- Unlike cron that runs every minutes, process manager can handle up to every second
- In this example we will use supervisor process manager (you can also use PM2 process manager if you have node.js running)
- Example below are for Ubuntu or Debian

## Installing supervisor
`sudo apt install supervisor`

`sudo nano /etc/supervisor/conf.d/laravel-worker.conf`

Fill the laravel-worker.conf with below:
```
[program:app-name-scheduler]
process_name=%(program_name)s_%(process_num)02d
directory=/path/to/project/
command=php artisan schedule:work
autostart=true
autorestart=true
user=root
numprocs=1
redirect_stderr=true
stdout_logfile=/dev/null

[program:app-name-queue]
process_name=%(program_name)s_%(process_num)02d
directory=/path/to/project/
command=php artisan queue:work database --sleep=3 --tries=3 --daemon -vvv
autostart=true
autorestart=true
user=root
numprocs=3
redirect_stderr=true
stdout_logfile=/dev/null
```

#### Make sure you only use 1 worker for scheduler

## Running Scheduler and Queue Worker
`supervisorctl reread`

`supervisorctl update`

`supervisorctl status` make sure there is no errors
