{-- @author Alexis Bogado --}
{-- @package blog --}
{-- @version 1.0.0 --}

@add('base')

@content('contents')
    <?php if (isset($success)): ?>
        <div class="col-sm-12 mb-3">
            <div class="alert alert-success">
                ¡El usuario se ha registrado correctamente!<br />
                <a href="{{ route('user')->path() }}?id=<?= $user->id ?>">Visitar perfil</a>
            </div>
        </div>
    <?php else: ?>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1>Nuevo usuario</h1>
                    
                    <hr>
                    
                    <form action="{{ route('registration')->path() }}" method="POST" class="form-group row">
                        <div class="col-sm-12">
                            <label for="first_name">Nombre</label>
                            <input name="first_name" id="first_name" type="text" class="form-control {{ (isset($errors['first_name']) ? 'is-invalid' : '') }}" placeholder="Escribe tu nombre aquí" value="{{ old('first_name') }}" />

                            <?php if (isset($errors['first_name'])): ?>
                                <span class="invalid-feedback">
                                    {{ $errors['first_name'] }}
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label for="last_name">Apellidos</label>
                            <input name="last_name" id="last_name" type="text" class="form-control {{ (isset($errors['last_name']) ? 'is-invalid' : '') }}" placeholder="Escribe tus apellidos aquí" value="{{ old('last_name') }}" />
                            
                            <?php if (isset($errors['last_name'])): ?>
                                <span class="invalid-feedback">
                                    {{ $errors['last_name'] }}
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label for="email">Email</label>
                            <input name="email" id="email" type="email" class="form-control {{ (isset($errors['email']) ? 'is-invalid' : '') }}" placeholder="Escribe tu email aquí" value="{{ old('email') }}" />
                            
                            <?php if (isset($errors['email'])): ?>
                                <span class="invalid-feedback">
                                    {{ $errors['email'] }}
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label for="gender">Género</label>
                            <select name="gender" id="gender" class="form-control {{ (isset($errors['gender']) ? 'is-invalid' : '') }}">
                                <option>Selecciona un género...</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculino</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            
                            <?php if (isset($errors['gender'])): ?>
                                <span class="invalid-feedback">
                                    {{ $errors['gender'] }}
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-sm-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Crear usuario ></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
@endcontent
