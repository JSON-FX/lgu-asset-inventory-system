    @extends('layouts.master')
@section('title') @lang('translation.Basic_Elements')  @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Basic Elements @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Textual inputs</h4>
                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
            </div>
            
            <form action="{{ route('asset.store') }}" method="POST" class="bg-gray-900 p-6 rounded-lg">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Text</label>
                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-search-input" class="form-label">Search</label>
                                <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-email-input" class="form-label">Email</label>
                                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-url-input" class="form-label">URL</label>
                                <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-tel-input" class="form-label">Telephone</label>
                                <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-password-input" class="form-label">Password</label>
                                <input class="form-control" type="password" value="hunter2" id="example-password-input">
                            </div>
                            <div class="mb-3">
                                <label for="example-number-input" class="form-label">Number</label>
                                <input class="form-control" type="number" value="42" id="example-number-input">
                            </div>
                            <div>
                                <label for="example-datetime-local-input" class="form-label">Date and time</label>
                                <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="example-datetime-local-input">
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mt-3 mt-lg-0">
                            <div class="mb-3">
                                <label for="example-date-input" class="form-label">Purchase Date</label>
                                <input class="form-control" type="date" value="" id="example-date-input">
                            </div>
    
                        
                    
                            
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select">
                                    <option>Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="exampleDataList" class="form-label">User List</label>
                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                <datalist id="datalistOptions">
                                    <option value="San Francisco">
                                    <option value="New York">
                                    <option value="Seattle">
                                    <option value="Los Angeles">
                                    <option value="Chicago">
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
