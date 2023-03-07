@extends('master')
@section("content")
    <div class="container">
        <div class="row justify-content-center" style="    margin-top: 123px;
        margin-bottom: 91px;">
            <div class="col-md-6">
                <div class="profile" style="margin: auto;margin-bottom: 36px;">
                    <h1>{{ $user->username }}</h1>
                    <p>Email: {{ $user->email }}</p>
                    <p>Phone: {{ $user->phone_number }}</p>
                </div>

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control @error('username', 'post') is-invalid @enderror">
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email', 'post') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone:</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="form-control @error('phone_number', 'post') is-invalid @enderror">
                        @error('phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>

                {{-- <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="username" value="{{ $user->username }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone:</label>
                        <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form> --}}

                {{-- <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="username" value="{{ old('email', $user->username) }}" class="form-control @error('username', 'post') is-invalid @enderror">
                        @error('username')
                        <div class="alert alert-danger">{{ $message }} AA</div>
                        Username: {{ $validatedData['username'] }}
                    @enderror
    
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email', 'post') is-invalid @enderror">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone:</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="form-control @error('phone_number', 'post') is-invalid @enderror">
                        @error('phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
               
                </form> --}}

        </ul>
    </div>

{{-- @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}AA</div>
@endif
<div class="alert alert-success">{{ session('success') }}AA</div> --}}
            </div> 
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    @if(session()->has('success'))
    <script>
        swal({
            icon: 'success',
            title: "Success",
            text: "{{ session()->get('success') }}",
            type: "success",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: false,
        });
    </script>
    {{ session()->forget('success') }}
    {{-- @elseif (session()->has('error'))
    <script>
                swal({
            icon: 'error',
            title: "Error",
            text: "{{ session()->get('error') }}",
            type: "error",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: false,
        });
    </script>
    {{ session()->forget('error') }} --}}
@endif

    
@endsection
