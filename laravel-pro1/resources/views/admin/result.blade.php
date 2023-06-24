@extends('layout.admin-layout')

@section('fillspace')
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Exam</th>
      <th>Marks</th>
      <th>Status</th>
      <th>Answer sheet</th>

    </tr>
  </thead>
  <tbody>
    @foreach($results as $result)
    <tr>
      <td>{{ $result->id }}</td>
      <td>{{ $result->candidate->name }}</td>
      <td>{{ $result->candidate->email }}</td>
      <td>{{ $result->exam[0]->exam_name }}</td>
      <td>{{ $result->marks }}</td>
      <td>
      @if($result->marks > ($result->exam[0]->passing_percentage * $result->marks / 100))
          <span class="text-success">Pass</span>
        @else
          <span class="text-danger">Fail</span>
        @endif
      </td>

      <td><button type="button" class="btn btn-primary answersheet" data-id="{{ $result->candidate->id }}" data-exam-id="{{ $result->exam[0]->id }}" data-toggle="modal" data-target="#showanswer">Answer</button>

     </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="showanswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Candidate ID</th>
              <th>Exam ID</th>
              <th>Question ID</th>
              <th>Answer ID</th>
            </tr>
          </thead>
          <tbody id="modal-body-table">
            <!-- Table body will be dynamically populated -->
          </tbody>
        </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    console.log(@json($results));

document.querySelectorAll(".answersheet").forEach(function(button) {
  button.addEventListener("click", function() {
    var qid = this.getAttribute('data-id');
    var examId = this.getAttribute('data-exam-id');

    fetch("{{ route('answersheet', ['id' => ':id', 'exam_id' => ':exam_id']) }}".replace(':id', qid).replace(':exam_id', examId))
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error('Request failed.');
        }
      })
      .then(function(data) {
        var modalBodyTable = document.getElementById("modal-body-table");
        modalBodyTable.innerHTML = ""; // Clear existing table rows

        data.data.forEach(function(result) {
          var row = document.createElement("tr");

          var idCell = document.createElement("td");
          idCell.textContent = result.id;
          row.appendChild(idCell);

          var candidateIdCell = document.createElement("td");
          candidateIdCell.textContent = result.candidate_id;
          row.appendChild(candidateIdCell);

          var examIdCell = document.createElement("td");
          examIdCell.textContent = result.exam_id;
          row.appendChild(examIdCell);

          var questionIdCell = document.createElement("td");
          questionIdCell.textContent = result.question[0].question;;
          row.appendChild(questionIdCell);

          var answerIdCell = document.createElement("td");
          answerIdCell.textContent = result.answer[0].answer;;
          row.appendChild(answerIdCell);

          // Append more cells for other fields if needed

          modalBodyTable.appendChild(row);
        });
      })
      .catch(function(error) {
        console.log('Error:', error.message);
      });
  });
});



</script>

@endsection
