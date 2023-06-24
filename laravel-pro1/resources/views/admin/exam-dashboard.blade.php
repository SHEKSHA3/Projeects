@extends('layout.admin-layout')

@section('fillspace')
<h2>Exams</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addExamModal">
    Add Exam
</button>

<!-- display -->
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Exam name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>time</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Generate</th>
        </tr>
    </thead>
    <tbody>
       @if(count($exams)>0)
       
        @foreach($exams as $exam)
        <tr>
            <td>{{$exam->id}}</td>
            <td>{{$exam->exam_name}}</td>
            <td>{{$exam->subject[0]->subject}}</td>
            <td>{{$exam->date}}</td>
            <td>{{$exam->time}}Hrs</td>
            <td>
                <button data-id="{{$exam->id}}" class="btn btn-info editButton" data-toggle="modal" data-target="#editExamModal">
                        Edit
                </button>
            </td>
            <td>
                <button data-id="{{$exam->id}}" class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteExamModal">
                        Delete
                </button>
            </td>
            <td>
                <button data-id="{{$exam->id}}" class="btn btn-primary testpaper">
                        generate
                </button>
            </td>

        </tr>  
        @endforeach   
     
       @else
        <tr>
            <td colspan="5">Exams not  found</td>
        </tr>   
       @endif

    </tbody>
</table>

<!-- Basic modal for all the development and which is oprning modal-->
<div class="modal fade" id="addExamModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="addExam">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Exam Name</label>
                                <input name="exam_name" type="text" placeholder="Enter exam name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <select name="subject_id" class="form-control" required>
                                    <option value="">Select Subject</option>
                                    @if(count($subjects) > 0)
                                        @foreach($subjects as $sub)
                                            <option value="{{$sub->id}}">{{$sub->subject}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input name="date" type="date" placeholder="Enter data" class="form-control" required min="@php echo date('Y-m-d');@endphp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input name="time" type="time" placeholder="Enter time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Question</label>
                                <input name="question" type="number" placeholder="Enter question" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Passing Percentage</label>
                                <input name="passing_percentage" type="number" placeholder="Enter passing percentage in percentage" class="form-control" min="1" max="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Easy</label>
                                <input name="easy" type="number" id="easy_per" placeholder="Enter easy in percentage" class="form-control" min="1" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Medium</label>
                                <input name="medium" type="number"
                                id="medium_per" 
                                placeholder="Enter medium in percentage" class="form-control" min="1" max="100" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hard</label>
                                <input name="hard" type="number" 
                                id="hard_per"
                                placeholder="Enter hard in percentage" class="form-control" min="1" max="100" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Exam</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- contente edint module where all section of editionn is done and addede -->
<div class="modal fade" id="editExamModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="editExam">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Exam Name</label>
                                <input name="exam_name" id="exam_name" type="text" placeholder="Enter exam name" class="form-control" required>
                                <input type="hidden" name="exam_id" id="exam_id">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="">Select Subject</option>
                                    @if(count($subjects) > 0)
                                        @foreach($subjects as $sub)
                                            <option value="{{$sub->id}}">{{$sub->subject}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input name="date" type="date" id="date" placeholder="Enter data" class="form-control" required min="@php echo date('Y-m-d');@endphp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input name="time" type="time" id="time" placeholder="Enter time" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Question</label>
                                <input name="question" type="number" id="question" placeholder="Enter question" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Passing Percentage</label>
                                <input name="passing_percentage" type="number" id="passing_percentage" placeholder="Enter passing percentage in percentage" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Easy</label>
                                <input name="easy" id="easy" type="number" placeholder="Enter easy in percentage" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Medium</label>
                                <input name="medium" id="medium" type="number" placeholder="Enter medium in percentage" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hard</label>
                                <input name="hard" type="number" id="hard" placeholder="Enter hard in percentage" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="errorEdit" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="deleteExam">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                 <input type="hidden" name="exam_id" id="deleteExamId">
                 <p class="text-danger">Are you sure you want to delete the exam</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('addExam').addEventListener('submit', function(e) {
    e.preventDefault();
    let mediumPer = parseInt(document.getElementById('medium_per').value);
    let easyPer = parseInt(document.getElementById('easy_per').value);
    let hardPer = parseInt(document.getElementById('hard_per').value);
    let difficulty = mediumPer + easyPer + hardPer;
    
    if (difficulty === 100) {
      var formData = new FormData(this);
      fetch("{{route('addExam')}}", {
        method: "POST",
        body: formData
      })
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        if (data.success === true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      });
    } else {
      document.querySelector(".error").textContent = "Total difficulty level should be 100%";
    }
  });

  document.querySelectorAll(".editButton").forEach(function(button) {
    button.addEventListener('click', function() {
      var id = this.getAttribute('data-id');
      document.getElementById('exam_id').value = id;
      var url = "{{route('getExamDetails','id')}}".replace('id', id);
      fetch(url)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        if (data.success === true) {
          var exam = data.data;
          document.getElementById('exam_name').value = exam[0].exam_name;
          document.getElementById('subject_id').value = exam[0].subject_id;
          document.getElementById('date').value = exam[0].date;
          document.getElementById('time').value = exam[0].time;
          document.getElementById('question').value = exam[0].question;
          document.getElementById('easy').value = exam[0].easy;
          document.getElementById('medium').value = exam[0].medium;
          document.getElementById('hard').value = exam[0].hard;
          document.getElementById('passing_percentage').value = exam[0].passing_percentage;
        } else {
          alert(data.msg);
        }
      });
    });
  });

  document.getElementById('editExam').addEventListener('submit', function(e) {
    e.preventDefault();
    let easy = parseInt(document.getElementById('easy').value);
    let medium = parseInt(document.getElementById('medium').value);
    let hard = parseInt(document.getElementById('hard').value);
    let difficulty = easy + medium + hard;
    
    if (difficulty === 100) {
      var formData = new FormData(this);
      fetch("{{route('updateExam')}}", {
        method: "POST",
        body: formData
      })
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        if (data.success === true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      });
    } else {
      document.querySelector(".errorEdit").textContent = "There must be a difficulty level of 100%";
    }
  });

  document.querySelectorAll(".deleteButton").forEach(function(button) {
    button.addEventListener('click', function() {
      var id = this.getAttribute('data-id');
      document.getElementById('deleteExamId').value = id;
      document.getElementById('deleteExam').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch("{{route('deleteExam')}}", {
          method: "POST",
          body: formData
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          if (data.success === true) {
            location.reload();
          } else {
            alert(data.msg);
          }
        });
      });
    });
  });

  document.querySelectorAll(".testpaper").forEach(function(button) {
    button.addEventListener('click', function() {
       
      var id = this.getAttribute('data-id');
      var url = '{{ route("showExam", ["examId" => ":id"]) }}';
    url = url.replace(':id', id);
    
      fetch(url)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        console.log(data);
        if (data.success === true) {
          alert("Test generated successfully. You can see the answers in the test section.",data);
        } else {
          alert(data.msg);
        }
      });
    });
  });
});

</script>



@endsection
