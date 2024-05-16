@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Orders</h2>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createOrderModal">
            Create New Order
        </button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Order Name</th>
                <th>Client</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Product</th>
                <th>Order Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->client->first_name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->order_price }}</td>
                    <td>{{ $order->description }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editOrderModal-{{ $order->id }}">
                            Edit
                        </button>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
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

    <div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOrderModalLabel">Create New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Order Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select name="clients_id" class="form-control" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order_date">Order Date</label>
                            <input type="date" name="order_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status_id">Order Status</label>
                            <select name="status_id" class="form-control" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" class="form-control" required>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="order_price">Order Price</label>
                            <input type="number" step="0.01" name="order_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control"></textarea>
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

    <!-- Select Client Modal -->
    <div class="modal fade" id="selectClientModal" tabindex="-1" role="dialog" aria-labelledby="selectClientModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectClientModalLabel">Select Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Select</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->first_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm"
                                            onclick="selectClient({{ $client->id }}, '{{ $client->first_name }}')">
                                        Select
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

    <!-- Edit Order Modals -->
    <!-- Add your edit order modals here -->

@endsection

@push('scripts')
    <script>
        function selectClient(clientId, clientName) {
            document.getElementById('selectedClientId').value = clientId;
            document.getElementById('client_name').value = clientName;
            $('#selectClientModal').modal('hide');
        }
    </script>
@endpush

