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
                        <h5 class="font-weight-bold text-primary">Products</h5>
                    </div>
                    <div class="col text-right">
                        <a class="btn btn-primary" href="{{route('product/create')}}" role="button">
                            Create New Product <i class="bi bi-plus-lg"></i>
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
                            <th>Category</th>
                            <th>Price</th>
                            <th>Photo</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr> 
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->price}}</td>
                            <td><img src="{{asset('images/'. $product->photo)}}"width="100" height="100"></td>
                            {{-- <td>{{$product->photo}}</td> --}}
                            <td>{{$product->link}}</td>
                            <td>
                                <a type="button" class="btn btn-primary" href="{{route('product/show', $product->id)}}" role="button">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button id="delete-button" type="button" class="action btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="{{$product->id}}">
                                    <i class="bi bi-x-lg" value="{{$product->id}}">
                                    </i>
                                </button>
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
            let url = '{{ route("product/destroy", ":id") }}';
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