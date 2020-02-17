{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

@add('base')

@content('styles')
    <style>
        img {
            max-width: 50px;
            max-height: 50px;
            padding: 0 5px
        }
    </style>
@endcontent

@content('contents')
    <div class="col-sm-12">
        <a href="{{ route('posts')->path() }}" class="btn btn-primary">< Volver al listado</a>
    </div>

    <div class="col-sm-12 mt-3">
        <?php if (isset($error)): ?>
            <h1>¡El post que está buscando no existe!</h1>
        <?php else: ?>
            <div class="card card-body">
                <h1>{{ $post->title }}</h1>

                <?php if ($post->user): ?>
                    <span><img src="{{ $post->user->avatar }}" alt="{{ $post->user->fullName() }}" title="{{ $post->user->fullName() }}" /> Post creado por <a href="{{ route('user')->path() }}?id={{ $post->user->id }}">{{ $post->user->fullName() }}</a></span>
                <?php endif; ?>
                
                <hr>

                {{ $post->body }}
            </div>
        <?php endif; ?>
    </div>
@endcontent
