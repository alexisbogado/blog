{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

@add('base')

@content('contents')
    <div class="col-sm-12">
        <h1>Listado de posts</h1>
        Mostrando resultados de la página {{ $current_page }}
    </div>

    <?php foreach ($posts as $post): ?>
        <div class="col-sm-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4><?= str_limit($post->title, 35) ?></h4>
                    <hr>
                    <?= str_limit($post->body, 200) ?>

                    <a href="{{ route('post')->path() }}?id=<?= $post->id ?>" class="btn btn-primary btn-block mt-4">
                        Continuar leyendo >
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="col-sm-12 mt-3">
        <nav aria-label="Posts pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ (($previous_page <= 0) ? 'disabled' : '') }}">
                    <a class="page-link" href="{{ route('posts')->path() }}?page={{ $previous_page }}">< Anterior</a>
                </li>
                
                <li class="page-item {{ (($next_page >= $page_count) ? 'disabled' : '') }}">
                    <a class="page-link" href="{{ route('posts')->path() }}?page={{ $next_page }}">Siguiente ></a>
                </li>
            </ul>
        </nav>
    </div>
@endcontent
