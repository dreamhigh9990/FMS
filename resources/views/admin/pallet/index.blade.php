@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        {{-- <div class="card-header">
            <div class="card-title">
                <span class="card-icon svg-icon menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <rect fill="#fff" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                            <path
                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                fill="#fff" opacity="1"></path>
                        </g>
                    </svg>
                </span>
                <h3 class="card-label">Pallet</h3>
            </div>
        </div> --}}
        <div class="card-body" style="height: 80vh;">
            @include('admin.partials._messages')

            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab"
                        aria-controls="ex1-tabs-1" aria-selected="true">Pallet Overview</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab"
                        aria-controls="ex1-tabs-2" aria-selected="false">Outstanding</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab"
                        aria-controls="ex1-tabs-3" aria-selected="false">Transaction</a>
                </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                {{-- Pallet DashBoard --}}
                <div class="tab-pane fade" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <div class="row m-0 mt-7">
                        <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class="text-dark-65 d-block my-2">
                                <h1>12</h1>
                            </span>
                            <a href="#" class="text-warning font-weight-bold font-size-h6">CHEP Outstanding</a>
                        </div>
                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7  mb-7">
                            <span class=" text-dark-65 d-block my-2">
                                <h2>7</h2>
                            </span>
                            <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">Loscam Outstanding</a>
                        </div>

                        <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">
                            <span class=" text-dark-65 d-block my-2">
                                <h2>15</h2>
                            </span>
                            <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">CEHP on Hand</a>
                        </div>
                        <div class="col bg-light-success px-6 py-8 rounded-xl mb-7">
                            <span class=" text-dark-65 d-block my-2">
                                <h2>5</h2>
                            </span>
                            <a href="#" class="text-success font-weight-bold font-size-h6 mt-2">Loscam on Hand</a>
                        </div>
                    </div>
                </div>


                {{-- Outstanding --}}
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    @include('admin.pallet.outstanding')
                </div>

                {{-- Transaction --}}
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    @include('admin.pallet.transaction')
                </div>
            </div>
            <!-- Tabs content -->

        </div>
        <!-- Modal-->

    </div>
    <!--end::Card-->
@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->

    @include('admin.pallet.outstanding_script')

    @include('admin.pallet.transaction_script')

    <script>
        $(document).ready(function() {
            $('#ex1-tabs-1').tab('show');
            $(".nav-tabs a").click(function() {
                $(this).tab('show');
            });
        });
    </script>
@endsection
