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
						<h3 class="float-left d-inline-block mt-2">Vocabulary</h3>
						<div class="float-right mt-2">
							<button class="btn btn-white-cardbutton" data-toggle="modal" data-target="#addNew">
								<i class="fas fa-plus pr-2"></i> Add New
							</button>
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
						<h5>All Vocabulary List</h5>
							<table id="vocablist" class="display table table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Topic</th>
										<th>No of words</th>
										<th>Created at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 0 @endphp
									@foreach($vocabs as $vocab)
									@php $i++ @endphp 
									<tr id='tr-{{$vocab->id}}'>
										<td>{{$i}}.</td>
										<td>{{$vocab->topic}}</td>
										<td>{{$vocab->vocabdetails_count}}</td>
										<td>{{$vocab->created_at->toFormattedDateString()}}</td>
										<td>
											<a href="{{route('vocab.show', $vocab->id)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-external-link-alt"></i> View</a>

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

<!-- Add New Modal -->
<div class="modal" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Vocabularies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      	<form class="edited-form" method="POST" action="{{ route('vocab.store') }}">
      		@csrf
	       	<div class="group">      
	          <input  id="topic" type="text" name="topic" required autocomplete="off" autofocus>
	          <span class="highlight"></span>
	          <span class="bar"></span>
	          @error('topic')
              <span class="error-text">{{ $message }}</span>
            @enderror
	          <label>Topic</label>
	        </div>

	        <button type="submit" class="btn btn-add w-25">Add</button>
	        <button type="button" class="btn btn-outline-secondary w-25" data-dismiss="modal">Cancel</button>
      	</form>
      </div>
    </div>
  </div>
</div>

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
@csrf
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
				asynctable.row = tr;
				let id = tr.attr('id');
				asynctable.targetRow(id);
			});
			$('#deleteModal button.btn-danger').on('click', event => {
				asynctable.deleteURL = "{{url('vocab')}}";
				asynctable.delete();
			});
		});
	</script>
@endsection