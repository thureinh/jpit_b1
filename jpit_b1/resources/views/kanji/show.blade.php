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
							Kanji 「 {{ $kanji->kanji }} 」
							<sup><a href="#" title="Edit" class="btn btn-link text-info"><i class="far fa-edit fa-sm" data-toggle="modal" data-target="#edit-topic-modal"></i></a></sup>
						</h3>
						<div class="float-right mt-2">
							<a href="{{ route('kanji.index') }}" class="btn btn-white-cardbutton">
								<i class="fas fa-angle-left pr-2"></i> Back
							</a>
						</div>
						<div class="clearfix"></div>

						<!-- show from kanji table -->
						<div class="shadow px-4 py-3 mb-5">
							<h5 class="mb-4 py-2">漢字</h5>
							<div class="row">
								<div class="col-lg-3">
									<div class="card kanjicard m-auto rounded-0">
										<hr class="horizontal">
										<hr class="vertical">
										<span>{{ $kanji->kanji }}</span>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="row">
										<div class="col-6"><p><span class="font-weight-bold">音</span>　- {{ $kanji->onyomi }}</p></div>
										<div class="col-6"><p><span class="font-weight-bold">訓</span>　- {{ $kanji->konyomi }}</p></div>
									</div>
									<div class="row">
										<div class="col-12">
											<h6>Example: </h6>
											<p>
												{!! $kanji->example !!}
											</p>
										</div>
									</div>
								</div>
							</div>

							<hr>
							<!-- handwriting -->
							<div class="table-responsive p-3 mt-3">
								<h5>Stroke Order and Writing</h5>
								<div class="row">
									<div class="col-lg-3">
										<div id="draw" style="width: 110px;" class="shadow m-auto"></div>
									</div>
									<div class="col-lg-9">
										<div class="kanji-button">
											<button id="rewind" class="btn btn-sm btn-info"><i class="fas fa-angle-left"></i></button>
					            <button id="play" class="btn btn-sm btn-info"><i class="fas fa-play fa-sm"></i></button>
					            <button id="pause" class="btn btn-sm btn-info"><i class="fas fa-pause fa-sm"></i></button>
					            <button id="forward" class="btn btn-sm btn-info"><i class="fas fa-angle-right"></i></button>
				            </div>
									</div>
								</div>
							</div>
							<hr>

							<!-- kanji detail list -->
							<div class="table-responsive p-3 mt-3">
							<h5>Related words with「 {{ $kanji->kanji }} 」</h5>
							@if(count($kanjiwords) == 0)
								<p>Please insert example words or related words of「 {{ $kanji->kanji }} 」.</p>
							@else
								<table id="kanjilist" class="display table table-bordered table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>漢字</th>
											<th>読み方</th>
											<th>意味</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@php $i = 0 @endphp
										@foreach($kanjiwords as $kanjiword)
										@php $i++ @endphp 
										<tr id="tr-{{$kanjiword->id}}">
											<td>{{$i}}.</td>
											<td>{{$kanjiword->word}}</td>
											<td>{{$kanjiword->yomikata}}</td>
											<td>{{$kanjiword->meaning}}</td>
											<td>
												<a href="#" class="btn btn-outline-info btn-sm edit-bttn" data-toggle="modal"><i class="far fa-edit"></i> Edit</a>

					                			<a href="#deleteModal" data-toggle="modal" name="btndelete" class="btn btn-outline-danger btn-sm delete-bttn"><i class="far fa-trash-alt"></i> Remove</a>
											</td>
										</tr>

										@endforeach
									</tbody>
								</table>
							@endif
							</div>
						</div>

						<!-- Adding new kanji words -->
						<div class="shadow px-4 py-3 mb-5">
							<h5 class="mb-4 py-2">Add Kanji Word</h5>
							<form class="edited-form" method="POST" action="{{ route('kanjiword.store') }}">
      				@csrf
      					<input type="hidden" name="kanjiid" value="{{ $kanji->id }}">
								<div class="row">
									<div class="col-lg-3">
										<div class="group">
											<input  id="word" type="text" name="word" required autocomplete="off" value="{{old('word')}}">
						          <span class="highlight"></span>
						          <span class="bar"></span>
						          @error('word')
		                    <span class="error-text">{{ $message }}</span>
		                  @enderror
						          <label>漢字</label>
						        </div>
									</div>
									<div class="col-lg-4">
										<div class="group">
											<input  id="yomikata" type="text" name="yomikata" required autocomplete="off" value="{{old('yomikata')}}">
						          <span class="highlight"></span>
						          <span class="bar"></span>
						          @error('yomikata')
		                    <span class="error-text">{{ $message }}</span>
		                  @enderror
						          <label>読み方</label>
						        </div>
									</div>
									<div class="col-lg-3">
										<div class="group">
											<input  id="meaning" type="text" name="meaning" required autocomplete="off" value="{{old('meaning')}}">
						          <span class="highlight"></span>
						          <span class="bar"></span>
						          @error('meaning')
		                    <span class="error-text">{{ $message }}</span>
		                  @enderror
						          <label>意味</label>
						        </div>
									</div>
									<div class="col-lg-2">
										<button type="submit" class="btn btn-add w-100">Add</button>
									</div>
								</div>
							</form>
						</div>

					</div> <!-- sub-menu-content end -->
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
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Kanji</label>
		    <select class="form-control" name="kanji" id="exampleFormControlSelect1">
		    	@foreach($kanjis as $kanjiz)
		    		<option value="{{ $kanjiz->id }}" @if($kanji->id == $kanjiz->id) {{ 'selected' }}@endif>{{$kanjiz->kanji}}</option>
		    	@endforeach
		    </select>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="input001">Word</label>
		      <input type="text" name="word" class="form-control" id="input001">
		    </div>
		    <div class="form-group col-md-4">
		   		<label for="input003">Yomikata</label>
		      	<input type="text" name="yomikata" class="form-control" id="input003">
		    </div>
		    <div class="form-group col-md-4">
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

	      		<form id="edit-topic-form" method="POST" action="{{ route('kanji.update', ['kanji' => $kanji->id]) }}">
	      			<div class="form-group">
	      				@csrf
		   	  			@method('PUT')
		   	  			<input type="hidden" name="detail_update" value="false"/>
						<label for="input0234" class="h5 text-center mx-auto">Vocab Topic</label>
			        	<input type="text" id="input0234" class="form-control" name="topic" value="{{$kanji->kanji}}">
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
@endsection

@section('js')
	<script type="text/javascript" src="{{asset('assets/customs/asynctable.js')}}"></script>
	
	<script src="{{asset('assets/dmak/dmak.js')}}"></script>
	<script src="{{asset('assets/dmak/jquery.dmak.js')}}"></script>
	<script src="{{asset('assets/dmak/raphael-min.js')}}"></script>


	<script type="text/javascript">
		$(document).ready(function() {
		    var dt = $('#kanjilist').DataTable({
		    	responsive: true
		    });
		    let asynctable = new AsyncTable(dt, "{{csrf_token()}}", "{{url('kanjiword')}}");
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
					$('#editModal').find('input[name="word"]').val(data.word);
					$('#editModal').find('input[name="yomikata"]').val(data.yomikata);
					$('#editModal').find('input[name="meaning"]').val(data.meaning);
					$('#editModal').modal('show');
				}
				asynctable.targetRow = tr;
				asynctable.editRow(modal_func);
			});
			$('#editModal').on('click', ':submit', event => {
				event.preventDefault();
				let insertOrder = ['', 'word', 'yomikata', 'meaning'];
				asynctable.updateRow($('#updateForm'), insertOrder, ['{{$kanji->id}}', 'kanji_id']);
			});
		});
	</script>

	<script type="text/javascript">
		$("#draw").dmak('{{$kanji->kanji}}');

		$( document ).on( "click", "#play", function(e){
        e.preventDefault();
       $('#draw').dmak('play');
    });

    $( document ).on( "click", "#pause", function(e){
        e.preventDefault();
        $('#draw').dmak('pause');
    });

    $( document ).on( "click", "#rewind", function(e){
        e.preventDefault();
        $('#draw').dmak('rewind', 1);
    });

    $( document ).on( "click", "#forward", function(e){
        e.preventDefault();
        $('#draw').dmak('forward', 1);
    });

	</script>
@endsection