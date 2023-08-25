@extends('admin.layouts.layoutMaster')

@section('title', 'Create Isntitute')

@section('page-script')
<script src="{{asset('assets/js/form-validation.js')}}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-between my-2">
    <h4 class="fw-bold">
        @if ((@$sponsor) ? @$sponsor : @$data)
        <span class="text-muted fw-light">{{ $title ?? 'N/A' }} /</span> {{ $sub_title ?? 'N/A' }}
        @endif
    </h4>
    <a href="{{route('sponsor.index')}}"> <button class=" btn btn-primary">➥ List</button></a>
</div>
<div class="row">
    <!-- FormValidation -->
    <div class="col-12">
        <div class="card mb-4">
            @if ((@$sponsor) ? @$sponsor : @$data)
            <div class="card-header d-flex justify-content-between align-items-center">
                @if(isset($sponsor))
                <h5 class="mb-0">Edit Sponsor</h5>
                @else
                <h5 class="mb-0">Create Sponsor</h5>
                @endif
                <small class="text-muted float-end">Default label</small>
            </div>
            @endif
            <div class="card-body">
                @if ((@$sponsor) ? @$sponsor : @$data)
                <form method="post" action="{{(@$sponsor) ? route('sponsor.update',$sponsor->id) : route('sponsor.store')}}"  enctype="multipart/form-data">
                    @csrf

                    @if(isset($sponsor))
                    @method('put')
                    @endif

                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload First Image <code>*</code></label>
                                <input type="file" class="form-control" name="1"/>
                                @error('1')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Second Image <code>*</code></label>
                                <input type="file" class="form-control" name="2" placeholder="Enter Sponsor Name"" />
                                @error('2')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Third Image <code>*</code></label>
                                <input type="file" class="form-control" name="3"/>
                                @error('3')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Fourth Image <code>*</code></label>
                                <input type="file" class="form-control" name="4" placeholder="Enter Sponsor Name"" />
                                @error('4')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Fifth Image <code>*</code></label>
                                <input type="file" class="form-control" name="5"/>
                                @error('5')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Sixth Image <code>*</code></label>
                                <input type="file" class="form-control" name="6" placeholder="Enter Sponsor Name"" />
                                @error('6')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Seventh Image <code>*</code></label>
                                <input type="file" class="form-control" name="7"/>
                                @error('7')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label class="form-label" for="name">Upload Eigth Image <code>*</code></label>
                                <input type="file" class="form-control" name="8" placeholder="Enter Sponsor Name"" />
                                @error('8')
                                <code>*{{$message}}</code>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    

                    
                    <button type="submit" class="btn btn-primary">
                        {{(@$sponsor)?'Update':'Submit'}}
                    </button>
                </form>
                @endif @if (isset($already_created))
                <div class="mt-4 mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75"
                        fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div class="text-center mt-5 mb-4">
                <h1>{{ $already_created['title'] }}</h1>
                <p>{{ $already_created['sub_title'] }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /FormValidation -->
</div>
@endsection