@extends('layout.admin-layout')

@section('fillspace')
    <h2>Question and answer</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addQnaModal">
        Question and answer
    </button>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Level</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if(count($questions) > 0)
                @foreach($questions as $que)
                    <tr>
                        <td>{{$que->id}}</td>
                        <td>{{$que->question}}</td>
                        <td>
                            <a href="#" class="ansButton" data-id="{{$que->id}}"
                            data-toggle="modal" data-target="#showAnsModal">see answer</a>
                        </td>
                        <td>{{$que->level[0]['name']}}</td>
                        <td>
                            <button class="btn btn-info editButton"
                            href="#" data-id="{{$que->id}}"
                            data-toggle="modal" data-target="#editQnaModal">edit</button>
                        </td>
                        <td>
                            <a class="btn btn-danger deleteButton"
                            href="/deleteQuestion/{{$que->id}}" data-id="{{$que->id}}"
                            >Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">You have not added any questions</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="addquestion">
                    @csrf
                    <div class="modal-body addModalAnswer">
                        <div class="row d-flex">
                            <div class="col">
                                <input type="text" class="w-100" name="question" placeholder="Enter the question" required>
                            </div>
                        </div>
                        <div class="row d-inline mt-2 answers">
                    <input type="radio" name="is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>
                <div class="row d-inline mt-2 answers">
                    <input type="radio" name="is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>
                <div class="row d-inline mt-2 answers">
                    <input type="radio" name="is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>
                <div class="row d-inline mt-2 answers">
                    <input type="radio" name="is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>

                    </div>
                    <div class="modal-footer">
                        <select required name="level_id">
                            <option value="">Select difficulty</option>
                            <option value="1">Easy</option>
                            <option value="2">Medium</option>
                            <option value="3">Hard</option>
                        </select>

                        <span class="error" style="color:red;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Show answers modal -->
    <div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Answer</th>
                            <th>Is Correct</th>
                        </thead>
                        <tbody class="showAnswers">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- edit the answer answer -->
    <div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <form id="editQna" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit  Question</h5>
                    <button id="addEditAnswer" class="ml-5 btn btn-info">Add Answer</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                    <div class="modal-body editModalAnswer">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="question_id" id="question_id" >
                                <input type="text" class="w-100" name="question" placeholder="Enter the question" id="question" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <select required name="level_id">
                            <option value="">Select difficulty</option>
                            <option value="1">Easy</option>
                            <option value="2">Medium</option>
                            <option value="3">Hard</option>
                        </select>

                        <span class="editError" style="color:red;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">edit Question</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- end of edit the answer -->

    <script>
 document.addEventListener('DOMContentLoaded', function()
 {
    // Form values inserting
    document.querySelector("#addquestion").addEventListener("submit", function(e) {
        e.preventDefault();
        if (document.querySelectorAll(".answers").length < 2) {
            showError("Please add minimum 2 answers");
        } else {
            var checkisCorrect = false;
            var isCorrectRadio = document.querySelectorAll(".is_correct");
            for (let i = 0; i < isCorrectRadio.length; i++) {
                if (isCorrectRadio[i].checked) {
                    checkisCorrect = true;
                    isCorrectRadio[i].value = isCorrectRadio[i].nextElementSibling.querySelector('input').value;
                }
            }
            if (checkisCorrect) {
                var formData = new FormData(this);
                fetch("{{ route('addQna') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: formData
                    })
                    .then(function(response) {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Request failed.');
                        }
                    })
                    .then(function(data) {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(function(error) {
                        alert('Request failed. Please try again later.');
                    });
            } else {
                showError("Please select any answer");
            }
        }
    });




    // Add answer
    document.querySelector("#addAnswer").addEventListener("click", function() {
        var answers = document.querySelectorAll(".answers");
        if (answers.length > 6) {
            showError("Add maximum 6, minimum 2 answers");
        } else {
            var count = 4;
            var html = `
                <div class="row d-inline mt-2 answers">
                    ${count++}
                    <input type="radio" name="is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>
            `;
            document.querySelector(".addModalAnswer").insertAdjacentHTML('beforeend', html);
        }
    });

    // Delete
    document.addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("removeButton")) {
            e.target.parentNode.remove();
        }
    });

    // Show answer on modal tables
    var ansButtons = document.querySelectorAll(".ansButton");
    ansButtons.forEach(function(button) {
        button.addEventListener("mouseover", function() {
            var questions = @json($questions);
            var id = this.getAttribute('data-id');
            var html = '';

            for (let i = 0; i < questions.length; i++) {
                if (id == questions[i]['id']) {
                    let answerLen = questions[i]['answer'].length;
                    for (let j = 0; j < answerLen; j++) {
                        let is_correct = 'NO';
                        if (questions[i]['answer'][j]['is_correct'] == 1) {
                            is_correct = "Yes";
                        }
                        html += '<tr>' +
                            '<td>' + (j + 1) + '</td>' +
                            '<td>' + questions[i]['answer'][j]['answer'] + '</td>' +
                            '<td>' + is_correct + '</td>' +
                            '</tr>';
                    }
                }
            }
            document.querySelector(".showAnswers").innerHTML = html;
        });
    });

    // Edit and update qns
    document.querySelector("#addEditAnswer").addEventListener("click", function() {
        var editAnswers = document.querySelectorAll(".editAnswers");
        if (editAnswers.length > 6) {
            showError("Add maximum 6, minimum 2 answers");
        } else {
            var html = `
                <div class="row d-inline mt-2 editAnswers">
                    <input type="radio" name="edit_is_correct" class="is_correct p-2">
                    <div class="col d-flex">
                        <input type="text" class="w-100 p-2" name="new_answers[]" placeholder="Enter answer" required>
                        <button btn class="p-2 btn btn-danger removeButton removeAnswer">Remove</button>
                    </div>
                </div>
            `;
            document.querySelector(".editModalAnswer").insertAdjacentHTML('beforeend', html);
        }
    });

    document.querySelectorAll(".editButton").forEach(function(button) {
        button.addEventListener("click", function() {
            var qid = this.getAttribute('data-id');
            fetch("{{route('getQnaDetail')}}?qid=" + qid)
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Request failed.');
                    }
                })
                .then(function(data) {
                    var qna = data.data[0];
                    document.querySelector("#question_id").value = qna['id'];
                    document.querySelector("#question").value = qna['question'];
                    document.querySelector("select[name='level_id']").value = qna['level_id'];
                    document.querySelectorAll('.editAnswers').forEach(function(answer) {
                        answer.remove();
                    });
                    var html = '';
                    for (let i = 0; i < qna['answer'].length; i++) {
                        var checked = '';
                        if (qna['answer'][i]['is_correct'] == 1) {
                            checked = "checked";
                        }
                        html += `<div class="row d-inline mt-2 editAnswers">
                            <input type="radio" name="edit_is_correct" class="edit_is_correct p-2" ${checked}>
                            <div class="col d-flex">
                                <input type="text" class="w-100 p-2" name="answers[${qna['answer'][i]['id']}]" placeholder="Enter answer" required value="${qna['answer'][i]['answer']}">
                                <button btn class="p-2 btn btn-danger removeButton removeAnswer" data-id="${qna['answer'][i]['id']}">Remove</button>
                            </div>
                        </div>`;
                    }
                    document.querySelector(".editModalAnswer").insertAdjacentHTML('beforeend', html);
                })
                .catch(function(error) {
                    alert('Request failed. Please try again later.');
                });
        });
    });

    // Updating values inserting
    document.querySelector("#editQna").addEventListener("submit", function(e) {
        e.preventDefault();

        if (document.querySelectorAll(".editAnswers").length < 1) {
            showError("Please add minimum 2 answers");
        } else {
            var checkisCorrect = false;
            var editIsCorrectRadio = document.querySelectorAll(".edit_is_correct");
            for (let i = 0; i < editIsCorrectRadio.length; i++) {
                if (editIsCorrectRadio[i].checked) {
                    checkisCorrect = true;
                    editIsCorrectRadio[i].value = editIsCorrectRadio[i].nextElementSibling.querySelector('input').value;
                }
            }
            if (checkisCorrect) {
                var formData = new FormData(this);
                fetch("{{ route('updateQna') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: formData
                    })
                    .then(function(response) {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Request failed.');
                        }
                    })
                    .then(function(data) {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(function(error) {
                        alert('Request failed. Please try again later.');
                    });
            } else {
                showError("Please select any answer");
            }
        }
    });

    // Error message
    function showError(msg) {
        var errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger';
        errorDiv.appendChild(document.createTextNode(msg));
        var card = document.querySelector('.card-body');
        var form = document.querySelector('#addquestion');
        card.insertBefore(errorDiv, form);
        setTimeout(clearError, 3000);
    }

    // Clear error
    function clearError() {
        document.querySelector('.alert').remove();
    }

    // deleting the question
    
});

</script>
@endsection
