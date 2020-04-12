<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Create Account | Japanese Online Corner</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2&family=Nunito:wght@400;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/all.css') }}">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="{{asset('assets/imageUpload/style.css')}}">

</head>
<body>
  <section id="register" class="bg-light">
   <div class="container">
    <div class="registercard shadow bg-white">
      <div class="row">
        
        <div class="col-lg-5">
          <img src="{{ asset('assets/img/login.jpg') }}" class="img-fluid">
        </div>

        <div class="col-lg-7 form-div">
          <h2>JP Online Corn<span>er</span></h2>
          <h4 class="mt-3">Registration Form</h4>
          <form method="POST" action="{{ route('teacher.update') }}" enctype="multipart/form-data">
              @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form row center">


                  <div class="title">
                    <h1>Drop file to upload</h1>
                  </div>

                  <div class="dropzone">
                    <img id="blah" src="{{ asset($teacher->profile_pic) }}" alt="my profile" class="upload-icon"/ style="margin-top: 10px; width: 120px;height: 120px">
                    <input type="file" class="upload-input" name="profile" onchange="readURL(this);"/>
                  </div>



            </div>

            <div class="form row">
              <div class="col-md-6">
                <div class="group">      
                  <input  id="firstname" type="text" name="firstname" value="{{ $teacher->firstname }}" required autocomplete="off">
                  @error('firstname')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>First Name</label>                 
                </div>
              </div> 

              <div class="col-md-6">
                <div class="group">      
                  <input  id="lastname" type="text" name="lastname" value="{{ $teacher->lastname }}" required autocomplete="off">
                  @error('lastname')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Last Name</label>
                </div>
              </div>
            </div>

            <div class="form row">
              <div class="col-md-6">
                <div class="group">       
                  <input  id="email" type="email" name="email" value="{{ $teacher->email }}" required autocomplete="off" readonly>
                  @error('email')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
<!--                   <label>Email</label> -->
                </div>
              </div>

              <div class="col-md-6">
                <div class="group">      
                  <input  id="phone" type="text" name="phone" value="{{ $teacher->phone }}" required autocomplete="off">
                  @error('phone')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Phone No</label>
                </div>
              </div>
            </div>

            <div class="form row">
              <div class="col-md-6">
                <div class="group">      
                  <input  id="passoword" type="password" name="password" value=""  autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                  @error('passoword')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Password</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="group">      
                  <input  id="password_confirmation" type="password" name="password_confirmation" value=""  autocomplete="off">
                  @error('password_confirmation')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Confirm Password</label>
                </div>
              </div>
            </div>

            <div class="form row">
              <div class="col-md-6 my-lg-2 pt-1">
                <div class="group">      
                  <input  id="dob" type="date" name="dob" value="{{ $teacher->dateofbirth->format('Y-m-d') }}" max="2000-12-31" required>
                  @error('dob')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label class="extra-label">Date of Birth</label>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 my-lg-2">
                <div class="group">      
                  <input  id="address" type="text" name="address" value="{{ $teacher->address }}" max="2000-12-31" required autocomplete="off">
                  @error('address')
                    <span class="error-text">{{ $message }}</span>
                  @enderror
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Address</label>
                </div>
              </div>
            </div>

            
            <div class="form row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-get-started">Update</button>
              </div>
              <div class="col-md-6">
                <a type="button" class="btn btn-get-started text-white" href="{{ route('teacher.show') }}">Cancel</a>
              </div>
            </div>

          </form>
        </div>

      </div>  <!-- row end -->        
          
      </div> <!-- register card end -->  
    </div>  <!-- container end -->

  </section>

  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150)
                    .css("margin-top", "0px");
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
</body>
</html>