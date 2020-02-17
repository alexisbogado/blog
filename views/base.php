{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

<!DOCTYPE html>
<html lang="{{ config('site.lang') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('site.name') }}: {{ $description }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    @get('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand">{{ config('site.name') }}</span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ ((route()->name == 'posts') ? 'active' : '') }}">
                    <a href="{{ route('posts')->path() }}" class="nav-link">Posts</a>
                </li>

                <li class="nav-item {{ ((route()->name == 'users') ? 'active' : '') }}">
                    <a href="{{ route('users')->path() }}" class="nav-link">Usuarios</a>
                </li>

                <li class="nav-item {{ ((route()->name == 'register') ? 'active' : '') }}">
                    <a href="{{ route('register')->path() }}" class="nav-link">Nuevo usuario</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row py-4">
            @get('contents')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
