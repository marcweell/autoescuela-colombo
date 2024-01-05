@extends('admin.templates.auth')
@section('content')

<div class="logo">
    <img height="45px" src="{{ url("public/essential/img/logo.png") }}" alt="">
  </div>
  <div class="login-box">
    <form class="login-form form_" action="{{ route('web.admin.account.auth.login') }}">
      <h3 class="login-head"><i class="bi bi-person me-2"></i>INICIAR SESIÓN</h3>
      <div class="mb-3">
        <label class="form-label">USUARIO/EMAIL</label>
        <input class="form-control" name="user" type="text" placeholder="" autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label">CONTRASEÑA</label>
        <input class="form-control" type="password" name="password" placeholder="">
      </div>
      <div class="mb-3">
        <div class="utility">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox"><span class="label-text">Mantener sesión</span>
            </label>
          </div>
          <p class="semibold-text mb-2"><a href="{{ route("web.admin.account.forgot.index") }}" data-bs-toggle="flip">Has olvidado tu contraseña ?</a></p>
        </div>
      </div>
      <div class="mb-3 btn-container d-grid">
        <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>INICIAR SESIÓN</button>
      </div>
    </form>
    <form class="forget-form form_" action="{{ route("web.admin.account.forgot.auth") }}">
      <h3 class="login-head"><i class="bi bi-person-lock me-2"></i>Has olvidado tu contraseña ?</h3>
      <div class="mb-3">
        <label class="form-label">EMAIL</label>
        <input class="form-control" type="text" name="email" placeholder="">
      </div>
      <div class="mb-3 btn-container d-grid">
        <button class="btn btn-primary btn-block"><i class="bi bi-unlock me-2 fs-5"></i>Mandar</button>
      </div>
      <div class="mb-3 mt-3">
        <p class="semibold-text mb-0"><a href="#" data-bs-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Volver a iniciar sesión</a></p>
      </div>
    </form>
  </div>
@endsection
