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
						<h3 class="float-left d-inline-block mt-2">Kanji</h3>
						<div class="float-right mt-2">
							<a class="btn btn-white-cardbutton" href="{{route('kanji.create')}}">
								<i class="fas fa-plus pr-2"></i> Add New
							</a>
						</div>
						<div class="clearfix"></div>

						<!-- practice -->
						<div class="my-4">
							<a href="#" class="btn btn-block btn-white-cardbutton rounded-0">
								<i class="fas fa-plus-circle pr-2"></i> Create Practice Question
							</a>
						</div>
						
						<!-- data table -->
						<div class="table-responsive shadow p-3 mt-3">
						<h5>All Kanji List</h5>
							<table id="kanjilist" class="display table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Kanji</th>
										<th>No of words</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 0 @endphp
									@foreach($kanjis as $kanji)
									@php $i++ @endphp 
									<tr id="tr-{{$kanji->id}}">
										<td>{{$i}}.</td>
										<td>{{$kanji->kanji}}</td>
										<td>{{$kanji->kanjiwords_count}}</td>
										<td>{{$kanji->created_at->toFormattedDateString()}}</td>
										<td>
											<a href="{{route('kanji.show', $kanji->id)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-external-link-alt"></i> View</a>

											<a href="#" class="btn btn-outline-primary btn-sm edit-bttn" data-toggle="modal"><i class="far fa-edit"></i> Edit</a>

				                			<a href="#deleteModal" data-toggle="modal" name="btndelete" class="btn btn-outline-danger btn-sm delete-bttn"><i class="far fa-trash-alt"></i> Remove</a>											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>

					</div>
				</div> <!-- row -->
			</div>	<!-- container end -->

		</section>

	</main>

@endsection

@section('modal')
	@include('modals.delete_confirm')

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
	      	  <input type="hidden" name="detail_update" value="true"/>
			  <div class="form-row">
			  		<div class="form-group col-md-2 offset-md-5">
			  			<label for="eInput1" class="h4">Kanji</label>
    					<input type="text" class="form-control" name="kanji" id="eInput1">
			  		</div>
				    <div class="form-group col-md-6">
				      <label for="input001">Konyomi</label>
				      <input type="text" name="konyomi" class="form-control" id="input001">
				    </div>
				    <div class="form-group col-md-6">
				   		<label for="input003">Onyomi</label>
				      	<input type="text" name="onyomi" class="form-control" id="input003">
				    </div>
				  	<div class="form-group col-md-12">
				    	<label for="exampleFormControlTextarea1">Example</label>
				    	<textarea class="form-control" name="example" id="exampleFormControlTextarea1" rows="3"></textarea>
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

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('assets/customs/asynctable.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    var dt = $('#kanjilist').DataTable({
		    	responsive: true
		    });

			let asynctable = new AsyncTable(dt, "{{csrf_token()}}", "{{url('kanji')}}");
		   	$('#kanjilist tbody').on('click', 'a.delete-bttn', event => {
				let tr = $(event.target).closest('tr');
				asynctable.targetRow = tr;
			});
			$('#deleteModal button.btn-danger').on('click', event => {
				asynctable.deleteRow();
			});

			$('#kanjilist tbody').on('click', 'a.edit-bttn', event => {
				let tr = $(event.target).closest('tr');
				let modal_func = (data) => {
					$('#editModal').find('input[name="kanji"]').val(data.kanji);
					$('#editModal').find('input[name="onyomi"]').val(data.onyomi);
					$('#editModal').find('input[name="konyomi"]').val(data.konyomi);
					$('#editModal').find('textarea[name="example"]').val(data.example);
					$('#editModal').modal('show');
				}
				asynctable.targetRow = tr;
				asynctable.editRow(modal_func);
			});
			$('#editModal').on('click', ':submit', event => {
				event.preventDefault();
				let insertOrder = ['', 'kanji'];
				asynctable.updateRow($('#updateForm'), insertOrder);
			});
		});
	</script>
@endsection