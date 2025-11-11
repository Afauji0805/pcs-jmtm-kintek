<main class="container">

    <div class="d-flex align-items-center p-3 my-2 text-dark rounded shadow-lg" style="background: #ADA996;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */       
            ">
        <i class="fa-solid fa-gauge-high fa-bounce fa-2xl"></i>&nbsp;&nbsp;&nbsp;
        <div class="lh-1">
            <h1 class="h6 mb-0 text-dark lh-1"><b>Dashboard</b></h1>
            <small>Elektronik Project Control System (E-PCS)</small>
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <!-- Sub Judul Halaman Card -->
        <h6 class="border-bottom border-dark pb-2 mb-0">
            <i class="fa-solid fa-circle-info px-1"></i>
            Informasi Grafis
        </h6><!-- End Sub Judul Halaman Card -->
        <div class="d-flex pt-3">
            <!-- Card Box 1 -->
            <div class="box" style="--color: #fc5f9b">
                <div class="content">
                    <div class="icon">
                        <i class="fa-solid fa-person-digging fa-beat-fade fa-xl"></i>
                    </div>
                    <div class="text">
                        <h6><small><strong>Project Active</strong></small></h6>
                        <p><strong>0</strong></p>
                    </div>

                </div>
            </div>&nbsp;&nbsp;
            <!-- End Card Box 1-->
            <!-- Card Box 2 -->
            <div class="box" style="--color: #a362ea">
                <div class="content">
                    <div class="icon">
                        <i class="fa-solid fa-hourglass-end fa-flip fa-xl"></i>
                    </div>
                    <div class="text">
                        <h6><small><strong>Project Ongoing</strong></small></h6>
                        <p><strong>0</strong></p>
                    </div>
                </div>
            </div>&nbsp;&nbsp;
            <!-- End Card Box 2 -->
            <!-- Card Box 3 -->
            <div class="box" style="--color: #5bc0de">
                <div class="content">
                    <div class="icon">
                        <i class="fa-solid fa-road-circle-check fa-bounce fa-xl"></i>
                    </div>
                    <div class="text">
                        <h6><small><strong>Project Completed</strong></small></h6>
                        <p><strong>0</strong></p>
                    </div>
                </div>
            </div>&nbsp;&nbsp;
            <!-- End Card Box 3 -->
            <!-- Card Box 4 -->
            <div class="box" style="--color: #0ed095">
                <div class="content">
                    <div class="icon">
                        <i class="fa-solid fa-pen-to-square fa-beat fa-xl"></i>
                    </div>
                    <div class="text">
                        <h6><small><strong>Project Plan</strong></small></h6>
                        <p><strong>0</strong></p>
                    </div>
                </div>
            </div>&nbsp;&nbsp;
            <!-- End Card Box 4 -->
            <!-- Card Box 5 -->
            <div class="box" style="--color: #f0ad4e">
                <div class="content">
                    <div class="icon">
                        <i class="fa-solid fa-calculator fa-xl"></i>
                    </div>
                    <div class="text">
                        <h6><small><strong>Project Realization</strong></small></h6>
                        <p><strong>0</strong></p>
                    </div>
                </div>
            </div>
            <!-- End Card Box 5 -->
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <h6 class="border-bottom border-dark pb-2 mb-0">
            <i class="fa-solid fa-circle-info px-1"></i>
            Informasi Grafik
        </h6><!-- End Sub Judul Halaman Penyedia -->
        <div class="pt-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #373B44;  /* fallback for old browsers */
                                        background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
                                        background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-chart-area fa-lg px-1"></i>
                                        <small><strong>Area Chart || Project Plan & Realization</strong></small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #ffe259;  /* fallback for old browsers */
                                    background: -webkit-linear-gradient(to right, #ffa751, #ffe259);  /* Chrome 10-25, Safari 5.1-6 */
                                    background: linear-gradient(to right, #ffa751, #ffe259); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-dark">
                                        <i class="fa-solid fa-chart-line fa-lg px-1"></i>
                                        <small><strong>Line Chart || Project Plan & Realization</strong></small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center p-3 my-2 text-white rounded shadow-lg"
        style="background: #44A08D;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
        <div class="lh-1">
            <h1 class="h6 mb-0 text-white lh-1">
                <b>
                    <i class="fa-solid fa-circle-info fa-lg px-1"></i>
                    Catatan Penggunaan
                </b>
            </h1><br>
            <p>
                <small>
                    1. Informasi Grafis adalah informasi summary dari setiap count data-data RAPP & DKH.<br>
                    2. Informasi Grafik berupa grafik area chart & line chart dari summary dari setiap count data-data
                    RAPP & DKH .<br>
                </small>
            </p>
        </div>
    </div><!-- End Informasi Penggunaan -->
</main>