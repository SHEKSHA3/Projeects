<!DOCTYPE html>
<html>
<head>
    <style>
        body, html {
            height: 100vh;
            margin: 0;
            padding: 0;
            font-size:20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .question-card {
            width: 100%;
            max-width: 600px;
            background-color: #f0f0f0;
            padding: 20px;
            margin-bottom: 20px;
            box-sizing: border-box;
            display: none;
            border-radius: 10px;
        }

        .question-card.active {
            display: block;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        /* Circular Timer Styling */
        .timer-container {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .timer {
            position: relative;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            transform: rotate(3600deg);
        }

        .timer .fill {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #39c;
            border-radius: 50%;
        }

        .timer .mask {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            clip: rect(0px, 200px, 200px, 100px);
        }

        .timer .fill,
        .timer .mask {
            transition: all 1s;
       }

       .navigation-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .navigation-buttons button {
        padding: 10px 20px;
        font-size: 20px;
        background-color: #39c;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .navigation-buttons button:hover {
        background-color: #2978b5;
    }

        .timer .time {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="timer-container">
        <div class="timer">
            <div class="fill"></div>
            <div class="mask"></div>
            <div class="time" id="timer"></div>
        </div>
    </div>
    <form method="POST" action="{{ route('examresult') }}" id="form">
    @csrf
    <div class="container">
        <div id="page-info">
            <span id="current-page">1</span> / <span id="total-pages">{{ count($values) }}</span>
        </div>
        @php $count = 1;$countquestion=1; @endphp
        @foreach($values as $qna)
        <div class="question-card active">
            <h2>Question {{ $count }}</h2>
            <p>{{ $qna->question }}</p>
            @foreach($qna['answer'] as $ans)
            <label>
            {{ $countquestion++ }}
                <input type="radio" name="answer[{{ $qna->id }}]" value="{{ $ans->id }}">
                {{ $ans->answer }}
            </label><br>
            @endforeach
            @php $countquestion=1;@endphp
            <div class="navigation-buttons">
                <button type="button" onclick="previousQuestion()">Previous</button>
                <button type="button" onclick="nextQuestion()">Next</button>
            </div>
        </div>
        @php $count++; @endphp
        @endforeach

        <button onclick="submitForm()" class="btn btn-danger" id="alerting" type="submit">End Exam</button>
        <input type="hidden" name="candidate_id" id="candidateId" value="">
        <input type="hidden" name="exam_id" id="examId" value="">
    </div>
</form>



<script>
    let candidateId = @json($candidate_id);
    let examId = @json($exam_id);
    let exam=@json($exam);
    const time=exam[0]['time'];
    const parts = time.split(':');
    const minutes = parseInt(parts[0]) * 60 + parseInt(parts[1]);

    document.getElementById('candidateId').value = candidateId;
    document.getElementById('examId').value = examId;

    let currentQuestion = 0;
    const questionCards = document.querySelectorAll('.question-card');
    let selectedAnswers = {};

    const currentPageElement = document.getElementById('current-page');
    const totalQuestions = questionCards.length;
    const totalQuestionsElement = document.getElementById('total-pages');
    totalQuestionsElement.textContent = totalQuestions;

    function showQuestion(index) {
        questionCards.forEach(card => {
            card.classList.remove('active');
        });

        questionCards[index].classList.add('active');
        currentPageElement.textContent = index + 1;
    }

    function nextQuestion() {
        if (currentQuestion < questionCards.length - 1) {
            saveSelectedAnswer(currentQuestion);
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    }

    function previousQuestion() {
        if (currentQuestion > 0) {
            saveSelectedAnswer(currentQuestion);
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    }

    function saveSelectedAnswer(index) {
        const questionCard = questionCards[index];
        const selectedRadioButton = questionCard.querySelector('input[type="radio"]:checked');

        if (selectedRadioButton) {
            const questionId = selectedRadioButton.name;
            const answerId = selectedRadioButton.value;
            selectedAnswers[questionId] = answerId;
        }
    }

    function submitForm() {
        // alert("are you sure you want to end this exam");
        saveSelectedAnswer(currentQuestion);
        console.log(selectedAnswers);
    }

    showQuestion(0);

    // Timer Functionality
    const timerElement = document.getElementById('timer');
    const totalTime = minutes; 
    let timeRemaining = totalTime;

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
    }
    function updateTimer() {
  const fillElement = document.querySelector('.timer .fill');
  const maskElement = document.querySelector('.timer .mask');
  const elapsedSeconds = totalTime - timeRemaining;
  const progress = (elapsedSeconds / totalTime) * 100;

  fillElement.style.transform = `rotate(${progress}deg)`;
  maskElement.style.transform = `rotate(${progress}deg)`;

  timerElement.textContent = formatTime(timeRemaining);

  if (timeRemaining <= 0) {
    clearInterval(timerInterval);
    submitForm(); // Submit the form
    document.getElementById('form').submit(); 
    return; // Exit the function to prevent further countdown
  }

  timeRemaining--;
}

const timerInterval = setInterval(updateTimer, 1000);

</script>
</body>
</html>
