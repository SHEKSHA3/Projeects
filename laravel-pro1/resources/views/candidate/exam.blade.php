@extends('layout.candidate-layout')

@section('fillspace')
<style>
    .disabled-link {
  pointer-events: none;
  opacity: 0.6;
  cursor: not-allowed;
}

</style>
<h1>Hi {{Auth::user()->name}}</h1>
<div class="row">
    @foreach ($testshow as $test)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exam Details</h5>
                    <p class="card-text"><strong>Test Name:</strong> {{ $test->exam[0]['exam_name'] }}</p>
                    <p class="card-text"><strong>candidate ID:</strong> {{ $test->student_id }}</p>
                    <p class="card-text"><strong>candidate Email:</strong> {{ $test->candidate [0]['email']}}</p>
                    <p><strong>Exam Date:</strong>{{$test->exam[0]['date']}}</p>
                    <p><strong>Exam Date:</strong> {{$test->exam[0]['date']}}</p>
                    @if(strtotime(date('Y-m-d')) <= strtotime($test->exam[0]['date']))
                        <a href="{{ route('startExam', ['id' => $test->exam_id]) }}" class="btn btn-primary float-right" name="id">Start</a>
                    @else
                        <a href="{{ route('startExam', ['id' => $test->exam_id]) }}" class="btn btn-primary float-right disabled-link" name="id">Start</a>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
</div>



<script>
console.log(@json($testshow))   
    

</script>

@endsection
