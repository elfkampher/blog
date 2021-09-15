@extends('admin.layout')

@push('styles')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@section('header')
<div class="container-fluid">
	<div class="row mb-2">
	  
    <div class="col-sm-6">
	    <h1 class="m-0 text-dark">Listado de usuarios</h1>      
	  </div><!-- /.col -->

	  <div class="col-sm-6">
	    <ol class="breadcrumb float-sm-right">
	      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
	      <li class="breadcrumb-item active">Usuarios</li>
	    </ol>
	  </div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Listado de Usuarios</h3>
    <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-primary float-right">
      <i class="fa fa-plus"></i> Registrar Usuario
    </a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="posts-table" class="table table-bordered table-striped">
      <thead>
	      <tr>
	        <th>ID</th>
	        <th>Nombre</th>	        
	        <th>Email</th>
          <th>Roles</th>
	        <th>Acciones</th>
	      </tr>
      </thead>

      <tbody>
      	@foreach($users as $user)
      	<tr>
      		<td>{{ $user->id }}</td>
      		<td>{{ $user->name }}</td>
      		<td>{{ $user->email }}</td>
          <td>{{ $user->getRoleNames()->implode(', ') }}</td>
      		<td>
            <form class="formDelete" method="POST" action="{{ route('admin.users.destroy', $user->id) }}" id="eliminarUsuario">
              @csrf
              {{ method_field('delete')}}
              <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-default"><i class="fas fa-eye"></i></a>
        			<a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
        			<button class="btn btn-xs btn-danger eliminarPost">
                <i class="fas fa-times"></i>
              </button>
            </form>
      		</td>
      	</tr>
      	@endforeach
      </tbody>

      
    </table>
  </div>
  <!-- /.card-body -->
</div>

@stop

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {    
    $('#posts-table').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(document).on('click', ".eliminarPost", function(){
    event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
          title: "Estas seguro?",
          text: "Una vez borrada el usuario no podra recuperarse!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete)=>{
          if (willDelete) {
            $(".formDelete").submit();          // submitting the form when user press yes            
          } else {
            swal("Cancelado", "El usuario sigue registrado :)", "error");
          }
        });
  });
  
</script>


@endpush