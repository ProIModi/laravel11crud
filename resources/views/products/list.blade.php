<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 CRUD demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <!--
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    -->
    <div class="bg-dark py-3">
        <h3 class = "text-white text-center">Simple Laravel 11 CRUD</h3>
      </div>
      <div class="container">
        <div class="row justify -content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href = "{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10">      
                <div class="alert alert-success mt-4">
                    {{ Session::get('success') }}
                </div>
            @endif
          <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
              <div class="card-header">
                <h3 class="text-black h4">Products</h3>
              </div>
              <div class = "card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>
                        </th>
                        <th>Name</th>
                        <th>Sku</th>
                        <th>Price</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                    @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->image != "")
                            <img width = "50" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
                                
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M,Y') }}</td>
                        <td>
                            <a href = "{{ route('products.edit',$product->id) }}" class = "btn btn-dark">Edit</a>
                            <a href = "#" onclick="deleteProduct({{ $product->id }});" class = "btn btn-danger">Delete</a>
                            <form id='delete-product-form-{{ $product->id }}' action="{{ route("products.destroy",$product->id) }}" method='post'>
                            @csrf

                              @method('delete')
                            </form>

                        </td>
                    </tr>    
                    @endforeach
                         
                    @endif
                    
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>    
   </body>
</html>
<script>
  function deleteProduct(id){
    if(confirm("Are you sure your want to delete..?")){
      document.getElementById("delete-product-form-"+id).submit();
    }
  }
</script>