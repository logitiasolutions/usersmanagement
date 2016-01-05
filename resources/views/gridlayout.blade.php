@extends('app')

@section('head-content')
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/datagrid.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/datepicker.css') }}">
@endsection

@section('content')
    {{-- Grid --}}
    <section class="panel panel-default panel-grid">

        {{-- Grid: Header --}}
        <header class="panel-heading">

            <nav class="navbar navbar-default navbar-actions">

                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#actions">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <span class="navbar-brand">@yield('title')</span>

                    </div>

                    {{-- Grid: Actions --}}
                    <div class="collapse navbar-collapse" id="actions">

                        @section('page-download')
                        <ul class="nav navbar-nav navbar-left">

                            @yield('extra-actions-pre-grid-download')

                            <li class="dropdown disabled">
                                <a href="#" data-grid-exporter class="dropdown-toggle tip" data-toggle="dropdown" role="button" aria-expanded="false" data-original-title="Export">
                                    <i class="fa fa-download"></i> <span class="visible-xs-inline">Export</span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a data-download="pdf"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                    <li><a data-download="csv"><i class="fa fa-file-excel-o"></i> CSV</a></li>
                                    <li><a data-download="json"><i class="fa fa-file-code-o"></i> JSON</a></li>
                                </ul>
                            </li>

                            @yield('extra-actions-post-grid-download')
                        </ul>
                        @show

                        @section('page-filter')
                        {{-- Results per page --}}
                        <div class="col-md-2" style="margin-top: 7px;">

                            <div class="form-group">

                                <select data-per-page class="form-control">
                                    <option>Per Page</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>

                            </div>

                        </div>
                        @show


                        @section('grid-filter')
                         {{-- Grid: Filters --}}
                         <form class="navbar-form navbar-right" method="post" accept-charset="utf-8" data-search data-grid="main" role="form">

                            <div class="input-group">

                                <input class="form-control" name="filter" type="text" placeholder="Search">

							<span class="input-group-btn">

								<button class="btn btn-default" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>

								<button class="btn btn-default" data-grid="main" data-reset>
                                    <i class="fa fa-refresh fa-sm"></i>
                                </button>

							</span>

                            </div>

                        </form>
                        @show
                    </div>

                </div>

            </nav>

        </header>

        {{-- Page header --}}
        <div class="panel-body">

            {{-- Grid: Applied Filters --}}
            <div class="btn-toolbar" role="toolbar" aria-label="data-grid-applied-filters">

                <div id="data-grid_applied" class="btn-group" data-grid="main"></div>

            </div>

        </div>

        {{-- Grid: Table --}}
        <div class="table-responsive">

            <table id="data-grid" class="table table-hover" data-source="@yield('datasource')" data-grid="main">

                @yield('grid-headers')
                <tbody></tbody>

            </table>

        </div>

        <footer class="panel-footer clearfix">

            {{-- Grid: Pagination --}}
            <div id="data-grid_pagination" data-grid="main"></div>

        </footer>

        <?php
            if(!isset($resultsTemplate)) {
                $resultsTemplate = 'admin.grid.no_results';
            }

            if(!isset($paginationTemplate)) {
                $paginationTemplate = 'grid.pagination';
            }

            if(!isset($filtersTemplate)) {
                $filtersTemplate = 'grid.filters';
            }

            if(!isset($noResultsTemplate)) {
                $noResultsTemplate = 'grid.no_results';
            }
        ?>

        @include($resultsTemplate)

        @include($paginationTemplate)
        @include($filtersTemplate)
        @include($noResultsTemplate)

    </section>

    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/cartalyst/data-grid/js/underscore.js') }}"></script>
    <script src="{{ URL::asset('assets/cartalyst/data-grid/js/data-grid.js') }}"></script>

    <script type="text/javascript">
        $('.tip').tooltip();
    </script>

    <script src="{{ URL::asset('js/moment.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>

    <script>
        // Code to make the ul visible
        $('.dropdown-toggle').dropdown();

        // Code added by rahul to change the color of the dropdown under export and filter

        $("button.btn.btn-default.dropdown-toggle").next().children().css({'background-color':'#FFF'});
        $("button.btn.btn-default.dropdown-toggle").next().children().children().css({'color':'#000'});



        // Setup DataGrid
        var grid = $.datagrid('main', '#data-grid', '#data-grid_pagination', '#datadata-grid_applied',
                {
                    throttle: 20,
                    loader: '.loader',
                    callback: function (obj) {
                        // Select the correct value on the per page dropdown
                        $('[data-per-page]').val(obj.opt.throttle);
                        // Disable the export button if no results
                        $('button[name="export"]').prop('disabled', (obj.pagination.filtered === 0) ? true : false);
                    }
                }
        );
        // Date Picker
        /*
        /*
         $('.datePicker').datetimepicker({
         pickTime: false
         });
         */
        /**
         * DEMO ONLY EVENTS
         */
        $('[data-per-page]').on('change', function () {
            grid.setThrottle($(this).val());
            grid.refresh();
        });
    </script>

@endsection