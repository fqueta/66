@extends('layout.login')

@section('content')
  <div class="ls-login-box">
    <h1 class="ls-login-logo">
      Prefeitura Municipal de Presidente Olegário
    </h1>
    {!!Form::open([
      'class' => 'ls-form ls-login-form',
      'role' => 'form',
      'action' => 'Auth\AuthController@postLogin'
    ])!!}
      <fieldset>
        <label class="ls-label">
          <b class="ls-label-text ls-hidden-accessible">Usuário</b>
          {!!Form::text('email', '', [
            'label' => false,
            'autofocus' => '',
            'required' => '',
            'placeholder' => 'Usuário',
            'class' => 'ls-login-bg-user ls-field-lg'
          ])!!}
        </label>

        <label class="ls-label">
          <b class="ls-label-text ls-hidden-accessible">Senha</b>
          <div class="ls-prefix-group">
            {!!Form::password('password', [
              'id' => 'password_field',
              'label' => false,
              'required' => '',
              'placeholder' => 'Senha',
              'class' => 'ls-login-bg-password ls-field-lg'
            ])!!}
            <a href="#" data-target="#password_field" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" class="ls-label-text-prefix ls-toggle-pass ls-ico-eye"></a>
          </div>
        </label>

        <input type="submit" class="ls-btn-primary ls-btn-block ls-btn-lg" value="Entrar">

      </fieldset>
    {!!Form::close()!!}
  </div>
  <div style="width: 100%; max-width: 450px; margin: 30px auto 0 auto;">
    @include('elements.shared.flash_error')
  </div>
@stop
