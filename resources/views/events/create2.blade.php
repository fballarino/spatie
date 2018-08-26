
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">

    <title></title>

    <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="./css/prettify-1.0.css" rel="stylesheet">
    <link href="./css/base.css" rel="stylesheet">
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>


    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>





</head>

<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Collapsed navigation -->
        <div class="navbar-header">
            <!-- Expander button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Main title -->
            <a class="navbar-brand" href=""></a>
        </div>

        <!-- Expanded navigation -->
        <div class="navbar-collapse collapse">
            <!-- Main navigation -->
            <ul class="nav navbar-nav">


                <li class="active">
                    <a href=".">Usage</a>
                </li>



                <li >
                    <a href="Installing/">Installing</a>
                </li>



                <li >
                    <a href="Functions/">Functions</a>
                </li>



                <li >
                    <a href="Options/">Options</a>
                </li>



                <li >
                    <a href="Events/">Events</a>
                </li>



                <li >
                    <a href="Changelog/">Change Log</a>
                </li>



                <li >
                    <a href="ContributorsGuide/">Dev Guide</a>
                </li>



                <li >
                    <a href="Extras/">Extras</a>
                </li>



                <li >
                    <a href="FAQ/">FAQs</a>
                </li>


            </ul>

            <!-- Search, Navigation and Repo links -->
            <ul class="nav navbar-nav navbar-right">



            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3"><script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CK7DC5QN&placement=eonasdangithubio" id="_carbonads_js"></script>
            <div class="bs-sidebar hidden-print affix well" role="complementary">    <ul class="nav bs-sidenav">

                    <li class="main active"><a href="#bootstrap-3-datepicker-v4-docs">Bootstrap 3 Datepicker v4 Docs</a></li>

                    <li><a href="#minimum-setup">Minimum Setup</a></li>

                    <li><a href="#using-locales">Using Locales</a></li>

                    <li><a href="#time-only">Time Only</a></li>

                    <li><a href="#date-only">Date Only</a></li>

                    <li><a href="#no-icon-input-field-only">No Icon (input field only):</a></li>

                    <li><a href="#enableddisabled-dates">Enabled/Disabled Dates</a></li>

                    <li><a href="#linked-pickers">Linked Pickers</a></li>

                    <li><a href="#custom-icons">Custom Icons</a></li>

                    <li><a href="#view-mode">View Mode</a></li>

                    <li><a href="#min-view-mode">Min View Mode</a></li>

                    <li><a href="#disabled-days-of-the-week">Disabled Days of the Week</a></li>

                    <li><a href="#inline">Inline</a></li>


                </ul>
            </div></div>
        <div class="col-md-9" role="main">

            <h1 id="bootstrap-3-datepicker-v4-docs">Bootstrap 3 Datepicker v4 Docs</h1>
            <div class="alert alert-info">
                <strong>Note</strong>
                All functions are accessed via the <code>data</code> attribute e.g. <code>$('#datetimepicker').data("DateTimePicker").FUNCTION()</code>
            </div>

            <h3 id="minimum-setup">Minimum Setup</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker1').datetimepicker();
                        });
                    </script>
                </div>
            </div>

            <h4 id="code">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;div class=&quot;form-group&quot;&gt;
                &lt;div class='input-group date' id='datetimepicker1'&gt;
                    &lt;input type='text' class=&quot;form-control&quot; /&gt;
                    &lt;span class=&quot;input-group-addon&quot;&gt;
                        &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;&lt;/span&gt;
                    &lt;/span&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="using-locales">Using Locales</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker2').datetimepicker({
                                locale: 'it'
                            });
                        });
                    </script>
                </div>
            </div>

            <h4 id="code_1">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;div class=&quot;form-group&quot;&gt;
                &lt;div class='input-group date' id='datetimepicker2'&gt;
                    &lt;input type='text' class=&quot;form-control&quot; /&gt;
                    &lt;span class=&quot;input-group-addon&quot;&gt;
                        &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;&lt;/span&gt;
                    &lt;/span&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'ru'
                });
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="time-only">Time Only</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker3'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker3').datetimepicker({
                                format: 'LT'
                            });
                        });
                    </script>
                </div>
            </div>

            <h4 id="code_2">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;div class=&quot;form-group&quot;&gt;
                &lt;div class='input-group date' id='datetimepicker3'&gt;
                    &lt;input type='text' class=&quot;form-control&quot; /&gt;
                    &lt;span class=&quot;input-group-addon&quot;&gt;
                        &lt;span class=&quot;glyphicon glyphicon-time&quot;&gt;&lt;/span&gt;
                    &lt;/span&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="date-only">Date Only</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker3'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker3').datetimepicker({
                                format: 'L'
                            });
                        });
                    </script>
                </div>
            </div>

            <h4 id="code_3">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;div class=&quot;form-group&quot;&gt;
                &lt;div class='input-group date' id='datetimepicker3'&gt;
                    &lt;input type='text' class=&quot;form-control&quot; /&gt;
                    &lt;span class=&quot;input-group-addon&quot;&gt;
                        &lt;span class=&quot;glyphicon glyphicon-time&quot;&gt;&lt;/span&gt;
                    &lt;/span&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="no-icon-input-field-only">No Icon (input field only):</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <input type='text' class="form-control" id='datetimepicker4' />
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker4').datetimepicker();
                        });
                    </script>
                </div>
            </div>

            <h4 id="code_4">Code</h4>
            <pre><code>
&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;input type='text' class=&quot;form-control&quot; id='datetimepicker4' /&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker4').datetimepicker();
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="enableddisabled-dates">Enabled/Disabled Dates</h3>
            <div class="container">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker5'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker5').datetimepicker({
                                defaultDate: "11/1/2013",
                                disabledDates: [
                                    moment("12/25/2013"),
                                    new Date(2013, 11 - 1, 21),
                                    "11/22/2013 00:53"
                                ]
                            });
                        });
                    </script>
                </div>
            </div>

            <h4 id="code_5">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class='col-sm-6'&gt;
            &lt;div class=&quot;form-group&quot;&gt;
                &lt;div class='input-group date' id='datetimepicker5'&gt;
                    &lt;input type='text' class=&quot;form-control&quot; /&gt;
                    &lt;span class=&quot;input-group-addon&quot;&gt;
                        &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;&lt;/span&gt;
                    &lt;/span&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;script type=&quot;text/javascript&quot;&gt;
            $(function () {
                $('#datetimepicker5').datetimepicker({
                    defaultDate: &quot;11/1/2013&quot;,
                    disabledDates: [
                        moment(&quot;12/25/2013&quot;),
                        new Date(2013, 11 - 1, 21),
                        &quot;11/22/2013 00:53&quot;
                    ]
                });
            });
        &lt;/script&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="linked-pickers">Linked Pickers</h3>
            <div class="container">
                <div class='col-md-5'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>
                <div class='col-md-5'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker7'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker6').datetimepicker();
                    $('#datetimepicker7').datetimepicker({
                        useCurrent: false
                    });
                    $("#datetimepicker6").on("dp.change", function (e) {
                        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepicker7").on("dp.change", function (e) {
                        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                    });
                });
            </script>

            <h4 id="code_6">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class='col-md-5'&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker6'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;&lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class='col-md-5'&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker7'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;&lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $(&quot;#datetimepicker6&quot;).on(&quot;dp.change&quot;, function (e) {
            $('#datetimepicker7').data(&quot;DateTimePicker&quot;).minDate(e.date);
        });
        $(&quot;#datetimepicker7&quot;).on(&quot;dp.change&quot;, function (e) {
            $('#datetimepicker6').data(&quot;DateTimePicker&quot;).maxDate(e.date);
        });
    });
&lt;/script&gt;
</code></pre>

            <hr />
            <h3 id="custom-icons">Custom Icons</h3>
            <div class="container">
                <div class="col-sm-6" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker8'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker8').datetimepicker({
                            icons: {
                                time: "fa fa-clock-o",
                                date: "fa fa-calendar",
                                up: "fa fa-arrow-up",
                                down: "fa fa-arrow-down"
                            }
                        });
                    });
                </script>
            </div>

            <h4 id="code_7">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;col-sm-6&quot; style=&quot;height:130px;&quot;&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker8'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;fa fa-calendar&quot;&gt;
                    &lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;script type=&quot;text/javascript&quot;&gt;
        $(function () {
            $('#datetimepicker8').datetimepicker({
                icons: {
                    time: &quot;fa fa-clock-o&quot;,
                    date: &quot;fa fa-calendar&quot;,
                    up: &quot;fa fa-arrow-up&quot;,
                    down: &quot;fa fa-arrow-down&quot;
                }
            });
        });
    &lt;/script&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="view-mode">View Mode</h3>
            <div class="container">
                <div class="col-sm-6" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker9'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker9').datetimepicker({
                            viewMode: 'years'
                        });
                    });
                </script>
            </div>

            <h4 id="code_8">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;col-sm-6&quot; style=&quot;height:130px;&quot;&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker9'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;
                    &lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;script type=&quot;text/javascript&quot;&gt;
        $(function () {
            $('#datetimepicker9').datetimepicker({
                viewMode: 'years'
            });
        });
    &lt;/script&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="min-view-mode">Min View Mode</h3>
            <div class="container">
                <div class="col-sm-6" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker10'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker10').datetimepicker({
                            viewMode: 'years',
                            format: 'MM/YYYY'
                        });
                    });
                </script>
            </div>

            <h4 id="code_9">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;col-sm-6&quot; style=&quot;height:130px;&quot;&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker10'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;
                    &lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;script type=&quot;text/javascript&quot;&gt;
        $(function () {
            $('#datetimepicker10').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        });
    &lt;/script&gt;
&lt;/div&gt;

</code></pre>

            <hr />
            <h3 id="disabled-days-of-the-week">Disabled Days of the Week</h3>
            <div class="container">
                <div class="col-sm-6" style="height:130px;">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker11'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker11').datetimepicker({
                            daysOfWeekDisabled: [0, 6]
                        });
                    });
                </script>
            </div>

            <h4 id="code_10">Code</h4>
            <pre><code>&lt;div class=&quot;container&quot;&gt;
    &lt;div class=&quot;col-sm-6&quot; style=&quot;height:130px;&quot;&gt;
        &lt;div class=&quot;form-group&quot;&gt;
            &lt;div class='input-group date' id='datetimepicker11'&gt;
                &lt;input type='text' class=&quot;form-control&quot; /&gt;
                &lt;span class=&quot;input-group-addon&quot;&gt;
                    &lt;span class=&quot;glyphicon glyphicon-calendar&quot;&gt;
                    &lt;/span&gt;
                &lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;script type=&quot;text/javascript&quot;&gt;
        $(function () {
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6]
            });
        });
    &lt;/script&gt;
&lt;/div&gt;
</code></pre>

            <hr />
            <h3 id="inline">Inline</h3>
            <div style="overflow:hidden;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="datetimepicker12"></div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#datetimepicker12').datetimepicker({
                            inline: true,
                            sideBySide: true
                        });
                    });
                </script>
            </div>

            <h4 id="code_11">Code</h4>
            <pre><code>&lt;div style=&quot;overflow:hidden;&quot;&gt;
    &lt;div class=&quot;form-group&quot;&gt;
        &lt;div class=&quot;row&quot;&gt;
            &lt;div class=&quot;col-md-8&quot;&gt;
                &lt;div id=&quot;datetimepicker12&quot;&gt;&lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;script type=&quot;text/javascript&quot;&gt;
        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: true
            });
        });
    &lt;/script&gt;
&lt;/div&gt;
</code></pre></div>
    </div>
</div>



<script src="./js/prettify-1.0.min.js"></script>
<script src="./js/base.js"></script>
<script>
    if (top != self) { top.location.replace(self.location.href); }
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-47462200-1', 'eonasdan.github.io');
    ga('send', 'pageview');
</script>
</body>
</html>