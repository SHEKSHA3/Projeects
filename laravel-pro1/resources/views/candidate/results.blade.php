@extends('layout.candidate-layout')

@section('fillspace')
<div class="container">
    <div class="row">
        @foreach ($res as $result)
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Exam Results
                </div>
                <div class="card-body">
                    <div class="mb-3">
                       
                    </div>
                    <div class="mb-3">
                        <p class="mb-0"><strong>Exam ID:</strong> {{ $result->exam_id }}</p>
                        <h4>Exam Details</h4>
                        <p><strong>Exam Name:</strong> {{ $result->exam[0]->exam_name }}</p>
                        <p><strong>Subject ID:</strong> {{ $result->exam[0]->subject_id }}</p>
                        <p><strong>Date:</strong> {{ $result->exam[0]->date }}</p>
                        <p><strong>Time:</strong> {{ $result->exam[0]->time }}</p>
                        <p class="mb-0"><strong>Marks:</strong> {{ $result->marks }}</p>
                        @if ($result->marks >= (($result['exam'][0]['question'])*($result['exam'][0]['passing_percentage'])/(100)))
                            <p class="text-success">&#x2705;Pass</p>
                        @else
                            <p class="text-danger">&#x274C;Fail</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    console.log((@json($res)));
</script>
@endsection
