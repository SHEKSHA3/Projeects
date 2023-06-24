@extends('layout.admin-layout')

@section('fillspace')
<div class="container">
    <form action="/submit" method="POST">
        @csrf
        <div>
            @foreach($questions as $index => $question)
                <p>Question {{$index+1}}: {{$question['question']}}</p>
                <ul style="list-style-type: none;">
                    @foreach($question['answer'] as $answer)
                        <li>
                            <label>
                                <input type="radio" name="answers[{{$question['id']}}]" value="{{$answer['id']}}">
                                {{$answer['answer']}}
                            </label>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script>
    // see the formated way of the question that are generated
    // var questions = @json($questions);
    // for(let i=0;i<questions.length;i++){
    //     console.log(questions[i]['id'],questions[i]['question']);
    // }


    // Assuming you have a JavaScript function to handle the fm submission
    //
    const form = document.querySelector('form');
    form.addEventListener('submit', handleSubmit);

    function handleSubmit(event) {
        event.preventDefault();

        // Retrieve the selected answers from the form
        const formData = new FormData(event.target);
        const selectedAnswers = {};
        for (const [questionId, answerId] of formData.entries()) {
            selectedAnswers[questionId] = answerId;
        }

        // Compare the selected answers with the correct answers
        const results = [];
        @foreach($questions as $index => $question)
        {
            const questionId = {{$question['id']}};
            const correctAnswerId = {{$question['answer'][0]['id']}};
            const selectedAnswerId = selectedAnswers[questionId];

            const result = {
                question: 'Question {{$index+1}}: {{$question['question']}}',
                selectedAnswer: '{{$question['answer']->firstWhere('id', $question['answer'][0]['id'])['answer']}}',
                correctAnswer: '{{$question['answer']->firstWhere('id', $question['answer'][0]['id'])['answer']}}',
                isCorrect: selectedAnswerId == correctAnswerId
            };
            results.push(result);
        }
        @endforeach

        // Display the results
        results.forEach(result => {
            console.log('Question:', result.question);
            console.log('Selected Answer:', result.selectedAnswer);
            console.log('Correct Answer:', result.correctAnswer);
            console.log('Is Correct:', result.isCorrect);
        });

        // Submit the form to the server
        // You can send the results to the server for storage or further processing here
        // For example, using the Fetch API to make a POST request to the server
        fetch('/store-results', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(results),
        })
            .then(response => {
                if (response.ok) {
                    console.log('Results stored successfully.');
                } else {
                    console.log('Error storing results:', response.status);
                }
            })
            .catch(error => {
                console.log('Error storing results:', error);
            });
    }
</script>
</body>
</html>
