<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About the Laravel Test - The Deliverables

Complete a small test in Laravel – to develop a basic mini CRM to manage companies and their employees.  The Test involves:

- Use hcps://adminlte.io/ as a framework for the applicaXon
- Basic Laravel Auth: ability to log in as administrator
- Use database seeds to create first user with email admin@admin.com and password “password”
- CRUD funcXonality (Create / Read / Update / Delete) for two menu items: Companies and Employees.
- Companies DB table consists of these fields: Name (required), email, logo (minimum -100p×-100px), website
- Employees DB table consists of these fields: First name (required), last name (required),Company (foreign key to Companies), email, phone
- Use database migraXons to create those schemas above
- Store companies’ logos in storage/app/public folder and make them accessible from public
- Use basic Laravel resource controllers with default methods – index, create, store etc.
- Use Laravel’s validaXon funcXon, using Request classes
- Use Laravel’s paginaXon for showing Companies/Employees list, -10 entries per page
- Use Laravel make:auth as default Bootstrap-based design theme, but remove ability to register

## The Format

Please commit all your work into a Git repository.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
