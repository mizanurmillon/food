@extends("layouts.admin")
@section("admin_content")

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">SEO Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">SEO</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-8">
            <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">SEO Setting Page</h3>
            </div>
            <form action="{{ route('seo.setting.update',$data->id) }}" method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Meta Title</label>
                  <input type="text" class="form-control" placeholder="Meta Title" value="{{ $data->meta_title }}" name="meta_title">
                </div>
                <div class="form-group">
                  <label>Meta Author</label>
                  <input type="text" class="form-control" placeholder="Meta author" value="{{ $data->meta_author }}" name="meta_author">
                </div>
                <div class="form-group">
                  <label>Meta Tag</label>
                  <input type="text" class="form-control" placeholder="Meta Tag" value="{{ $data->meta_tag }}" name="meta_tag">
                </div>
                <div class="form-group">
                  <label>Meta Keyword</label>
                  <input type="text" class="form-control" placeholder="Meta Keyword" value="{{ $data->meta_keyword }}" name="meta_keyword">
                  <small>Example:ecommerce,online shop,online merket</small>
                </div>
                <div class="form-group">
                  <label>Meta Description</label>
                  <textarea name="meta_description" class="form-control">{{ $data->meta_description}}</textarea>
                </div>
                <br>
                <div class="text-center text-danger">--- other option ---</div>
                <br>
                <div class="form-group">
                  <label>Google Verification</label>
                  <input type="text" class="form-control" placeholder="Mate Keyword" value="{{ $data->google_verification }}" name="goole_verification">
                </div>
                <div class="form-group">
                  <label>Alexa Verification</label>
                  <input type="text" class="form-control" placeholder="Mate Keyword" value="{{ $data->alexa_verification }}" name="alexa_verification">
                  <small>put here only verification code</small>
                </div>
                <div class="form-group">
                  <label>Google Analytics</label>
                  <textarea name="google_analytics" class="form-control">{{ $data->google_analytics }}</textarea>
                </div>
                <div class="form-group">
                  <label>Google Adsense</label>
                  <textarea name="google_adsense" class="form-control">{{ $data->google_adsense }}</textarea>
                </div>

                <div class="input-group-append">
                 <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
       
      </div><!--/. container-fluid -->
    </section>
  </div>
@endsection