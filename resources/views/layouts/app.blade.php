<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@isset($display_tabs['title']) {{ $display_tabs['title'] }} @else {{ config('app.name', 'Clinical Genome Resource') }} @endisset </title>

  <!-- Scripts -->

  <script src="{{ asset('js/js.cookie.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Fonts -->

  <!-- Styles -->
  @yield('script_css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  {{-- @livewireStyles --}}

    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
     ga('create', 'UA-49947422-1', 'auto');
     ga('set', 'dimension7', 'KB Curations - Index');  
     //Page type
     ga('send', 'pageview');
    </script>


</head>
<body>
  <div id="app">
    {{-- <div style=" background-color:#000; padding:3px; color:gold; font-weight:bold; text-align:center; font-size:10px;">CLINGEN DEMO WEBSITE</div> --}}
    @include('_partials._wrapper.header-micro',['navActive' => "summary"])
    @include('_partials._wrapper.header',['navActive' => "summary"])

    <main id='section_main' role="main">
      <section id='section_heading' class="pt-0 pb-0 mb-0 section-heading section-heading-groups text-light">
        <div  class="container">
          <form id="navSearchBar" method="post" action="{{ route('gene-search') }}">
            @csrf
            <div id="section_search_wrapper" class="mt-2 mb-2 input-group input-group-md">
           <input type="hidden" class="buildtype" name="type" value="">
	         <span class="input-group-addon" id=""><i class="fas fa-search"></i></span>
	         <div class="input-group-btn">
	           <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='typeQueryLabel'>Gene</span></button>
	           <ul class="dropdown-menu dropdown-menu-left">
	             <li><a class="typeQueryGene pointer">Gene Symbol</a></li>
	             <li><a class="typeQueryDisease pointer">Disease Name</a></li>
	             <li><a class="typeQueryDrug pointer">Drug Name</a></li>
	             <li><a class="typeQueryRegionGRCh37 pointer">Region (GRCh37)</a></li>
	             <li><a class="typeQueryRegionGRCh38 pointer">Region (GRCh38)</a></li>
	             {{-- <li><a href="#">HGVS Expression</a></li> --}}
	             {{-- <li><a href="#">Genomic Coordinates</a></li> --}}
	             {{-- <li><a href="#">CAid (Variant)</a></li> --}}
               <li role="separator" class="divider"></li>
               <li><a class="" target="allele_reg" href="http://reg.clinicalgenome.org">Variant <i class="fas fa-external-link-alt mt-1 text-muted"></i> </a></li>
	             <li><a href="https://clinicalgenome.org/search/"> Website Content <i class="fas fa-external-link-alt mt-1 text-muted"></i></a></li>
	           </ul>
           </div><!-- /btn-group -->
           <span class="inputQueryGene">
            <input type="text" class="form-control queryGene " aria-label="..." value="" name="search[]" placeholder="Start typing a gene symbol...">
           </span>
           <span class="inputQueryDisease" style="display: none">
            <input type="text" class="form-control  queryDisease" aria-label="..." value="" name="search[]" placeholder="Start typing a disease..." >
           </span>
           <span class="inputQueryDrug" style="display: none">
           <input type="text" class="form-control queryDrug" aria-label="..." value="" name="search[]" placeholder="Start typing a drug...">
           </span>
           <span class="inputQueryRegion" style="display: none">
           <input type="text" class="form-control queryRegion" aria-label="..." value="" name="search[]" placeholder="Start typing a region...">
           </span>
	         <span class="input-group-btn">
	                 <button class="btn btn-default btn-search-submit" type="submit"> Search</button>
	               </span>
         </div><!-- /input-group -->
          </form>
          @hasSection ('heading')
            @yield('heading')
          @else
            <div class="mb-3"></div>
          @endif
          @isset($display_tabs['active'])

          <ul class="nav-tabs-search nav nav-tabs ml-0 mt-1 ">
            {{-- <li class="nav-item @if ($display_tabs['active'] == "home") active @endif ">
              <a class="nav-link" href="{{ route('home') }}">
                Overview
              </a>
            </li> --}}
            <li class="nav-item @if ($display_tabs['active'] == "gene-curations") active @endif ">
              <a class="nav-link" href="{{ route('gene-curations') }}">
                All Curated Genes
              </a>
            </li>

            <li class="nav-item dropdown @if ($display_tabs['active'] == "validity") active @endif ">
              <a class="nav-link  dropdown-toggle" href="{{ route('validity-index') }}"  aria-haspopup="true" aria-expanded="false">
                Gene-Disease Validity
              </a>
                <ul class="dropdown-menu">
                  <li><a class="" href="{{ route('validity-index') }}">All Curations</a></li>
                  <li><a class="f" href="{{ route('affiliate-index') }}">Curations by Expert Panel</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ route('validity-download') }}"><i class="fas fa-download"></i> Summary Data Download (CSV)</a></li>
                </ul>
              </li>
            <li class="nav-item dropdown @if ($display_tabs['active'] == "dosage") active @endif ">
              <a class="nav-link  dropdown-toggle" href="{{ route('dosage-index') }}" aria-haspopup="true" aria-expanded="false">
                Dosage Sensitivity
              </a>
              <ul class="dropdown-menu">
                <li><a class="" href="{{ route('dosage-index') }}">All Curations</a></li>
                {{-- <li><a class="" href="{{ route('dosage-acmg59') }}">ACMG 59 Genes</a></li> --}}
                <li><a class="" href="{{ route('dosage-cnv') }}">Recurrent CNV</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('dosage-download') }}"><i class="fas fa-download"></i> Summary Data Download (CSV)</a></li>
                <li><a href="{{ route('dosage-ftp') }}"><i class="fas fa-external-link-alt"></i> FTP File Downloads (BED, TSV)</a></li>
              </ul>
            </li>
            <li class="nav-item @if ($display_tabs['active'] == "actionability") active @endif ">
              <a class="nav-link" target="external-actionability" href="{{ route('actionability-index') }}">
                Clinical Actionability <i class="fas fa-external-link-alt small"></i>
              </a>
            </li>
            <li class="nav-item @if ($display_tabs['active'] == "actionability") active @endif ">
              <a class="nav-link" target="external-erepo" href="{{ route('variant-path-index') }}">
                Curated Variants <i class="fas fa-external-link-alt small"></i>
              </a>
            </li>
            <li class="nav-item @if ($display_tabs['active'] == "stats") active @endif ">
              <a class="nav-link" href="{{ route('stats-index') }}">
                Statistics
              </a>
            </li>
            <li class="nav-item dropdown @if (($display_tabs['active'] == "gene") ||  ($display_tabs['active'] == "drug") || ($display_tabs['active'] == "condition") || ($display_tabs['active'] == "more")) active @endif">
                <a class="nav-link dropdown-toggle"  href="#" >
                 More
                </a>
                <ul class="dropdown-menu">
                  {{-- <li><a href="#">Genomic Browser</a></li> --}}
                  {{-- <li><a class="@if ($display_tabs['active'] == "affiliate") font-weight-bold @endif" href="{{ route('affiliate-index') }}">Curations by ClinGen Expert Panels</a></li>
                  <li role="separator" class="divider"></li> --}}
                  <li><a class="@if ($display_tabs['active'] == "gene") font-weight-bold @endif" href="{{ route('gene-index') }}">All Genes</a></li>
                  <li><a class="@if ($display_tabs['active'] == "disease") font-weight-bold @endif" href="{{ route('condition-index') }}">All Disease</a></li>
                  <li><a class="@if ($display_tabs['active'] == "drug") font-weight-bold @endif" href="{{ route('drug-index') }}">All Drugs & Medications</a></li>
                  {{-- <li role="separator" class="divider"></li>
                  <li><a href="#">APIs and Downloads</a></li> --}}
                </ul>
              </li>

            <li role="presentation" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-question-circle"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="https://clinicalgenome.org/tools/clingen-website-faq/">Frequently Asked Questions</a></li>
                  <li><a href="https://clinicalgenome.org/tools/clingen-website-faq/how-to-cite/">How To Cite ClinGen</a></li>
                  <li><a href="https://clinicalgenome.org/tools/clingen-website-faq/attribution/">External Data Attribution</a></li>
                  <li><a href="https://clinicalgenome.org/about/contact-clingen/">Contact Us</a></li>
                </ul>
              </li>
            {{-- <li role="presentation" class="nav-item dropdown pull-right">
                <a class="nav-link dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-share-square"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                  <li><a href="#"><i class="fas fa-envelope-open"></i> Email this page...</a></li>
                  <li><a href="#"><i class="fab fa-twitter"></i> Tweet this page...</a></li>
                  <li><a href="#"><i class="fas fa-quote-left"></i> How to cite...</a></li>
                </ul>
              </li> --}}
            {{--<li class="nav-item  pull-right ">
              <a class="nav-link" href="#">
                <i class="fas fa-download"></i>
              </a>
            </li>--}}

            {{--<li class="nav-item  pull-right ">
              <a class="nav-link" href="#">
                <i class="fas fa-print"></i>
              </a>
            </li>--}}
          </ul>
          @endisset
          </div>
        </section>
        @hasSection ('content-heading')
          <section id='section_content_heading' class="pt-0 pb-0 mb-2 section-heading section-content-heading-groups">
            <div  class="container">
             @yield('content-heading')
            </div>
            </section>
        @endif

        <section id='section_content' class="container">
          @if (session('status'))
          <div class="row">
            <div class="col-12">
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
            </div>
          </div>
          @endif
          <div class="row">
            @yield('content')

            @yield('modals')
            @include('modals.login')
          </div>
        </section>
      </main>

      @include('_partials._wrapper.footer',['navActive' => "summary"])


      <div class="">

      </div>
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="/js/jquery.validate.min.js" ></script>
    <script src="/js/additional-methods.min.js" ></script>


    <script>
      $(function() {
      
      
        $( '#frm-logout' ).validate( {
          submitHandler: function(form) {
            
            
            $.ajaxSetup({
              cache: true,
              contentType: "application/x-www-form-urlencoded",
              processData: true,
              headers:{
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN' : window.token,
                'Authorization':'Bearer ' + Cookies.get('laravel_token')
              }
            });
            
            var url = "/api/logout";
            
            var formData = $(form).serialize();
      
            //submits to the form's action URL
            $.post(url, formData, function(response)
            {
              //alert(JSON.stringify(response));
          
              /*if (response['message'])
              {
                swal("Done!", response['message'], "success")
                  .then((answer2) => {
                    if (answer2){*/
                      alert("cp2");
                      Cookies.remove('laravel_token');
                      //$('#modalLogin').modal('hide');
                      //swap login for dashboard
                      $('.action-login').html('Login').attr('href', '#')
                                  .on('click', function() {
                                    $('#modalLogin').modal('show');
                                  });

                      // we allow login to equate to conformation of an action, so check if there is anything we need to do
                      /*if (response.context)
                      {
                        var color = $('.stats-banner').find('.fa-star').css('color');

		                    if (typeof color !== 'undefined' && color == "rgb(211, 211, 211)")
                        { 
                          $('.stats-banner').find('.fa-star').css('color', 'green');
                        }

                        $('#follow-gene-id').collapse("hide");
                      }*/
                    /*}
                });
              }*/
            }).fail(function(response)
            {
              //handle failed validation
              alert("Error Logging in");
            });
      
            //$('#modalFollowGene').modal('hide');
          },
          rules: {
            email: {
              email: true,
              maxlength: 80
            }
          },
          messages: {
            email:  {
              email: "Please enter a valid email address",
              maxlength: "Section names must be less than 80 characters"
            },	
          },
          errorElement: 'em',
          errorClass: 'invalid-feedback',
          errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "invalid-feedback" );
      
            if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
            } else {
              error.insertAfter( element );
            }
          },
          highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
          }
        });

        $( '#login-form' ).validate( {
          submitHandler: function(form) {
            
            $.ajaxSetup({
              cache: true,
              contentType: "application/x-www-form-urlencoded",
              processData: true
            });
            
            var url = "/api/login";
            
            var formData = $(form).serialize();
      
            //submits to the form's action URL
            $.post(url, formData, function(response)
            {
              //alert(JSON.stringify(response));
          
              /*if (response['message'])
              {
                swal("Done!", response['message'], "success")
                  .then((answer2) => {
                    if (answer2){*/
                      Cookies.set('laravel_token', response.access_token);
                      $('#modalLogin').modal('hide');
                      //swap login for dashboard
                      $('.action-login').html('Dashboard').attr('href', '/dashboard').off();

                      // we allow login to equate to conformation of an action, so check if there is anything we need to do
                      if (response.context)
                      {
                        var color = $('.stats-banner').find('.fa-star').css('color');

		                    if (typeof color !== 'undefined' && color == "rgb(211, 211, 211)")
                        { 
                          $('.stats-banner').find('.fa-star').css('color', 'green');
                        }

                        $('#follow-gene-id').collapse("hide");
                      }
                    /*}
                });
              }*/
            }).fail(function(response)
            {
              //handle failed validation
              alert("Error Logging in");
            });
      
            //$('#modalFollowGene').modal('hide');
          },
          rules: {
            email: {
              required: true,
              email: true,
              maxlength: 80
            }
          },
          messages: {
            email:  {
              required: "Please enter your email address",
              email: "Please enter a valid email address",
              maxlength: "Section names must be less than 80 characters"
            },	
          },
          errorElement: 'em',
          errorClass: 'invalid-feedback',
          errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "invalid-feedback" );
      
            if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
            } else {
              error.insertAfter( element );
            }
          },
          highlight: function ( element, errorClass, validClass ) {
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
          }
        });
      });
        </script>
    @yield('script_js')

    <script>
  var mybutton = document.getElementById("clingen_top");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
    <script>
      $(".action-login").click(function() {

        $('#modalLogin').modal('show');
      });


    </script>
    <script src="/js/typeahead.js"></script>
    <script>
      $( ".typeQueryGene" ).click(function() {
        $("#navSearchBar").attr("action", "{{ route('gene-search') }}");
        $( ".inputQueryGene" ).show();
        $( ".inputQueryGene .queryGene" ).show();
        $( ".inputQueryDisease" ).hide();
        $( ".inputQueryDisease .queryDisease" ).hide();
        $( ".inputQueryDrug" ).hide();
        $( ".inputQueryDrug .queryDrug" ).hide();
        $( ".inputQueryRegion" ).hide();
        $( ".inputQueryRegion .queryRegion" ).hide();
        $( ".typeQueryLabel").text("Gene");
      });
      $( ".typeQueryDisease" ).click(function() {
        $("#navSearchBar").attr("action", "{{ route('condition-search') }}");
        $( ".inputQueryGene" ).hide();
        $( ".inputQueryGene .queryGene" ).hide();
        $( ".inputQueryDisease" ).show();
        $( ".inputQueryDisease .queryDisease" ).show();
        $( ".inputQueryDrug" ).hide();
        $( ".inputQueryDrug .queryDrug" ).hide();
        $( ".inputQueryRegion" ).hide();
        $( ".inputQueryRegion .queryRegion" ).hide();
        $( ".typeQueryLabel").text("Disease");
      });
      $( ".typeQueryDrug" ).click(function() {
        $("#navSearchBar").attr("action", "{{ route('drug-search') }}");
        $( ".inputQueryGene" ).hide();
        $( ".inputQueryGene .queryGene" ).hide();
        $( ".inputQueryDisease" ).hide();
        $( ".inputQueryDisease .queryDisease" ).hide();
        $( ".inputQueryDrug" ).show();
        $( ".inputQueryDrug .queryDrug" ).show();
        $( ".inputQueryRegion" ).hide();
        $( ".inputQueryRegion .queryRegion" ).hide();
        $( ".typeQueryLabel").text("Drug");
      });
      $( ".typeQueryRegionGRCh37" ).click(function() {
        $("#navSearchBar").attr("action", "{{ route('region-search') }}");
        $( ".inputQueryGene" ).hide();
        $( ".inputQueryGene .queryGene" ).hide();
        $( ".inputQueryDisease" ).hide();
        $( ".inputQueryDisease .queryDisease" ).hide();
        $( ".inputQueryDrug" ).hide();
        $( ".inputQueryDrug .queryDrug" ).hide();
        $( ".inputQueryRegion" ).show();
        $( ".inputQueryRegion .queryRegion" ).show();
        $( ".typeQueryLabel").text("GRCh37 Region");
        $( ".buildtype").val("GRCh37");
      });
      $( ".typeQueryRegionGRCh38" ).click(function() {
        $("#navSearchBar").attr("action", "{{ route('region-search') }}");
        $( ".inputQueryGene" ).hide();
        $( ".inputQueryGene .queryGene" ).hide();
        $( ".inputQueryDisease" ).hide();
        $( ".inputQueryDisease .queryDisease" ).hide();
        $( ".inputQueryDrug" ).hide();
        $( ".inputQueryDrug .queryDrug" ).hide();
        $( ".inputQueryRegion" ).show();
        $( ".inputQueryRegion .queryRegion" ).show();
        $( ".typeQueryLabel").text("GRCh38 Region");
        $( ".buildtype").val("GRCh38");
      });


      /*var term = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: 'https://search.clinicalgenome.org/kb/home.json?term=%QUERY',
          wildcard: '%QUERY'
        }
      });*/

      var term = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '{{  url('api/genes/look/%QUERY') }}',
          wildcard: '%QUERY'
        }
      });

      var termGene = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '{{  url('api/genes/look/%QUERY') }}',
          wildcard: '%QUERY'
        }
      });

      var termDisease = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '{{  url('api/conditions/look/%QUERY') }}',
          wildcard: '%QUERY'
        }
      });

      var termDrug = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '{{  url('api/drugs/look/%QUERY') }}',
          wildcard: '%QUERY'
        }
      });

      $('.queryDisease').typeahead(null,
      {
        name: 'termDisease',
        display: 'label',
        source: termDisease,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });

      $('.queryGene').typeahead(null,
      {
        name: 'termGene',
        display: 'label',
        source: termGene,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });

      $('.queryDrug').typeahead(null,
      {
        name: 'termDrug',
        display: 'label',
        source: termDrug,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });

    </script>
    {{-- @livewireScripts --}}

    <script type="text/javascript">
      
      // Tracking for google of the onclicks
      $( ".externallink" ).on( "click", function() {
          var title = $(this).attr("title");
          //console.log( "externallink" );
          //console.log( title );
          ga('send', 'event', 'external_link', 'click', title );
      });

      $( ".externalresource" ).on( "click", function() {
          var title = $(this).attr("title");
          //console.log( "externallink" );
          //console.log( title );
          ga('send', 'event', 'external_resource', 'click', title );
      });
      $( ".watchreportclick" ).on( "click", function() {
          var title = $(this).attr("title");
          //console.log( "watchreportclick" );
          //console.log( title );
          ga('send', 'event', 'track_report_click', 'click', title );
      });
      $( ".watchdownloadclick" ).on( "click", function() {
          var title = $(this).attr("title");
          //console.log( "watchdownloadclick" );
          //console.log( title );
          ga('send', 'event', 'track_download_click', 'click', title );
      });
      
    </script>
  </body>
  </html>
