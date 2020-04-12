@extends('template')

@section('content')

	<main id="maincontent">

		<section>

			<div class="container">
				<div class="row">
					@include('part.teachermenu')

					<div class="col-lg-9 sub-menu-content">
						
						<h3 class="float-left d-inline-block mt-2 mb-4">
							Kanji 「 {{ $kanji->kanji }} 」
							<sup><a href="#" title="Edit" class="btn btn-link text-info"><i class="far fa-edit fa-sm"></i></a></sup>
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

							<!-- kanji detail list -->
							<div class="table-responsive p-3 mt-3">
							<h5>Related word with「 {{ $kanji->kanji }} 」</h5>
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
										<tr>
											<td>{{$i}}.</td>
											<td>{{$kanjiword->word}}</td>
											<td>{{$kanjiword->yomikata}}</td>
											<td>{{$kanjiword->meaning}}</td>
											<td>
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

@section('js')
	<script type="text/javascript">
		$(document).ready(function() {
	    $('#kanjilist').DataTable({
	    	responsive: true
	    });
		});
	</script>
@endsection