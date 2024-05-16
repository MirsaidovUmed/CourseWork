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

    <!-- Create Order Modal -->
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
                            <div class="input-group">
                                <input type="text" id="client_name" class="form-control" readonly>
                                <input type="hidden" name="client_id" id="client_id" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#selectClientModal">Select Client
                                    </button>
                                </div>
                            </div>
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
                                            onclick="selectClient(event, {{ $client->id }}, '{{ $client->first_name }}')">
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
    @foreach($orders as $order)
        <div class="modal fade" id="editOrderModal-{{ $order->id }}" tabindex="-1" role="dialog"
             aria-labelledby="editOrderModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel-{{ $order->id }}">Edit Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Order Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $order->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="client_id">Client</label>
                                <div class="input-group">
                                    <input type="text" id="client_name_edit_{{ $order->id }}" class="form-control"
                                           value="{{ $order->client->first_name }}" readonly>
                                    <input type="hidden" name="client_id" id="client_id_edit_{{ $order->id }}"
                                           value="{{ $order->client_id }}" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                data-target="#selectClientModal-{{ $order->id }}">Select Client
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="order_date">Order Date</label>
                                <input type="date" name="order_date" class="form-control"
                                       value="{{ $order->order_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status_id">Order Status</label>
                                <select name="status_id" class="form-control" required>
                                    @foreach($statuses as $status)
                                        <option
                                            value="{{ $status->id }}" {{ $status->id == $order->status_id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_price">Order Price</label>
                                <input type="number" step="0.01" name="order_price" class="form-control"
                                       value="{{ $order->order_price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control">{{ $order->description }}</textarea>
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

        <!-- Select Client Modal for Edit Order -->
        <div class="modal fade" id="selectClientModal-{{ $order->id }}" tabindex="-1" role="dialog"
             aria-labelledby="selectClientModalLabel-{{ $order->id }}"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectClientModalLabel-{{ $order->id }}">Select Client</h5>
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
                                                onclick="selectClientForEdit({{ $order->id }}, {{ $client->id }}, '{{ $client->first_name }}')">
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
    @endforeach
@endsection

@section('scripts')
    <script>
        function selectClient(event, clientId, clientName) {
            document.getElementById('client_id').value = clientId;
            document.getElementById('client_name').value = clientName;
            $('#selectClientModal').modal('hide');
        }

        function selectClientForEdit(event, orderId, clientId, clientName) {
            document.getElementById('client_id_edit_' + orderId).value = clientId;
            document.getElementById('client_name_edit_' + orderId).value = clientName;
            $('#selectClientModal-' + orderId).modal('hide');
        }
    </script>
@endsection
