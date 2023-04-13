@extends('admin.layouts.master')
@section('title')
    Chnage Request Details - Derick Veliz admin
@endsection
@push('styles')
<style>
    .dataTables_filter{
        margin-bottom: 10px !important;
    }
</style>
@endpush

@section('content')
    @php
        use App\Models\User;
    @endphp
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Chnage Request Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('change-request.index') }}">Change Request</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>
                   
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Chnage Request Details</h4>
                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="table-responsive">
                        <table id="myTable" class="dd table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Stuff Name</th>
                                    <th>Stuff Email</th>
                                    <th>Ticket Number</th>
                                    <th>Chnage Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $details)
                                    <tr>
                                        <td>{{ $details->stuff->name }}</td>
                                        <td>{{ $details->stuff->email }}</td>
                                        <td>{{ $details->ticket_number }}</td>
                                        <td>{{ $details->change_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //Default data table
            $('#myTable').DataTable({
                "aaSorting": [],
                "columnDefs": [{
                        "orderable": false,
                        "targets": []
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1, 2,3]
                    }
                ]
            });

        });
    </script>
@endpush
