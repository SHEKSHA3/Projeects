@extends('layout.admin-layout')
@section('fillspace')
<h2>Test Assignment</h2>

<form action="{{ route('testAssignmentTocandidates') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="candidate" class="text-primary">Select Candidate:</label>
        <select name="candidate" id="candidate" class="form-control text-black" required>
            <option value="">select</option>
            @foreach ($total as $candidate)
            @if (isset($candidate->name))
                <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="subject" class="text-danger" >Select Subject:</label>
        <select name="exam" id="exam" class="form-control  text-black" required>
            <option value="">select</option>
            @foreach ($total as $subject)
            @if (isset($subject->exam_name))
                <option value="{{ $subject->id }}">{{ $subject->exam_name }}</option>
            @endif
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Assign Test</button> 
</form>

<div class="form-group mt-4">
    <label for="search" class="text-primary">Search:</label>
    <input type="text" id="search" class="form-control" placeholder="Enter a search term">
</div>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
</head>
<body>
    <h2>Test Assignment</h2>

    <table>
        <tr>
            <th>Assignment ID</th>
            <th>Candidate ID</th>
            <th>Candidate Name</th>
           
            <th>Exam Name</th>
            <th>Subject ID</th>
            <th>Delete</th>

        </tr>
        @foreach ($total as $assignment)
        <tr>
            @if (isset($assignment->candidate[0]->name))
            <td>{{ $assignment->id }}</td>
            <td>{{ $assignment->student_id }}</td>
            <td>{{ $assignment->candidate[0]->name ?? '' }}</td>
            <td>{{ $assignment->exam[0]->exam_name ?? '' }}</td>
            <td>{{ $assignment->exam[0]->subject_id ?? '' }}</td>
            <td>
            <a href="{{ route('deleteTestCandidate', ['studentId' => $assignment->student_id, 'examId' => $assignment->exam_id]) }}" class="btn btn-danger">Delete</a>
            </td>

            @endif
            
        </tr>
        @endforeach
    </table>
</body>
</html>

<script>
    console.log(@json($total));

    function deleteRow(index) {
        // Implement your delete logic here
        console.log("Delete row at index:", index);
    }

    function editRow(index) {
        // Implement your edit logic here
        console.log("Edit row at index:", index);
    }

    console.log(@json($total));

    function deleteRow(index) {
        // Implement your delete logic here
        console.log("Delete row at index:", index);
    }

    function editRow(index) {
        // Implement your edit logic here
        console.log("Edit row at index:", index);
    }

    // Search function
    document.getElementById("search").addEventListener("input", function() {
        var searchValue = this.value.toLowerCase();
        var tableRows = document.querySelectorAll("table tr");

        tableRows.forEach(function(row) {
            var rowData = row.textContent.toLowerCase();
            if (rowData.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });


</script>

@endsection
