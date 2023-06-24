@extends('layout.admin-layout')

@section('fillspace')
<h2>Subject</h2>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
Add subject</button>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
   @if(count($subjects)>0)
        @foreach($subjects as $sub)
        <tr>
          <td>{{$sub->id}}</td>
          <td>{{$sub->subject}}</td>
          <td>
            <button class="btn btn-info ediButton" 
            data-id="{{$sub->id}}"  
            data-toggle="modal" 
            data-subject="{{$sub->subject}}"
            data-target="#editSubjectModal">Edit<E/button>
          </td>
          <td>
            <button class="btn btn-danger deleteButton" 
            data-id="{{$sub->id}}"  
            data-toggle="modal" 
            data-target="#deleteSubjectModal">Delete</button>
          </td>
       </tr>
       @endforeach
   @else
    <tr>
        <td colspan="4">Subject not found</td>
    </tr>
   @endif
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <form id="addSubject">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <label>Subject</label>
            <input  name="subject" type="text" name="Entere subject" required>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">save</button>
            </div>
        </div>
    </form>    
    </div>
</div>

<!--Edit subj  -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <form id="editSubject">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <label>Subject</label>
            <input name="subject" type="text" id="edit_Subject" required>
            <input type="hidden" name="id" id="edit_subject_id">

            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
            </div>
        </div>
    </form>    
    </div>
</div>

<!-- delete -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <form id="deleteSubject">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <p>Are you sure you want to delete subject</p>
            <input type="hidden" name="id" id="delete_subject_id">

            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">delete</button>
            </div>
        </div>
    </form>    
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
  document.querySelector('#addSubject').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch("{{route('addSubject')}}", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success === true) {
        location.reload();
      } else {
        console.log(data.msg);
      }
    })
    .catch(error => {
      console.error(error);
    });
  });

  var ediButtons = document.querySelectorAll('.ediButton');
  ediButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var sub_id = this.getAttribute('data-id');
      var sub_subject = this.getAttribute('data-subject');
      document.querySelector('#edit_Subject').value = sub_subject;
      document.querySelector('#edit_subject_id').value = sub_id;
    });
  });

  document.querySelector('#editSubject').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch("{{route('editSubject')}}", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success === true) {
        location.reload();
      } else {
        console.log(data.msg);
      }
    })
    .catch(error => {
      console.error(error);
    });
  });

  var deleteButtons = document.querySelectorAll('.deleteButton');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var sub_id = this.getAttribute('data-id');
      document.querySelector('#delete_subject_id').value = sub_id;
    });
  });

  document.querySelector('#deleteSubject').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch("{{route('deleteSubject')}}", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success === true) {
        location.reload();
      } else {
        console.log(data.msg);
      }
    })
    .catch(error => {
      console.error(error);
    });
  });
});

</script>


@endsection
