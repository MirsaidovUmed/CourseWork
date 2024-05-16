@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Products</h2>

        <!-- Display success messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to open the modal for creating a new product -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createProductModal">
            Create New Product
        </button>

        <!-- Products Table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->type->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <!-- Edit button -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editProductModal-{{ $product->id }}">
                            Edit
                        </button>

                        <!-- Delete form -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Product Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" role="dialog"
         aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Create New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Product Type</label>
                            <select name="type_id" class="form-control" required>
                                @foreach($productTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modals -->
    @foreach($products as $product)
        <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" role="dialog"
             aria-labelledby="editProductModalLabel-{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel-{{ $product->id }}">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Product Type</label>
                                <select name="type_id" class="form-control" required>
                                    @foreach($productTypes as $type)
                                        <option value="{{ $type->id }}"
                                                @if($product->type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" step="0.01" name="price" class="form-control"
                                       value="{{ $product->price }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <!-- Make sure to include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
