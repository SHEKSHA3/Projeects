@extends('layout.admin-layout')

@section('fillspace')
<input type="text" id="search-input" placeholder="Search username or email...">
    <br><br>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userlist as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_admin == 1)
                        <span class="badge badge-primary">Admin</span>
                    @else
                        <span class="badge badge-info">Candidate</span>
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <button class="btn btn-danger delete-btn" data-id="{{ $user->id  }}">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.querySelectorAll(".delete-btn").forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            alert("are you sure you want to delete")
            var url = '{{ route("admin.deleteUser", ["userId" => ":id"]) }}';
            url = url.replace(':id', id);

            fetch(url, {
                method: 'get',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                console.log(data);
                if (data.message) {
                    
                    location.reload();
                }
            });
        });
        var searchInput = document.getElementById('search-input');
            var tableRows = document.querySelectorAll('.table tbody tr');

            searchInput.addEventListener('input', function() {
                var query = searchInput.value.trim().toLowerCase();

                tableRows.forEach(function(row) {
                    var rowData = row.textContent.toLowerCase();
                    if (rowData.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

    });
</script>

</script>   



@endsection
