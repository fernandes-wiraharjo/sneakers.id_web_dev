# installation

1. ``` composer install ```
2. ``` php artisan key:generate ```
3. SETUP your `.env`
4. ``` php artisan migrate --path=database/migrations/*/* ```
5. ``` npm install && npm ci && npm run dev ```

Updating `migrations`
``` php artisan migrate:fresh --seed```
``` php artisan migrate --path=database/migrations/* ```
``` php artisan migrate --path=database/migrations/*/* ```

# Using Library
* hexters/ladmin
* browner12/helpers
* laravel/jetstream
* laravel/sanctum
* laravel/tinker
* livewire/livewire
* nwidart/laravel-modules

#TechStack Laravel
* AlphineJS
* Livewire

# create new Feature
`php artisan module` for help 

`php artisan module:make [Feature Name]`

`php artisan make:datatables ../../Modules/[Feature Name]/Entities/[Feature Name]Datatables` for making datatables *dont forget change namespace*

this repository build with Services, Repositories, Helpers design pattern, you can take care of this architecture by following category module.
build in menu management system, log, login, user role permission or ACL, or etc by hexter/ladmin. you must not concern into this problem and skipped this right?.

*happy coding*

# naming branch
- `module_[feature name]` for new modules
- `bugfix_[bugfix name]_[issue number]` for bugfixing issue
- `hotfix_[hotfix name]_[issue number]` for hotfix issue
- `change_[change name]_[issue number]` for changing name
- `v0.0.0-alpha` for first release
- `v0.0.0-beta` for update after first release
- `v0.0.[number PR module]` for module release
- `v0.[number sequence].0` for bugfix, hotfix, change release
- `v[number sequence].0.0` for BIG CHANGE Release  


# Pull Request
``` 
always create PR after new module or any changes
format PR Name : [Programmer Name] - Changes name
use  fixed if fixing issue or any changes 
```
