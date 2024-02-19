@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col-md-12" style="margin-top: 100px;">
        <label for="isBlockedFilter">Filter by Blocked Status:</label>
        <select id="isBlockedFilter" class="form-control">
            <option value="">All</option>
            <option value="true">Blocked</option>
            <option value="false">Not Blocked</option>
        </select>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Barbers List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="barbersTable"> <!-- Add an ID to the Barbers table -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Blocked Status</th>
                                <th>Gender</th>
                                <th>Approval Status</th>
                                <th>Average Review</th>
                                <th>Total Reviews</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barberProfiles as $barberprofile)
                                <tr>
                                    <td>{{ $barberprofile['name'] ?? 'null' }}</td>
                                    <td>{{ $barberprofile['isBlocked'] ? 'true' : 'false' }}</td>
                                    <td>{{ $barberprofile['genderName'] ?? 'null'}}</td>
                                    <td>{{ $barberprofile['isApprovedByAdmin'] ? 'true' : 'false' }}</td>
                                    <td>{{ $barberprofile['averageReview'] ?? 'null'}}</td>
                                    <td>{{ $barberprofile['totalReviews'] ?? 'null'}}</td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <form action="{{ route('barber.approve', ['userId' => $barberprofile['userId']]) }}" method="POST">
                                                @csrf
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Approve">
                                                    <img src="{{ asset('images/thumbs-up-solid.png') }}" alt="Approve" width="16" height="16">
                                                </button>
                                            </form>

                                            <form action="{{ route('barber.block', ['userId' => $barberprofile['userId']]) }}" method="POST">
                                                @csrf
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Block">
                                                    <img src="{{ asset('images/ban-solid.png') }}" alt="Block" width="16" height="16">
                                                </button>
                                            </form>

                                            <form action="{{ route('barber.delete', ['id' => $barberprofile['id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this barber?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                                    <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('isBlockedFilter').addEventListener('change', function () {
                var filterValue = this.value;

                var rows = document.querySelectorAll('#barbersTable tbody tr'); // Specify the ID of the Barbers table
                rows.forEach(function (row) {
                    var blockedStatus = row.cells[1].innerText.trim().toLowerCase();
                    if (filterValue === '' || blockedStatus === filterValue) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>



<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Clients List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped">
                    <thead>
                    <tr style="margin-right:10px";>
                            <th>ID</th>
                            <th>isBlocked</th>
                            <th>GenderName</th>
                            <th>PhoneNumber</th>
                            <th>UserID</th>
                            <th>GenderId</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientProfiles as $clientprofile)
                            <tr>
                                <td>{{ $clientprofile['id'] ?? 'null'}}</td>
                                <td>{{ $clientprofile['isBlocked']? 'true' : 'false' }}</td>
                                <td>{{ $clientprofile['genderName'] ?? 'null'}}</td>
                                <td>{{ $clientprofile['phoneNumber'] ?? 'null'}}</td>
                                <td>{{ $clientprofile['userId'] ?? 'null'}}</td>
                                <td>{{ $clientprofile['genderId'] ?? 'null'}}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        
                                  <form action="{{ route('barber.block', ['userId' => $clientprofile['userId']]) }}" method="POST">
                                      @csrf
                                      <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Block">
                                          <img src="{{ asset('images/ban-solid.png') }}" alt="Block" width="16" height="16">
                                      </button>
                                  </form>

                                    <form action="{{ route('client.delete', ['id' => $clientprofile['id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                            <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Services List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ServiceName</th>
                            <th style="margin-left: 30px !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceProfiles as $serviceprofile)
                            <tr>
                                <td>{{ $serviceprofile['id'] }}</td>
                                <td>{{ $serviceprofile['serviceName'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                       
                                    <form action="{{ route('service.delete', ['id' => $serviceprofile['id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer; border-radius: 50%; margin-right: 6px;" title="Delete">
                                              <img src="{{ asset('images/trash-solid.png') }}" alt="Delete" width="16" height="16">
                                          </button>
                                      </form>
                                    </div>
                                </td>
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


@section('scripts')

@endsection
