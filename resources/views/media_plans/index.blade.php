@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Media Plans</h2>
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#createMediaPlanModal">
            Create New Media Plan
        </button>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Order</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Channel</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mPlans as $mPlan)
                <tr>
                    <td>{{ optional($mPlan->order)->name }}</td>
                    <td>{{ $mPlan->start_date }}</td>
                    <td>{{ $mPlan->end_date }}</td>
                    <td>{{ optional($mPlan->channel)->name }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#editMediaPlanModal-{{ $mPlan->id }}">
                            Edit
                        </button>
                        <form action="{{ route('media_plans.destroy', $mPlan->id) }}" method="POST"
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

    <!-- Create Media Plan Modal -->
    <div class="modal fade" id="createMediaPlanModal" tabindex="-1" role="dialog"
         aria-labelledby="createMediaPlanModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMediaPlanModalLabel">Create New Media Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('media_plans.store') }}" method="POST">
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
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="channels_id">Channel</label>
                            <select name="channels_id" class="form-control" required>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </select>
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

    <!-- Edit Media Plan Modals -->
    @foreach($mPlans as $mPlan)
        <div class="modal fade" id="editMediaPlanModal-{{ $mPlan->id }}" tabindex="-1" role="dialog"
             aria-labelledby="editMediaPlanModalLabel-{{ $mPlan->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMediaPlanModalLabel-{{ $mPlan->id }}">Edit Media Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('media_plans.update', $mPlan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="order_id">Order</label>
                                <select name="order_id" class="form-control" required>
                                    @foreach($orders as $order)
                                        <option value="{{ $order->id }}" {{ $mPlan->order_id == $order->id ? 'selected' : '' }}>
                                            {{ $order->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $mPlan->start_date }}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $mPlan->end_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="channels_id">Channel</label>
                                <select name="channels_id" class="form-control" required>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ $mPlan->channels_id == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
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
