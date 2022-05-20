@extends('layout.app')

@section('style')
        <link
            href="{{asset('css/vendor/fontawesome-free/css/all.min.css')}}"
            rel="stylesheet"
            type="text/css"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"
        />

        <!-- Custom styles for this template-->
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" />

        <!-- Custom styles for this page -->
        <link
            href="{{asset('css/vendor/datatables/dataTables.bootstrap4.min.css')}}"
            rel="stylesheet"
        />

        <!-- Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

@endsection

@section('content')
    <!-- Topbar -->
    
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    @if ($message = Session::get('errors'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="m-0">
                <div class="row align-items-center">
                    <div class="col mt-2">
                        <h5 class="font-weight-bold text-primary">Categories</h5>
                    </div>
                    <div class="col text-right">
<<<<<<< HEAD
                        <a class="btn btn-primary" href="{{route('product/create')}}" role="button">
                            Create New Categories <i class="bi bi-plus-lg"></i>
=======
                        <a class="btn btn-primary" href="{{route('category/create')}}" role="button">
                            Create New Category <i class="bi bi-plus-lg"></i>
>>>>>>> bc6d5cc2aa94670c497fccbc68a6bc5657c898b9
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr> 
                            <td>{{$category->name}}</td>
                            <td>
                                <a type="button" class="btn btn-primary" href="{{route('category/show', $category->id)}}" role="button">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
        </div>
        <div class="modal-body">
          Do you want to delete ?
        </div>
        <input id="delete-input" type="hidden" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <a id="save-button" type="button" class="btn btn-primary" href="#">Yes</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script type="application/javascript">
    $(document).ready(function(){
        $(".action").on("click", function(event) {
            let id = $(this).attr('value')
            let url = '';
            url = url.replace(':id', id);
            $("#save-button").attr("href", url)
        })
    });
</script>

<!-- Page level plugins -->
<script src="{{asset('css/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('css/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection