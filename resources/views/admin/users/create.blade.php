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
					<form method="POST" action="{{ route('admin.users.store') }}">						
						@csrf

						<div class="form-group">
							<label>Nombre:</label>
							<input name="name" value="{{ old('name') }}" class="form-control">
						</div>

						<div class="form-group">
							<label>Email:</label>
							<input name="email" value="{{ old('email') }}" class="form-control">
						</div>						

						<div class="row">
							<div class="form-group col-md-6">
								<label>Roles</label>
								@include('admin.roles.checkboxes')
							</div>

							<div class="form-group col-md-6">
								<label>Permisos</label>
								@include('admin.permissions.checkboxes')
							</div>
						</div>

						<span class="help-block">La contraseña será generada y enviada al nuevo usario via email</span>

						<button class="btn btn-primary btn-block">Crear Usuario</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection