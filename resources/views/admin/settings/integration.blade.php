@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Integration</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                {{-- <a href="" class="text-muted">CMS Setting</a> --}}
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    {{-- <div class="card-header" style="">
						<div class="card-title">
							<h3 class="card-label">Integrations
								<i class="mr-2"></i>
                            </h3>
						</div>
					</div> --}}
                    <div class="card-body p-0">
                        @include('admin.partials._messages')
                        <!--begin::Form-->
                        @csrf
                        <div class="card card-custom" style="height: 70vh;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="alert alert-danger" role="alert">
                                        {{ $xero }}
                                      </div>
                                </div>


                                <div class="row m-0 mt-7">
                                    <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7 integ-icon"
                                        id="sso_btn">
                                        <div class="text-dark-65 d-block my-2" style="width:100px; height:100px;">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 291.346 291.346"
                                                style="enable-background:new 0 0 291.346 291.346;" xml:space="preserve">
                                                <g>
                                                    <path style="fill:#26A6D1;"
                                                        d="M117.547,266.156L0,249.141v-94.296h117.547V266.156z" />
                                                    <path style="fill:#3DB39E;"
                                                        d="M291.346,136.51H136.31l0.055-114.06L291.346,0.009V136.51z" />
                                                    <path style="fill:#F4B459;"
                                                        d="M291.346,291.337l-155.091-22.459l0.182-114.015h154.909V291.337z" />
                                                    <path style="fill:#E2574C;"
                                                        d="M117.547,136.51H0V42.205l117.547-17.024V136.51z" />
                                                </g>
                                            </svg>
                                        </div>
                                        <h4>
                                            <a href="#" class="text-warning font-weight-bold">SSO(Microsoft 365)</a>
                                        </h4>
                                    </div>

                                    <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7  mb-7 integ-icon"
                                        id="xero_btn">
                                        <span class="text-dark-65 d-block my-2" style="width:100px; height:100px;">
                                            <svg width="100px" height="100px" viewBox="0 0 256 256" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid">
                                                <g>
                                                    <path
                                                        d="M128.00285,256 C198.693118,256 256,198.688775 256,128 C256,57.2998444 198.698818,0 128.00285,0 C57.3068822,0 0,57.2998444 0,128 C0,198.688775 57.3068822,256 128.00285,256"
                                                        fill="#1FC0E7"></path>
                                                    <path
                                                        d="M62.3672889,127.967763 L84.1671111,106.065541 C84.8896,105.337363 85.2935111,104.358874 85.2935111,103.323496 C85.2935111,101.161719 83.5413333,99.4095407 81.3852444,99.4095407 C80.3328,99.4095407 79.3486222,99.8191407 78.6090667,100.575763 L56.8206222,122.381274 L34.9468444,100.535941 C34.2072889,99.807763 33.2288,99.4095407 32.1877333,99.4095407 C30.0259556,99.4095407 28.2794667,101.161719 28.2794667,103.317807 C28.2794667,104.370252 28.7004444,105.365807 29.4513778,106.105363 L51.2512,127.93363 L29.4627556,149.778963 C28.7004444,150.541274 28.2794667,151.531141 28.2794667,152.583585 C28.2794667,154.745363 30.0316444,156.497541 32.1877333,156.497541 C33.2288,156.497541 34.2072889,156.099319 34.9468444,155.359763 L56.7921778,133.503052 L78.5521778,155.27443 C79.3258667,156.070874 80.3157333,156.497541 81.3852444,156.497541 C83.5356444,156.497541 85.2878222,154.745363 85.2878222,152.583585 C85.2878222,151.542519 84.8896,150.56403 84.1500444,149.824474 L62.3616,127.945007 L62.3672889,127.967763 Z M191.965867,127.962074 C191.965867,131.887407 195.151644,135.073185 199.076978,135.073185 C202.979556,135.073185 206.165333,131.887407 206.165333,127.962074 C206.165333,124.036741 202.979556,120.850963 199.071289,120.850963 C195.163022,120.850963 191.982933,124.036741 191.982933,127.962074 L191.965867,127.962074 Z M178.511644,127.962074 C178.511644,116.612741 187.727644,107.368296 199.071289,107.368296 C210.392178,107.368296 219.625244,116.612741 219.625244,127.962074 C219.625244,139.311407 210.397867,148.555852 199.071289,148.555852 C187.733333,148.555852 178.511644,139.322785 178.511644,127.962074 L178.511644,127.962074 Z M170.422044,127.962074 C170.422044,143.777185 183.278933,156.65683 199.071289,156.65683 C214.863644,156.65683 227.720533,143.788563 227.720533,127.967763 C227.720533,112.152652 214.863644,99.2730074 199.071289,99.2730074 C183.273244,99.2730074 170.422044,112.146963 170.422044,127.967763 L170.422044,127.962074 Z M168.391111,99.7622519 L167.196444,99.7622519 C163.584,99.7622519 160.1024,100.90003 157.195378,103.147141 C156.797156,101.406341 155.227022,100.075141 153.361067,100.075141 C151.216356,100.075141 149.492622,101.810252 149.492622,103.966341 L149.504,152.293452 C149.504,154.438163 151.267556,156.184652 153.400889,156.184652 C155.551289,156.184652 157.303467,154.438163 157.309156,152.282074 L157.309156,122.563319 C157.309156,112.664652 158.219378,108.659674 166.684444,107.601541 C167.480889,107.50483 168.322844,107.521896 168.334222,107.521896 C170.643911,107.436563 172.293689,105.837985 172.293689,103.681896 C172.293689,101.520119 170.530133,99.7679407 168.368356,99.7679407 L168.391111,99.7622519 Z M93.3774222,123.245985 C93.3774222,123.132207 93.3888,123.01843 93.3944889,122.91603 C95.6586667,113.927585 103.7824,107.288652 113.447822,107.288652 C123.232711,107.288652 131.424711,114.081185 133.586489,123.228919 L93.3717333,123.228919 L93.3774222,123.245985 Z M141.579378,122.50643 C139.895467,114.524919 135.532089,107.96563 128.893156,103.755852 C119.176533,97.5777185 106.353778,97.9190519 96.9784889,104.609185 C89.3212444,110.053452 84.9009778,118.97363 84.9009778,128.161185 C84.9009778,130.465185 85.1854222,132.791941 85.7543111,135.084563 C88.6442667,146.462341 98.4177778,155.086696 110.068622,156.514607 C113.527467,156.935585 116.895289,156.742163 120.365511,155.831941 C123.369244,155.092385 126.264889,153.886341 128.932978,152.168296 C131.703467,150.387674 134.018844,148.032474 136.271644,145.216474 C136.305778,145.159585 136.351289,145.119763 136.3968,145.062874 C137.955556,143.128652 137.665422,140.363852 135.958756,139.055407 C134.513778,137.946074 132.090311,137.496652 130.190222,139.942874 C129.780622,140.534519 129.319822,141.137541 128.824889,141.734874 C127.305956,143.413096 125.422933,145.03443 123.170133,146.297363 C120.291556,147.833363 117.026133,148.703763 113.555911,148.726519 C102.189511,148.595674 96.1137778,140.648296 93.9463111,134.982163 C93.5708444,133.918341 93.2807111,132.820385 93.0759111,131.682607 L93.0190222,131.085274 L133.808356,131.085274 C139.394844,130.960119 142.398578,127.006341 141.568,122.495052 L141.579378,122.50643 Z"
                                                        fill="#FFFFFF"></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <h4>
                                            <a href="#" class="text-primary font-weight-bold mt-2">Xero</a>
                                        </h4>
                                    </div>

                                    <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7 mb-7 integ-icon"
                                        id="smtp_btn">
                                        <span class="text-dark-65 d-block my-2" style="width:100px; height:100px;">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                                xml:space="preserve">
                                                <polygon style="fill:#8AD5DD;" points="0,182.024 256,333.272 0,484.568 " />
                                                <polygon style="fill:#6CB8BC;"
                                                    points="0,182.024 46.184,147.112 46.184,209.296 " />
                                                <polygon style="fill:#8AD5DD;"
                                                    points="512,182.024 256,333.272 512,484.568 " />
                                                <polygon style="fill:#6CB8BC;"
                                                    points="512,182.024 465.816,147.112 465.816,209.296 " />
                                                <polygon style="fill:#9ADEE2;"
                                                    points="256,333.272 256,333.272 256,333.272 256,333.272 256,333.272 0,484.568 256,484.568
                                                        256,484.568 512,484.568 " />
                                                <polygon style="fill:#FFFFFF;"
                                                    points="50.176,207.016 50.176,31.432 461.824,31.432 461.824,207.016 256,328.624 " />
                                                <path style="fill:#E0E0E0;"
                                                    d="M457.816,35.432v169.296L256,323.984L54.184,204.728V35.432H256H457.816 M465.816,27.432H256H46.184
                                                        v181.864L256,333.272l209.816-123.976L465.816,27.432L465.816,27.432z" />
                                                <polygon style="fill:#999999;"
                                                    points="292.048,226.568 256,263.856 219.952,226.568 231.208,215.424 256,241.072 280.792,215.424
                                                        " />
                                                <rect x="89.256" y="72.176" style="fill:#DB2B42;" width="117.952"
                                                    height="99.128" />
                                                <g>
                                                    <circle style="fill:#FFFFFF;" cx="148.24" cy="101.448"
                                                        r="17.448" />
                                                    <path style="fill:#FFFFFF;"
                                                        d="M147.416,159.464l-16.864-36.552c0,0-17.688,0.232-17.688,16.504s0,20.048,0,20.048
                                                            S147.536,159.464,147.416,159.464z" />
                                                    <path style="fill:#FFFFFF;"
                                                        d="M149.064,159.464l16.864-36.552c0,0,17.688,0.232,17.688,16.504s0,20.048,0,20.048
                                                            S148.952,159.464,149.064,159.464z" />
                                                    <polygon style="fill:#FFFFFF;"
                                                        points="148.24,122.912 136.096,122.912 148.24,149.792 160.384,122.912 	" />
                                                </g>
                                                <g>
                                                    <rect x="236.616" y="91.304" style="fill:#999999;"
                                                        width="188.712" height="10.24" />
                                                    <rect x="236.616" y="119.784" style="fill:#999999;"
                                                        width="188.712" height="10.24" />
                                                    <rect x="236.616" y="148.264" style="fill:#999999;"
                                                        width="188.712" height="10.24" />
                                                </g>
                                            </svg>
                                        </span>
                                        <h4>
                                            <a href="#" class="text-danger font-weight-bold mt-2">SMTP</a>
                                        </h4>
                                    </div>

                                    <div class="col bg-light-success px-6 py-8 rounded-xl mb-7 integ-icon" id="sms_btn">
                                        <span class="text-dark-65 d-block my-2" style="width:100px; height:100px;">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 505 505" style="enable-background:new 0 0 505 505;"
                                                xml:space="preserve">
                                                <circle style="fill:#324A5E;" cx="252.5" cy="252.5"
                                                    r="252.5" />
                                                <path style="fill:#FFFFFF;"
                                                    d="M280.8,409.7H102c-4.6,0-8.3-3.7-8.3-8.3V103.6c0-4.6,3.7-8.3,8.3-8.3h178.8c4.6,0,8.3,3.7,8.3,8.3
                                                        v297.8C289.1,406,285.4,409.7,280.8,409.7z" />
                                                <rect x="107.4" y="134.5" style="fill:#54C0EB;" width="168.1"
                                                    height="228.7" />
                                                <g>
                                                    <circle style="fill:#E6E9EE;" cx="191.4" cy="385.7"
                                                        r="11.9" />
                                                    <path style="fill:#E6E9EE;"
                                                        d="M220.6,125.1h-58.4c-1,0-1.8-0.8-1.8-1.8l0,0c0-1,0.8-1.8,1.8-1.8h58.4c1,0,1.8,0.8,1.8,1.8l0,0
                                                            C222.5,124.2,221.7,125.1,220.6,125.1z" />
                                                    <rect x="183.5" y="110.3" style="fill:#E6E9EE;"
                                                        width="15.8" height="3.7" />
                                                </g>
                                                <path style="fill:#FFD05B;"
                                                    d="M383.1,178.5c-37.6-31-98.4-31-136,0c-33,27.2-37,69.3-12.1,100.2l-8.6,29.2l35.4-7.1
                                                        c37.4,20.6,88.3,17.3,121.3-10C420.7,259.8,420.7,209.6,383.1,178.5z" />
                                                <g>
                                                    <path style="fill:#F1543F;"
                                                        d="M281.9,241.1c0,3.3-1.2,6-3.7,8.1c-2.5,2-5.6,3-9.4,3c-2.5,0-5.2-0.5-7.9-1.4
                                                            c-2.7-0.9-5.2-2.2-7.4-4l4.2-5.9c3.5,2.7,7.3,4.1,11.3,4.1c1.2,0,2.2-0.2,2.9-0.7c0.7-0.5,1.1-1.1,1.1-1.9c0-0.8-0.5-1.5-1.5-2.2
                                                            s-2.4-1.3-4.3-1.9c-1.9-0.6-3.3-1.1-4.3-1.5s-2.1-1-3.4-1.8c-2.6-1.6-3.9-4-3.9-7.1s1.3-5.7,3.8-7.7s5.8-3,9.8-3s8,1.3,12,4
                                                            l-3.5,6.3c-2.9-2-5.9-3-8.8-3s-4.4,0.8-4.4,2.4c0,0.9,0.5,1.6,1.4,2.1s2.5,1.1,4.6,1.8s3.7,1.2,4.6,1.5c0.9,0.4,2,0.9,3.3,1.7
                                                            C280.7,235.4,281.9,237.8,281.9,241.1z" />
                                                    <path style="fill:#F1543F;"
                                                        d="M320.3,233.4v18.3h-9.5v-18.6c0-2.7-0.4-4.7-1.2-5.9c-0.8-1.3-2.1-1.9-4-1.9c-1.8,0-3.5,0.7-4.9,2.1
                                                            c-1.4,1.4-2.1,3.4-2.1,6v18.3h-9.5v-34h9.5v3.9c2.6-2.9,5.6-4.4,9-4.4c2.1,0,4.1,0.6,5.8,1.9c1.7,1.3,3.1,2.8,3.9,4.6
                                                            c1.3-2.1,3.1-3.7,5.3-4.8c2.2-1.1,4.4-1.7,6.7-1.7c4,0,7.2,1.2,9.7,3.6c2.4,2.4,3.7,5.8,3.7,10.3v20.6h-9.5v-18.6
                                                            c0-5.2-1.9-7.8-5.7-7.8c-1.9,0-3.5,0.7-4.9,2.1C321,228.7,320.3,230.7,320.3,233.4z" />
                                                    <path style="fill:#F1543F;"
                                                        d="M376.8,241.1c0,3.3-1.2,6-3.7,8.1c-2.5,2-5.6,3-9.4,3c-2.5,0-5.2-0.5-7.9-1.4
                                                            c-2.7-0.9-5.2-2.2-7.4-4l4.2-5.9c3.5,2.7,7.3,4.1,11.3,4.1c1.2,0,2.2-0.2,2.9-0.7c0.7-0.5,1.1-1.1,1.1-1.9c0-0.8-0.5-1.5-1.5-2.2
                                                            s-2.4-1.3-4.3-1.9c-1.9-0.6-3.3-1.1-4.3-1.5s-2.1-1-3.4-1.8c-2.6-1.6-3.9-4-3.9-7.1s1.3-5.7,3.8-7.7s5.8-3,9.8-3s8,1.3,12,4
                                                            l-3.5,6.3c-2.9-2-5.9-3-8.8-3s-4.4,0.8-4.4,2.4c0,0.9,0.5,1.6,1.4,2.1s2.5,1.1,4.6,1.8s3.7,1.2,4.6,1.5c0.9,0.4,2,0.9,3.3,1.7
                                                            C375.6,235.4,376.8,237.8,376.8,241.1z" />
                                                </g>
                                            </svg>
                                        </span>
                                        <h4>
                                            <a href="#"
                                                class="text-success font-weight-bold mt-2">SMS(WholeSale)</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form-->


                        <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg"
                            id="ssoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">SSO(Microsoft 365)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        {{-- <form class="form" id="setting_form" method="POST" action=""
                                            enctype='multipart/form-data'> --}}
                                            <div class="form-group row">
                                                <label class="col-3">App ID</label>
                                                <div class="col-9">
                                                    <input class="form-control"  type="text" name="" placeholder="" value="" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3">Object ID</label>
                                                <div class="col-9">
                                                    <input class="form-control"  type="text" name="" placeholder="" value="" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3">Directory(tenant) ID</label>
                                                <div class="col-9">
                                                    <input class="form-control"  type="text" name="" placeholder="" value="" >
                                                </div>
                                            </div>
                                        {{-- </form> --}}

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary sso_save_btn"
                                            onclick="javascript:void(0);">Save & Close</button>
                                        <button type="button" class="btn btn-primary sso_close_btn"
                                            onclick="javascript:void(0);">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg"
                            id="xeroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xero</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-3">XERO CLIENT ID</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="A535A862C25C4C119B317EEB33333FDB" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">XERO CLIENT SECRET</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="password" name="" placeholder="" value="xxxxxxx" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">XERO REDIRECT URI</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="http://localhost:8000/admin/xero/callback" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">XERO LANDING URL</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary xero_save_btn"
                                            onclick="window.location='{{ URL::route('admin.xero.connect'); }}'">Connect(Auth) To Xero</button>
                                        <button type="button" class="btn btn-primary xero_save_btn"
                                            onclick="javascript:void(0);">Save & Close</button>
                                        <button type="button" class="btn btn-primary xero_close_btn"
                                            onclick="javascript:void(0);">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg"
                            id="smtpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">SMTP</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-3">MAIL DRIVER</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="smtp" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">MAIL HOST</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="wardsgroup-com-au.mail.protection.outlook.com" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary smtp_save_btn"
                                            onclick="javascript:void(0);">Save & Close</button>
                                        <button type="button" class="btn btn-primary smtp_close_btn"
                                            onclick="javascript:void(0);">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div data-backdrop="static" data-keyboard="false" class="modal fade bd-example-modal-lg"
                            id="smsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">SMS(WholeSale)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-3">API KEY</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="text" name="" placeholder="" value="enmVOQAlfaoRiSeOiKY1" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3">API SECRET</label>
                                            <div class="col-9">
                                                <input class="form-control"  type="password" name="" placeholder="" value="i6XhkG2uLl1p5LSOvXOltw816KEALb" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary sms_save_btn"
                                            onclick="javascript:void(0);">Save & Close</button>
                                        <button type="button" class="btn btn-primary sms_close_btn"
                                            onclick="javascript:void(0);">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>





                    </div>
                </div>
                <!--end::Card-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection


@section('script')
    <script>
        jQuery(document).ready(function() {
            console.log("AAAAAAAAAAAAAA");
            $("body").on("click", "#sso_btn", function() {
                $('#ssoModal').modal('show');
            });
            $("body").on("click", ".sso_close_btn", function() {
                $('#ssoModal').modal('hide');
            });
            $("body").on("click", ".sso_save_btn", function() {
                $('#ssoModal').modal('hide');
            });



            $("body").on("click", "#xero_btn", function() {
                $('#xeroModal').modal('show');
            });
            $("body").on("click", ".xero_close_btn", function() {
                $('#xeroModal').modal('hide');
            });
            $("body").on("click", ".xero_save_btn", function() {
                $('#xeroModal').modal('hide');
            });




            $("body").on("click", "#smtp_btn", function() {
                $('#smtpModal').modal('show');
            });
            $("body").on("click", ".smtp_close_btn", function() {
                $('#smtpModal').modal('hide');
            });
            $("body").on("click", ".smtp_save_btn", function() {
                $('#smtpModal').modal('hide');
            });




            $("body").on("click", "#sms_btn", function() {
                $('#smsModal').modal('show');
            });
            $("body").on("click", ".sms_close_btn", function() {
                $('#smsModal').modal('hide');
            });
            $("body").on("click", ".sms_save_btn", function() {
                $('#smsModal').modal('hide');
            });
        });
    </script>

@endsection
