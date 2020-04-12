@extends('template')

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
									<tr>
										<td>{{$i}}.</td>
										<td>{{$kanji->kanji}}</td>
										<td>{{$kanji->kanjiwords_count}}</td>
										<td>{{$kanji->created_at->toFormattedDateString()}}</td>
										<td>
											<a href="{{route('kanji.show', $kanji->id)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-external-link-alt"></i> View</a>
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

@section('js')
	<script type="text/javascript">
		$(document).ready(function() {
	    $('#kanjilist').DataTable({
	    	responsive: true
	    });
		});
	</script>
@endsection