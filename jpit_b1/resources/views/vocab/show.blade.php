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
								<sup><a href="#" title="Edit Topic" class="btn btn-link text-info" data-toggle="modal" data-target="#edit-topic-modal"><i class="far fa-edit fa-sm"></i></a></sup>
						</h3>
						<div class="float-right mt-2">
							<a href="{{ route('vocab.index') }}" class="btn btn-white-cardbutton">
								<i class="fas fa-angle-left pr-2"></i> Back
							</a>
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
												<a href="#" class="btn btn-outline-info btn-sm edit-bttn" data-toggle="modal"><i class="far fa-edit"></i> Edit</a>

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
<!-- Edit Modal -->
<div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="updateForm">
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Vocab</label>
		    <select class="form-control" name="topic" id="exampleFormControlSelect1">
		    	@foreach($topics as $topic)
		    		<option value="{{ $topic->id }}">{{$topic->topic}}</option>
		    	@endforeach
		    </select>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="input001">Word</label>
		      <input type="text" name="word" class="form-control" id="input001">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="input002">Meaning</label>
		      <input type="text" name="meaning" class="form-control" id="input002">
		    </div>
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-dismiss="modal">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Topic Modal -->
<div class="modal fade" id="edit-topic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	      
	   	  <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      		<form id="edit-topic-form" method="POST" action="{{ route('vocab.update', ['vocab' => $vocab->id]) }}">
	      			<div class="form-group">
	      				@csrf
		   	  			@method('PUT')
						<label for="input0234" class="h5 text-center mx-auto">Vocab Topic</label>
			        	<input type="text" id="input0234" class="form-control" name="topic" value="{{$vocab->topic}}">
			        </div>
		       	</form>
	      
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" onClick="document.getElementById('edit-topic-form').submit()" class="btn btn-primary">Save changes</button>
	      </div>
    </div>
  </div>
</div>

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
		    let asynctable = new AsyncTable(dt, "{{csrf_token()}}", "{{url('vocabdetail')}}");
		    $('#vocablist tbody').on('click', 'a.delete-bttn', event => {
				let tr = $(event.target).closest('tr');
				asynctable.targetRow = tr;
			});
			$('#deleteModal button.btn-danger').on('click', event => {
				asynctable.deleteRow();
			});

			$('#vocablist tbody').on('click', 'a.edit-bttn', event => {
				let tr = $(event.target).closest('tr');
				let modal_func = (data) => {
					$('#editModal').find('input[name="word"]').val(data.word);
					$('#editModal').find('input[name="meaning"]').val(data.meaning);
					$('#editModal').modal('show');
				}
				asynctable.targetRow = tr;
				asynctable.editRow(modal_func);
			});
			$('#editModal').on('click', ':submit', event => {
				event.preventDefault();
				asynctable.updateRow($('#updateForm'));
			});
		});
	</script>
@endsection