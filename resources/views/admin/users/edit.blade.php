@extends('admin.layout')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3>Datos Personales</h3>
				</div>
				<div class="card-body">
					@if($errors->any())
						<ul class="list-group">
							@foreach($errors->all() as $error)
								<li class="list-group-item list-group-item-danger">{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					<form method="POST" action="{{ route('admin.users.update', $user) }}">
						@method('PUT')
						@csrf

						<div class="form-group">
							<label>Nombre:</label>
							<input name="name" value="{{ old('name', $user->name) }}" class="form-control">
						</div>

						<div class="form-group">
							<label>Email:</label>
							<input name="email" value="{{ old('email', $user->email) }}" class="form-control">
						</div>

						<div class="form-group">
							<label for="password">Contraseña:</label>
							<input type="password" name="password" class="form-control" placeholder="Contraseña">
							<span class="help-block">Dejar en blanco para no cambiar la contraseña</span>
						</div>

						<div class="form-group">
							<label for="password_confirmation">Repite Contraseña:</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Repite Contraseña">
						</div>

						<button class="btn btn-primary btn-block">Actualizar Usuario</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-primary card-outline">
				<div>
					<div class="card-header">
						<h3>Roles</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
							@method('PUT')
							@csrf
							@include('admin.roles.checkboxes')
							<button class="btn btn-primary btn-block">Actualizar Roles</button>
						</form>
					</div>
				</div>
			</div>

			<div class="card card-primary card-outline">
				<div>
					<div class="card-header">
						<h3>Permisos</h3>
					</div>
					<div class="card-body">
						<form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
							@method('PUT')
							@csrf
							@include('admin.permissions.checkboxes')
							<button class="btn btn-primary btn-block">Actualizar Permisos</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection