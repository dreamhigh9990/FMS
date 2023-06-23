@extends('admin.layouts.master')
@section('title',$title)
@section('content')
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Dashboard-->
			<!--begin::Row-->
{{--            <div class="row">--}}
{{--                <div class="col-lg-7">--}}
{{--                    <!--begin::Mixed Widget 1-->--}}
{{--                    <div class="card card-custom bg-gray-100 card-stretch gutter-b">--}}
{{--                        <!--begin::Header-->--}}
{{--                        <!--end::Header-->--}}
{{--                        <!--begin::Body-->--}}
{{--                        <div class="card-body">--}}
{{--                            <!--begin::Chart-->--}}
{{--                            <div class="card-rounded-bottom bg-danger" style="height: 200px; min-height: 200px;"></div>--}}
{{--                            <!--end::Chart-->--}}
{{--                            <!--begin::Stats-->--}}
{{--                            <div class="card-spacer mt-5">--}}
{{--                                <!--begin::Row-->--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--													<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
{{--																		<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>--}}
{{--																		<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                        <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-primary font-weight-bold font-size-h6">Manage Customers</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                                        <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--                                                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>--}}
{{--                                                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"/>--}}
{{--                                                                    </g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Add new job</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-secondary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                                                        <rect x="0" y="0" width="24" height="24"/>--}}
{{--                                                                        <rect fill="#000000" opacity="0.3" x="11.5" y="2" width="2" height="4" rx="1"/>--}}
{{--                                                                        <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>--}}
{{--                                                                        <path d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"/>--}}
{{--                                                                    </g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Manage freights</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-dark px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Manage Manifest</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-secondary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-dark px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-secondary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col bg-light-dark px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<rect x="0" y="0" width="24" height="24"></rect>--}}
{{--																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
{{--																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <!--end::Stats-->--}}
{{--                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 414px; height: 462px;"></div></div><div class="contract-trigger"></div></div></div>--}}
{{--                        <!--end::Body-->--}}
{{--                    </div>--}}
{{--                    <!--end::Mixed Widget 1-->--}}
{{--                </div>--}}
{{--            </div>--}}
			<!--end::Row-->
			<!--end::Dashboard-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
@endsection
