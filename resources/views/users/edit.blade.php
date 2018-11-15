<!DOCTYPE html>
<html lang="en">
@include('parts.header_head')
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    @include('parts.header_navbar')
    @include('parts.menu')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-12">
                    <h4 class="page-title">User</h4>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="/users/list">User</a></li>
                        <li class="active">Edit</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- row -->
            <div class="row">
                <div class=" col-md-offset-2 col-md-8 col-xs-12">
                    <div class="white-box">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <form class="form-horizontal" method="POST" action="/users/edit/{{$user->id}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-offset-4 col-md-4" for="image">Image</label>
                                        <div class="col-md-offset-4 col-md-4" id="profilePic">

                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" value="{{$user->name}}" name="name">
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" disabled class="form-control form-control-line" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" value="{{$user->phone}}" name="phone">
                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Role</label>
                                        <div class="col-md-12">
                                            <select class="form-control form-control-line" name="role">
                                                @foreach(["Root"=>"Root","Basic"=>"Basic","Pro"=>"Pro","Extreme"=>"Extreme","Developer100"=>"100 Dev Accounts","Developer250"=>"250 Dev Accounts","Developer500"=>"500 Dev Accounts"] as $k=>$v )
                                                    @if($user->hasRole($k))
                                                        <option value="{{$k}}" selected>{{$v}}</option>
                                                    @else
                                                        <option value="{{$k}}">{{$v}}</option>
                                                    @endif
                                                @endforeach
                                                <!--<option value="Root">Root</option>
                                                <option value="Basic">Basic</option>
                                                <option value="Pro">Pro</option>
                                                <option value="Extreme">Extreme</option>
                                                <option value="Developer100">100 Dev Accounts</option>
                                                <option value="Developer250">250 Dev Accounts</option>
                                                <option value="Developer500">500 Dev Accounts</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                        <label class="col-sm-12">Country</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-line" value="{{$user->country}}" name="country">
                                            @if ($errors->has('country'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" value="" name="password">
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Update User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @include('parts.copy')
</div>
<!-- /#wrapper -->
@include('parts.footer_imports')
<script>
    $(document).ready(function () {

        $(".dropify-render").html();
        @if (Auth::user()->image)
            $("#profilePic").append("<img src='data:image/{{pathinfo(Auth::user()->image, PATHINFO_EXTENSION)}};base64, {{ base64_encode(Storage::get(Auth::user()->image)) }}' />");
        @endif

    });
</script>
</body>
</html>
