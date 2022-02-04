<h1 align="center">Simple Test</h1>



## Follow below steps to run the apps

- `composer install`
- `npm install`
- `cp .env.example .env` <br>
    and edit the env to match up with your database
- `php artisan key:generate`
- `php artisan migrate --seed` or you can import the database
- Try to login with this credential <br>

| Username | Password | Role |
| --- | --- | --- |
| john | password | senior-hrd |
| lee | password | hrd |

<br>

- `php artisan passport:install`
<br>
<br>

## API URL

| Module | Url | Method |
| --- | --- | --- |
| Login | `{{url}}/api/login` | GET |
| Candidate | --- | --- |
| List | `{{url}}/api/candidate` | GET |
| Add | `{{url}}/api/candidate` | POST |
| Update | `{{url}}/api/candidate/{candidate-id}` | PATCH |
| Delete | `{{url}}/api/candidate/{candidate-id}` | DELETE |

<br>

# Note
### Warning this is important
- You have to make a virtual host for this project because, because laravel passport is not work if you want to run with `php artisan serve`

<br>
<br>
<h2 align="center">Thank You</h2>