@extends('layouts.master')
@section('title') @lang('translation.Product_Detail') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Assets @endslot
@slot('title')Asset Detail @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="product-detai-imgs">
                            <div class="row">
                                <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <div class="img-fluid mx-auto d-block">
                                                    {!! QrCode::size(225)->generate($property->property_number) !!}
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="mt-4 mt-xl-3">
                            
                            <h5 class="mt-1 mb-3">Propert Number</h5>
                            <p class="text-muted sm-4">{{ $property->property_number }}</p>
                            <h5 class="mt-1 mb-3">Serial Number</h5>
                            <p class="text-muted sm-4">{{ $property->serial_number }}</p>
                            <h5 class="mt-1 mb-3">Description</h5>
                            <p class="text-muted sm-4">{{ $property->description }}</p>
                            <h5 class="mt-1 mb-3">Category</h5>
                            <p class="text-muted sm-4">{{ $categories->find($property->category_id)?->category_name }}</p>
                            <h5 class="mt-1 mb-3">Office</h5>
                            <p class="text-muted sm-4">{{ $offices->find($property->office_id)?->office_name }}</p>    
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="mt-4 mt-xl-3">    
                        <h5 class="mt-1 mb-3">Status</h5>
                            <p class="text-muted sm-4">{{ $statuses->find($property->status_id)?->status_name }}</p>
                            <h5 class="mt-1 mb-3">User</h5>
                            <p class="text-muted sm-4">{{ $employees->find($property->employee_id)?->employee_name }}</p>
                            <h5 class="mt-1 mb-3">Date Purchased</h5>
                            <p class="text-muted sm-4">{{ $property->date_purchase }}</p>
                            <h5 class="mt-1 mb-3">Acquisition Cost</h5>
                            <p class="text-muted sm-4">₱{{ number_format($property->acquisition_cost, 2) }}</p>
                            <h5 class="mt-1 mb-3">Inventory Remarks</h5>
                            <p class="text-muted sm-4">{{ $property->inventory_remarks }}</p>
                        </div>
                    </div>
                </div>
            </div>
                <!-- end row -->
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
