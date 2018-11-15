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
                                <form class="form-horizontal" method="POST" action="/users/reset/{{$user->id}}">
                                    {{ csrf_field() }}

									<div class="form-group">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" name="password" value="">
                                        </div>
                                    </div>

									<div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Update Password</button>
                                        </div>
                                    </div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('parts.copy')
</div>

@include('parts.footer_imports')

</body>
</html>