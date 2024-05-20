@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Reports</h2>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createReportModal">
            Create New Report
        </button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Order</th>
                <th>Report Type</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->order->name }}</td>
                    <td>{{ $report->type->name }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editReportModal-{{ $report->id }}">
                            Edit
                        </button>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST"
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
        <div class="d-flex justify-content-center">
            {{ $reports->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- Create Report Modal -->
    <div class="modal fade" id="createReportModal" tabindex="-1" role="dialog" aria-labelledby="createReportModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReportModalLabel">Create New Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/reports" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="order_id">Order</label>
                            <select name="order_id" class="form-control" required>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Report Type</label>
                            <select name="type_id" class="form-control" required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
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

    <!-- Edit Report Modals -->
    @foreach($reports as $report)
        <div class="modal fade" id="editReportModal-{{ $report->id }}" tabindex="-1" role="dialog"
             aria-labelledby="editReportModalLabel-{{ $report->id }}"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReportModalLabel-{{ $report->id }}">Edit Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('reports.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="order_id">Order</label>
                                <select name="order_id" class="form-control" required>
                                    @foreach($orders as $order)
                                        <option
                                            value="{{ $order->id }}" {{ $report->order_id == $order->id ? 'selected' : '' }}>
                                            {{ $order->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Report Type</label>
                                <select name="type_id" class="form-control" required>
                                    @foreach($types as $type)
                                        <option
                                            value="{{ $type->id }}" {{ $report->type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control">{{ $report->description }}</textarea>
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
