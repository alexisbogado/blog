{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

@add('base')

@content('contents')
    <div class="col-sm-12">
        <a href="{{ route('users')->path() }}" class="btn btn-primary">< Volver al listado</a>
    </div>

    <div class="col-sm-12 mt-3">
        <?php if (isset($error)): ?>
            <h1>¡El usuario que está buscando no existe!</h1>
        <?php else: ?>
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h1>Perfil de {{ $user->fullName() }}</h1>

                        <hr>
                        
                        <img src="{{ $user->avatar }}" alt="{{ $user->fullName() }}" title="{{ $user->fullName() }}" /><br />
                        <b>ID:</b><br />
                        {{ $user->id }}<br />
                        
                        <b>Nombre:</b><br />
                        {{ $user->firstName }}<br />
                        
                        <b>Apellidos:</b><br />
                        {{ $user->lastName }}<br />
                        
                        <b>Género:</b><br />
                        {{ ($user->gender == 'male' ? 'Masculino' : 'Femenino') }}<br />
                        
                        <b>Fecha de nacimiento:</b><br />
                        {{ date('d-m-Y', strtotime($user->dob)) }}<br />
                        
                        <b>Email:</b><br />
                        {{ $user->email }}<br />
                        
                        <b>Teléfono:</b><br />
                        {{ $user->phone }}<br />
                        
                        <b>Sitio web:</b><br />
                        <a href="{{ $user->website }}" title="Sitio web de {{ $user->fullName() }}">{{ $user->website }}</a><br />
                        
                        <b>Dirección:</b><br />
                        {{ $user->address }}<br />
                        
                        <b>Estado:</b><br />
                        {{ ($user->status == 'inactive' ? 'Desconectado' : 'Conectado') }}<br />
                    </div>

                    <div class="col-sm-7">
                        <h1>Posts creados ({{ count($user->posts) }})</h1>
                        Mostrando resultados de la página {{ $current_page }}
                        
                        <hr>

                        <div class="row">
                            <?php foreach ($user->posts as $post): ?>
                                <div class="col-sm-12 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('post')->path() }}?id=<?= $post->id ?>" title="<?= $post->title ?>"><?= str_limit($post->title, 100) ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <div class="col-sm-12 mt-3">
                                <nav aria-label="Users pagination">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item {{ (($previous_page <= 0) ? 'disabled' : '') }}">
                                            <a class="page-link" href="{{ route('user')->path() }}?id={{ $user->id }}&page={{ $previous_page }}">< Anterior</a>
                                        </li>
                                        
                                        <li class="page-item {{ (($next_page >= $page_count) ? 'disabled' : '') }}">
                                            <a class="page-link" href="{{ route('user')->path() }}?id={{ $user->id }}&page={{ $next_page }}">Siguiente ></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
@endcontent
