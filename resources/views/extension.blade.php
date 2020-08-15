@extends('layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">Journey Chrome Extension</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>This extension will help your linkedin research a breeze and it only takes a few minutes to install!</p>
                        <p>Upon successful installation you will see a new button on profiles that you visit.</p>
                        <small>*Currently only available for Google Chrome browsers.</small>
                        <br>
                        <small>**Currently only available for plain linkedin pages, not sales navigator profiles.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <section id="cd-timeline" class="cd-container">
                    <div class="cd-timeline-block">

                        <div class="cd-timeline-content p-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="text-right">
                                        <h3>Find Extension</h3>
                                        <p class="mb-0 text-muted">Head over to <a href="https://github.com/SalihBorucu/Journey-CRM-Chrome-Addon" target="_blank">https://github.com/SalihBorucu/Journey-CRM-Chrome-Addon</a>.</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="text-center">
                                        <div class="cd-date mb-4">Step 1</div>
                                        <div>
                                            <i class="mdi mdi-briefcase-search-outline h2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- cd-timeline-content -->
                    </div> <!-- cd-timeline-block -->

                    <div class="cd-timeline-block">

                        <div class="cd-timeline-content p-3">

                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="text-center">
                                        <div class="cd-date mb-4">Step 2</div>
                                        <div>
                                            <i class="mdi mdi-briefcase-edit-outline h2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div>
                                        <h3>Download</h3>
                                        <p class="mb-0 text-muted">Click on the green "code" button towards the right top corner of the screen. Then within the dropdown, click "download ZIP" at the bottom.</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- cd-timeline-content -->
                    </div> <!-- cd-timeline-block -->

                    <div class="cd-timeline-block">

                        <div class="cd-timeline-content p-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="text-right">
                                        <h3>Set Environment</h3>
                                        <p class="mb-0 text-muted">Navigate to <a href="chrome://extensions">chrome://extensions</a> in your browser. Then switch over to "Developer mode" on by toggling the switch on the top right corner of your screen.</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="text-center">
                                        <div class="cd-date mb-4">Step 3</div>
                                        <div>
                                            <i class="mdi mdi-television h2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- cd-timeline-content -->
                    </div> <!-- cd-timeline-block -->

                    <div class="cd-timeline-block">

                        <div class="cd-timeline-content p-3">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="text-center">
                                        <div class="cd-date mb-4">Step 4</div>
                                        <div>
                                            <i class="mdi mdi-remote-desktop h2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div>
                                        <h3>Load Package</h3>
                                        <p class="m-b-20 text-muted">Head over to your downloads folder, then unzip the file downloaded. Return to your extensions page, click "load unpacked" on the top left corner of the page. Navigate to your downloads then select the folder then click open.
                                        </p>
                                        {{-- <img src="assets/images/small/img-1.jpg" alt="" class="rounded" style="width: 120px;">
                                        <img src="assets/images/small/img-2.jpg" alt="" class="rounded" style="width: 120px;"> --}}
                                    </div>
                                </div>
                            </div>
                        </div> <!-- cd-timeline-content -->
                    </div> <!-- cd-timeline-block -->

                    <div class="cd-timeline-block">

                        <div class="cd-timeline-content p-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="text-right">
                                        <h3>Well done!</h3>
                                        <p class="m-b-20 text-muted">Your extension now should be installed, you do not need to register just click on the extension icon once and as soon as you are logged in to your Journey CRM account you will be fine. Enjoy..</p>
                                        <button type="button" class="btn btn-primary waves-effect waves-light">Something is not right?</button>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="text-center">
                                        <div class="cd-date mb-4">Step 5</div>
                                        <div>
                                            <i class="mdi mdi-television-guide h2 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- cd-timeline-content -->
                    </div> <!-- cd-timeline-block -->
                </section> <!-- cd-timeline -->
            </div>
        </div>

    </div>
@endsection
