<div class="content-wrapper">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th> Sr .no</th>
                            <th> Name </th>
                            <th>Email </th>
                            <th> Position </th>
                            <th> Amount </th>
                            <th> Deadline </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="table-info text-center">
                            <td> {{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td> Photoshop </td>
                            <td> $ 77.99 </td>
                            <td> May 15, 2015 </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>