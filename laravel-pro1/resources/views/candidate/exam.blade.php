@extends('layout.candidate-layout')

@section('fillspace')

<h1>Hello candidate</h1>
<div class="row">
    @foreach ($testshow as $test)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exam Details</h5>
                    <p class="card-text"><strong>candidate ID:</strong> {{ $test->student_id }}</p>
                    <p class="card-text"><strong>Test ID:</strong> {{ $test->exam_id }}</p>
                   
                    <a href="{{ route('startExam', ['id' => $test->exam_id]) }}" class="btn btn-primary float-right" name="id" >Start</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


<script>
console.log(@json($testshow))   
    

</script>

@endsection
