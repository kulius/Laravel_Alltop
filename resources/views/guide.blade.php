@extends('layouts.master')

@section('content')
	<div class="accordion" id="accordionExample">
	    @foreach ($menu as $key => $value)

	    	<div class="card">
				<div class="card-header" id="head_{{ $key }}">
					<h5 class="mb-0">
						<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
		          			{{ $value['menu_name'] }}
		        		</button>
	        		</h5>
				</div>
				<div id="collapse_{{ $key }}" class="collapse" aria-labelledby="head_{{ $key }}" data-parent="#accordionExample">
	      			<div class="card-body">
	      				<div class='row'>
				  			@foreach ($value['menu_prog'] as $key2 => $value2)
					  			<div class='col-md-3 mb-4'>
					  				<input type="button" class="btn btn-lg btn-block btn-outline-dark" value="{{ $value2['menu_name'] }}"
					  			 		onclick="location.href='{{ route($value2['menu_number']) }}'">
								</div>
				  			@endforeach
			  			</div>
	      			</div>
	    		</div>
			</div>
	    @endforeach
    </div>
@endsection
