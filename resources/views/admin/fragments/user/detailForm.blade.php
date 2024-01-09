<div class="card overflow-hidden">

    <div class="row">
        <div class="col-md-4">
            <div class="text-center p-3 overlay-box " style="background-image: url(images/big/img1.jpg);">
                <div class="profile-photo">
                    <img src="{{ tools()->photo($user->photo) }}" width="100" class="img-fluid rounded-circle" alt="">
                </div>
                <h3 class="mt-3 mb-1 text-white">{{ $user->name }}</h3>
            </div>

        </div>
        <div class="col-md-8">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Correo</span> <strong class="text-muted">{{ $user->email }}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Telefono</span> <strong class="text-muted">{{ "({$user->idd})" . $user->phone }}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Edad</span> <strong class="text-muted">{{ $user->age}}</strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Fecha de Registro</span> <strong class="text-muted">{{ tools()->date_convert($user->created_at) }}</strong></li>
            </ul>
        </div>
    </div>



</div>






