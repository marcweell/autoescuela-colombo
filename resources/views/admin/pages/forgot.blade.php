

@extends("admin.templates.auth")

@section('content')

<div class="logo">
    <img height="45px" src="{{ url("public/essential/img/logo.png") }}" alt="">
  </div>
  <div class="login-box">
    <form class="login-form form_" action="{{ route("web.admin.account.forgot.auth") }}">
      <h3 class="login-head"><i class="bi bi-person me-2"></i>Recuperar cuenta</h3>
      <div class="mb-3">
        <label class="form-label">EMAIL</label>
        <input class="form-control" name="user" type="text" placeholder="" autofocus>
      </div>
      <div class="mb-3 btn-container d-grid">
        <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>Mandar</button>
      </div>
    </form>
  </div>


@endsection
