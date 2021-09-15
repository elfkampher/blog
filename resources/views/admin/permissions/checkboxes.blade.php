@foreach($permissions as $id => $name)
	
		<div class="checkbox">			
				<input name="permissions[]" type="checkbox" value="{{ $name }}" 
				{{ $user->permissions->contains($id) ? 'checked':'' }}
				>
				{{ $name }}
			
		</div>
	
@endforeach