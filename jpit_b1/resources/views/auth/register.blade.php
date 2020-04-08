@extends('template')
@section('css')
    <style type="text/css">
  legend.address-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width: auto;
    padding:0 10px;
    border-bottom:none;
  }
  fieldset.address-border{
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
  }
</style>
@endsection
@section('content')

    <div class="container">                    
        <h1 style="text-align: center;vertical-align: middle;">Registration Form</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form row">
                <div class="col-md-6 mb-3">
                    <label for="firstname">{{ __('First Name') }}</label>
                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" placeholder="Your first name" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                    <div class="invalid-feedback"></div>
                    <div class="valid-feedback">It's Ok</div>
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lastname">{{ __('Last Name') }}</label>
                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="Your second name" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                    <div class="invalid-feedback"></div>
                    <div class="valid-feedback">It's Ok</div>
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form row">
                <div class="col-md-6 mb-3">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input id="phone" type="tel" pattern="09-[0-9]+" class="form-control @error('phone') is-invalid @enderror" placeholder="09-XXX XXX XXX" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form row">
                <div class="col-md-6 mb-3">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                <label for="phone">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form row">
                <div class="col-md-4 mb-3">
                    <label for="profile">Profile Picture</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="dateofbirth">Date Of Birth</label>
                    <div class="form-group">
                        <div class="input-group date">
                            <input type="text" id="datepicker" class="form-control" placeholder="Select DOB" name="stockdate">
                            <div class="input-group-text" onclick="showDate()"><i class="fa fa-calendar" style="font-size: 1.5em;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control">
                </div>
            </div>
<!----------------------------------- FIELDSET-------------------------------------------->
            <fieldset class="address-border">
            <legend class="address-border">Itemdity</legend>
                <div class="form-row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="batch">Batch No</label>
                        <input type="number" name="batch" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="roll">Roll No</label>
                        <input type="number" name="roll" class="form-control" required>
                    </div>      
                </div>
            </fieldset>       
            <div class="form row">
                <div class="col-md-2 offset-md-5" style="align-content: center;">
                    <button type="submit" class="btn btn-lg btn-block btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('dist/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
   $("#datepicker").datepicker();
    function showDate() {
      console.log('click');
    document.getElementById("datepicker").focus();
  }
</script>
@endsection