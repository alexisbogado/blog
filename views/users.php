{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

@add('base')

@content('contents')
    <div class="col-sm-12">
        <h1>Listado de usuarios</h1>
        Mostrando resultados de la página {{ $current_page }}
    </div>

    <?php foreach ($users as $user): ?>
        <div class="col-sm-3 mt-3">
            <div class="card">
                <img src="<?= $user->avatar ?>" class="card-img-top" alt="<?= $user->fullName() ?>">
                <div class="card-body">
                    <b><?= $user->fullName() ?></b>
                    
                    <a href="{{ route('user')->path() }}?id=<?= $user->id ?>" class="btn btn-primary btn-block mt-4">
                        Visitar perfil >
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="col-sm-12 mt-3">
        <nav aria-label="Users pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ (($previous_page <= 0) ? 'disabled' : '') }}">
                    <a class="page-link" href="{{ route('users')->path() }}?page={{ $previous_page }}">< Anterior</a>
                </li>
                
                <li class="page-item {{ (($next_page >= $page_count) ? 'disabled' : '') }}">
                    <a class="page-link" href="{{ route('users')->path() }}?page={{ $next_page }}">Siguiente ></a>
                </li>
            </ul>
        </nav>
    </div>
@endcontent
