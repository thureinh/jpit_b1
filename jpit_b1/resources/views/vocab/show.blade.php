@extends('template')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/customs/deleteform.css') }}">
@endsection

@section('content')

	<main id="maincontent">

		<section>

			<div class="container">
				<div class="row">
					@include('part.teachermenu')

					<div class="col-lg-9 sub-menu-content">
						
						<h3 class="float-left d-inline-block mt-2 mb-4">
							Topic - {{ $vocab->topic }} 
							<sup><a href="#" title="Edit Topic" class="btn btn-link text-info"><i class="far fa-edit fa-sm"></i></a></sup>
						</h3>
						<div class="float-right mt-2">
							<a href="{{ route('vocab.index') }}" class="btn btn-white-cardbutton"><i class="fas fa-angle-left"></i> back</a>
						</div>
						<div class="clearfix"></div>

						<!-- Adding new vocabularies -->
						<div class="shadow px-4 py-3 mb-5">
							<h5 class="mb-4 py-2">Add New Word</h5>
							<form class="edited-form" method="POST" action="{{ route('vocabdetail.store') }}">
      					@csrf
      					<input type="hidden" name="vocabid" value="{{ $vocab->id }}">
								<div class="row">
									<div class="col-lg-5">
										<div class="group">
											<input  id="word" type="text" name="word" required autocomplete="off" autofocus>
						          <span class="highlight"></span>
						          <span class="bar"></span>
						          @error('word')
		                    <span class="error-text">{{ $message }}</span>
		                  @enderror
						          <label>Word</label>
						        </div>
									</div>
									<div class="col-lg-5">
										<div class="group">
											<input  id="meaning" type="text" name="meaning" required autocomplete="off">
						          <span class="highlight"></span>
						          <span class="bar"></span>
						          @error('meaning')
		                    <span class="error-text">{{ $message }}</span>
		                  @enderror
						          <label>Meaning</label>
						        </div>
									</div>
									<div class="col-lg-2">
										<button type="submit" class="btn btn-add w-100">Add</button>
									</div>
								</div>
							</form>
						</div>

						<!-- Vocabdetail list -->
						<div class="table-responsive shadow p-3 mt-3">
						<h5>All Vocabulary List of {{$vocab->topic}}</h5>
							<table id="vocablist" class="display table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Word</th>
										<th>Meaning</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 0 @endphp
									@foreach($vocabdetails as $vocabdetail)
									@php $i++ @endphp 
										<tr id="tr-{{$vocabdetail->id}}">
											<td>{{$i}}.</td>
											<td>{{$vocabdetail->word}}</td>
											<td>{{$vocabdetail->meaning}}</td>
											<td>
												<a href="#" class="btn btn-outline-info btn-sm"><i class="far fa-edit"></i> Edit</a>

					                			<a href="#deleteModal" data-toggle="modal" name="btndelete" class="btn btn-outline-danger btn-sm delete-bttn"><i class="far fa-trash-alt"></i> Remove</a>

											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div> <!-- table responsive end -->

					</div>
				</div> <!-- row -->
			</div>	<!-- container end -->

		</section>

	</main>

@endsection

@section('modal')
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>			
				<h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete this record? This process cannot be undone.</p>
			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{asset('assets/customs/asynctable.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    var dt = $('#vocablist').DataTable({
		    	responsive: true
		    });
		    let asynctable = new AsyncTable(dt, "{{csrf_token()}}");
		    $('#vocablist tbody').on('click', 'a.delete-bttn', event => {
				let tr = $(event.target).closest('tr');
				let id = tr.attr('id');
				asynctable.targetRow(id);
			});
			$('#deleteModal button.btn-danger').on('click', event => {
				asynctable.deleteURL = "{{url('vocabdetail')}}";
				asynctable.delete();
			});
		});
	</script>
@endsection