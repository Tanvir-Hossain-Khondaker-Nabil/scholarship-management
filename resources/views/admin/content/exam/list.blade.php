@extends('admin.layouts.layoutMaster')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $title ?? 'N/A' }} /</span> {{ $sub_title ?? 'N/A' }}
</h4>
<!-- Bootstrap Table with Header - Light -->
<div class="card">
    <h5 class="card-header">{{ $header ?? 'N/A' }}</h5>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Remiding</th>
                    <th>Students</th>
                    <th>Result</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($exams as $exam)
                <tr>
                    <td><strong>{{ ++$loop->index }}</strong></td>
                    <td>{{ $exam->name }}</td>
                    <td>{{ $exam->exam_date }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($exam->exam_time)->format('g:i A') }}
                    <td>
                        {{ \Carbon\Carbon::parse($exam->exam_date)->diffForHumans() }}
                    </td>
                    <td>{{ $exam->students->count() }}</td>
                    <td>
                        @if ($exam->result_publish)
                        <span class="badge bg-label-success me-1">Publish</span>
                        @else
                        <span class="badge bg-label-danger me-1">Not Publish</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('exams.edit',$exam->id) }}"><i
                                        class="ti ti-pencil me-1"></i>
                                    Edit</a>
                                <a class="dropdown-item" href="{{ route('student.exam',$exam->id) }}"><i
                                        class="ti ti-pencil me-1"></i>
                                    Exam Assign</a>
                                @if ($exam->result_publish)
                                <a class="dropdown-item" href="{{ route('exam.result.publish',$exam->id) }}"><i
                                        class="ti ti-pencil me-1"></i>
                                    Result Unpublish</a>
                                @else
                                <a class="dropdown-item" href="{{ route('exam.result.publish',$exam->id) }}"><i
                                        class="ti ti-pencil me-1"></i>
                                    Result Publish</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('student.result.download',$exam->id) }}"><i
                                        class="ti ti-pencil me-1"></i>
                                    Result Download</a>

                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="$('#logout-form').submit();"><i class="ti ti-trash me-1"></i>
                                    Delete</a>
                                <form id="logout-form" action="{{ route('exams.destroy',$exam->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No Data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    {{ $exams->links() }}
</div>
<!-- Bootstrap Table with Header - Light -->

@endsection