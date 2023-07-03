@extends('layout.admin-layout')

@section('fillspace')
<div class="cards">

</div>

<!-- Modal -->
<div class="modal fade" id="examModal" tabindex="-1" aria-labelledby="examModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="examModalLabel">Exam Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body disply-body">
        <table class="table tableshow">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically added here -->
        </tbody>

        </table>
        <div id="examDetails"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    var exam = JSON.parse('<?php echo json_encode($testPapers); ?>');
var card = '';
console.log(exam)

for (let i = 0; i < exam.length; i++) {
    let name = exam[i]['exams'][0]['exam_name'];
    let date = new Date(exam[i]['exams'][0]['date']).toLocaleDateString();
    let time = exam[i]['exams'][0]['time'];

    card += `
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <h5 class="card-title">${name}</h5>
                <h6 class="card-text">${date}</h6>
                <h6 class="card-text">${time}</h6>
                <button class="btn btn-primary answershow" data-bs-toggle="modal" data-bs-target="#examModal" data-exam_id="${exam[i]['exam_id']}">View</button>
                
            </div>
        </div>
    `;
}

document.querySelector(".cards").innerHTML = card;

// Handle modal open event
document.querySelectorAll('.btn-primary').forEach(function(button) {
    button.addEventListener('click', function(event) {
        var examId = event.target.getAttribute('data-exam-id');
        // Handle the modal open event for the specific exam ID
     
    });
});
var buttons = document.querySelectorAll('.answershow');
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        var examId = this.getAttribute('data-exam_id');
       
        
        // Make AJAX call
        fetch('/fetchQuestions?examId=' + examId, {
          method: 'GET'
        })
        .then(function(response) {
          if (response.ok) {
            return response.json();
          } else {
            throw new Error('Error: ' + response.status);
          }
        })
        .then(function(data) {
    // Handle the response from the server
          console.log(data.data)
    var tableBody = document.querySelector('.tableshow tbody');
    tableBody.innerHTML = '';

    data.data.forEach(function(item) {
        var row = document.createElement('tr');
        var idCell = document.createElement('td');
        var questionCell = document.createElement('td');
        var answerCell = document.createElement('td');
        

        idCell.textContent = item.id;
        questionCell.textContent = item.question[0].question;
        answerCell.textContent = item.answer[0].answer;
       

        row.appendChild(idCell);
        row.appendChild(questionCell);
        row.appendChild(answerCell);
        

        tableBody.appendChild(row);
    });
})
.catch(function(error) {
    // Handle the error
    console.error(error);
});
      });
    });

    
</script>

@endsection
