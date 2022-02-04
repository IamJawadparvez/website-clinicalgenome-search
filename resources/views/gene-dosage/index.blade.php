@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-5">
			<table class="mt-3 mb-2">
				<tr>
					<td class="valign-top"><img src="/images/dosageSensitivity-on.png" width="40" height="40"></td>
					<td class="pl-2">
						<h1 class="h2 p-0 m-0"> Dosage Sensitivity</h1>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-md-4 mt-3">

			@include('gene-dosage.panels.selector')

		</div>

		<div class="col-md-3">
			<div class="">
				<div class="text-right p-2">
					<ul class="list-inline pb-0 mb-0 small">
						<li class="text-stats line-tight text-center pl-3 pr-3"><span
								class="countCurations text-18px"><i
									class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Curations
						</li>
						<li class="text-stats line-tight text-center pl-3 pr-3"><span class="countGenes text-18px"><i
									class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Genes
						</li>
						<li class="text-stats line-tight text-center pl-3 pr-3"><span class="countRegions text-18px"><i
									class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Regions
						</li>
						{{-- <li class="text-stats line-tight text-center pl-3 pr-3"><div class="btn-group p-0 m-0" style="display: block"><a class="dropdown-toggle pointer text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-download text-18px"></i><br />Download<br />Options
					</a>
						<ul class="dropdown-menu dropdown-menu-left">
							<li><a href="{{ route('dosage-download') }}">Summary Data (CSV)</a></li>
						<li><a href="{{ route('dosage-ftp') }}">Additional Data (FTP)</a></li>
					</ul>
					</li>
					<li class="text-stats line-tight text-center pl-3 pr-3">
						<div class="btn-group p-0 m-0" style="display: block"><a
								class="dropdown-toggle pointer text-dark" data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false"><i
									class="glyphicon glyphicon-list-alt text-18px text-muted"></i><br />ACMG<br />CNV
							</a>
							<ul class="dropdown-menu dropdown-menu-left">
								<li><a href="{{ route('dosage-acmg59') }}">ACMG 59 Genes</a></li>
								<li><a href="{{ route('dosage-cnv') }}">Recurrent CNVs</a></li>
							</ul>
					</li> --}}
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-12">
       		<button type="button" class="btn-link p-0 m-0" data-toggle="modal" data-target="#modalFilter">
				<span class="text-muted font-weight-bold mr-1"><small><i class="glyphicon glyphicon-tasks" style="top: 2px"></i> Advanced Filters:  </small></span><span class="filter-container"><span class="badge action-af-badge">None</span></span>
			</button>
		</div>

		<div class="col-md-12 light-arrows dark-table">

			@include('_partials.genetable', ['expand' => true])

		</div>
	</div>
</div>


@endsection

@section('heading')
<div class="content ">
	<div class="section-heading-content">
	</div>
</div>
@endsection

@section('modals')

@include('modals.filter')
@include('modals.bookmark')

@endsection


@section('script_css')
	<link href="/css/bootstrap-table.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-table-filter-control.css">
	<link href="/css/bootstrap-table-group-by.css" rel="stylesheet">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
    <link href="https://unpkg.com/multiple-select@1.5.2/dist/themes/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-table-sticky-header.css" rel="stylesheet">
@endsection

@section('script_js')

<script src="/js/tableExport.min.js"></script>
<script src="/js/jspdf.min.js"></script>
<script src="/js/xlsx.core.min.js"></script>
<script src="/js/jspdf.plugin.autotable.js"></script>

<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/bootstrap-table-locale-all.min.js"></script>
<script src="/js/bootstrap-table-export.min.js"></script>

<script src="/js/sweetalert.min.js"></script>

<script src="/js/bootstrap-table-filter-control.js"></script>
<script src="/js/bootstrap-table-sticky-header.min.js"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

<!-- load up all the local formatters and stylers -->
<script src="/js/genetable.js"></script>
<script src="/js/filters.js"></script>
<script src="/js/bookmark.js"></script>

<script>
	/**
	**
	**		Globals
	**
	*/

	var $table = $('#table');
	var showadvanced = true;
	var report = "{{ env('CG_URL_CURATIONS_DOSAGE') }}";
    window.scrid = {{ $display_tabs['scrid'] }};
    window.token = "{{ csrf_token() }}";

	window.ajaxOptions = {
		beforeSend: function (xhr) {
			xhr.setRequestHeader('Authorization', 'Bearer ' + Cookies.get('clingen_dash_token'))
		}
	}

	/**
	 *
	 * Table response handler for updating page counters after data load
	 *
	 * */
	function responseHandler(res) {

		// update the counters
		$('.countCurations').html(res.ncurations);
		$('.countGenes').html(res.ngenes);
		$('.countRegions').html(res.nregions);
		//$('.countTriplo').html(res.ntriplo);
		return res
	}

	var choices=['Yes', 'No'];

	var hibin=['<= 10%', '<= 25%', '<= 50%', '<= 75%'];
	var plibin=['< 0.9', '>= 0.9'];
	var plofbin=['<= 0.2', '<= 0.35', '<= 1'];

	// HI bin
	function checkbin(text, value, field, data)
	{
		switch (text)
		{
			case '<= 10%':
				return value <= 10;
			case '<= 25%':
				return value <= 25;
			case '<= 50%':
				return value <= 50;
			case '<= 75%':
				return value <= 75;
			default:
				return true;
		}

		/*
		if (text == '<= 10')
			return value <= 10;
		else
			return value > 10;
		*/
	}


	function checkpli(text, value, field, data)
	{
		if (text == '< .9')
			return value < .9;
		else
			return value >= .9;
	}


	function checkplof(text, value, field, data)
	{
		switch (text)
		{
			case '<= 0.2':
				return value <= .2;
			case '<= 0.35':
				return value <= .35;
			case  '<= 1':
				return value <= 1;
			default:
				return true;
		}

		//console.log(value);
		/*if (text == '> .35')
			return value > .35;
		else
			return value <= .35;*/
	}

	var tripChoices=[
                '0 (No Evidence)',
                '1 (Little Evidence)',
                '2 (Emerging Evidence)',
                '3 (Sufficient Evidence)',
                '30 (Autosomal Recessive)',
                '40 (Dosage Sensitivity Unlikely)',
                'Not Yet Evaluated',
  ];
	var hapChoices=[
                '0 (No Evidence)',
                '1 (Little Evidence)',
                '2 (Emerging Evidence)',
                '3 (Sufficient Evidence)',
                '30 (Autosomal Recessive)',
                '40 (Dosage Sensitivity Unlikely)',
                'Not Yet Evaluated',
  ];


	function inittable() {
		$table.bootstrapTable('destroy').bootstrapTable({
            stickyHeader: true,
    stickyHeaderOffsetLeft: parseInt($('body').css('padding-left'), 10),
            stickyHeaderOffsetRight: parseInt($('body').css('padding-right'), 10),
			locale: 'en-US',
			sortName:  "symbol",
			sortOrder: "asc",
      		filterControlVisible: {{ $col_search['col_search'] === null ? "false" : "true" }},
			onCreatedControls () {
				var $select = $('select.bootstrap-table-filter-control-haplo_assertion');
				$select.attr('multiple','multiple');
				$select.find('option[value=""]').remove();
				$select.multipleSelect({
					filter: true,
					selectAll:true
				});
			},
	  		rowStyle:  function(row, index) {
				if (index % 2 === 0) {
     				return {
						classes: 'bt-even-row bt-hover-row'
					}
				}
				else {
     				return {
						classes: 'bt-odd-row bt-hover-row'
					}
				}
     		},
			columns: [
				{
					title: '',
					field: 'type',
					formatter: nullFormatter,
					cellStyle: typeFormatter,
					//filterControl: 'input',
					searchFormatter: false
					//sortable: true
				},
				{
					title: 'Gene/Region',
					field: 'symbol',
					formatter: symbolFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					width: 190,
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'HGNC/<br>Dosage ID',
					field: 'hgnc_id',
					formatter: hgncFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortable: true,
					visible: false
				},
				{
					title: 'Cytoband',
					field: 'location',
					//formatter: locationFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					visible: false,
					sortable: true
				},
				{
					title: 'GRCh37',
					field: 'grch37',
					formatter: locationFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					sorter: locationSorter,
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'GRCh38',
					field: 'grch38',
					formatter: location38Formatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					sorter: locationSorter,
					searchFormatter: false,
					visible: false,
					sortable: true
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="Haploinsufficiency score"></i></div>HI Score',
					field: 'haplo_assertion',
					formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					searchFormatter: false,
          			filterData: 'var:hapChoices',
          			filterDefault: "{{ $col_search['col_search'] === "haplo" ? $col_search['col_search_val'] : "" }}",
					sortable: true
				},
				{
					title: 'Haplo Disease',
					field: 'haplo_disease',
					//formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortable: true,
					visible: false
				},
				{
					title: 'Haplo Disease ID',
					field: 'haplo_disease_id',
					//formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortable: true,
					visible: false
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="Triplosensitivity score"></i></div>TS Score',
					field: 'triplo_assertion',
					formatter: triploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					searchFormatter: false,
          filterData: 'var:tripChoices',
          filterDefault: "{{ $col_search['col_search'] === "triplo" ? $col_search['col_search_val'] : "" }}",
					sortable: true
				},
				{
					title: 'Triplo Disease',
					field: 'triplo_disease',
					//formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortable: true,
					visible: false
				},
				{
					title: 'Triplo Disease ID',
					field: 'triplo_disease_id',
					//formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortable: true,
					visible: false
				},
				{
					title: 'OMIM',
					field: 'omim',
					formatter: omimFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					filterData: 'var:choices',
					searchFormatter: false,
					sortable: true
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="OMIM morbid map"></i></div>Morbid',
					field: 'morbid',
					formatter: morbidFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					filterData: 'var:choices',
					searchFormatter: false,
					sortable: true
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="DECIPHER Haploinsufficiency index.  Values less than 10% predict that a gene is more likely to exhibit haploinsufficiency."></i></div>%HI',
					field: 'hi',
					formatter: hiFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					filterData: 'var:hibin',
					filterCustomSearch: checkbin,
					searchFormatter: false,
					sortable: true
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="gnomAD pLI score.  Values greater than or equal to 0.9 indicate that a gene appears to be intolerant of loss of function variation."></i></div>pLI',
					field: 'pli',
					formatter: pliFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					filterData: 'var:plibin',
					filterCustomSearch: checkpli,
					searchFormatter: false,
					sortable: true
				},
				{
					title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="gnomAD predicted loss-of-function.  Values less than 0.35 indicate that a gene appears to be intolerant of loss of function variation."></i></div>LOEUF',
					field: 'plof',
					formatter: plofFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					filterData: 'var:plofbin',
					filterCustomSearch: checkplof,
					searchFormatter: false,
					sortable: true
				},
				{
					field: 'date',
					//title: 'Last Eval.',
          title: '<div><i class="fas fa-info-circle color-white" data-toggle="tooltip" data-placement="top" title="Last Evaluated"></i></div> Last Eval.',
					formatter: reportFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					searchFormatter: false,
					sortName: 'rawdate',
					sortable: true,
				}
			]
		});

		$table.on('load-error.bs.table', function (e, name, args) {

			$("body").css("cursor", "default");

			swal({
				title: "Load Error",
				text: "The system could not retrieve data from GeneGraph",
				icon: "error"
			});
		})

		$table.on('load-success.bs.table', function (e, name, args) {

			$("body").css("cursor", "default");
            window.update_addr();

			if (name.hasOwnProperty('error'))
			{
				swal({
					title: "Load Error",
					text: name.error,
					icon: "error"
				});
			}
		})

		var html = `@include("gene-dosage.panels.selector")`;

		$table.on('post-body.bs.table', function (e, name, args) {

			$('[data-toggle="tooltip"]').tooltip();

		})


		/*$table.on('click-cell.bs.table', function (event, field, value, row, $obj) {
			//console.log(e);
			event.preventDefault();
			event.stopPropagation();
			event.stopImmediatePropagation();

		});*/

		$table.on('expand-row.bs.table', function (e, index, row, $obj) {

			$obj.attr('colspan',12);

			var t = $obj.closest('tr');

			var stripe = t.prev().hasClass('bt-even-row');

			t.addClass('dosage-row-bottom');

			if (stripe)
				t.addClass('bt-even-row');
			else
				t.addClass('bt-odd-row');

			t.prev().addClass('dosage-row-top');

			$obj.load( "/api/dosage/expand/" + row.hgnc_id );

			return false;
		})


		$table.on('collapse-row.bs.table', function (e, index, row, $obj) {

			$obj.closest('tr').prev().removeClass('dosage-row-top');

			return false;
		});

	}


	$(function() {

		// Set cursor to busy prior to table init
		$("body").css("cursor", "progress");

		// initialize the table and load the data
		inittable();

		// make some mods to the search input field
		var search = $('.fixed-table-toolbar .search input');
		search.attr('placeholder', 'Search in table');

		$( ".fixed-table-toolbar" ).show();
    	$('[data-toggle="tooltip"]').tooltip();
    	//$('[data-toggle="popover"]').popover();

		var html = `@include("gene-dosage.panels.search")`;

		$(".fixed-table-toolbar .search .input-group").attr("style","width:800px;");
        $(".fixed-table-toolbar .search .input-group:first").attr("style","float:left; width:200px;");
		$(".fixed-table-toolbar .search .input-group:first").after(html);

		$("button[name='filterControlSwitch']").attr('title', 'Column Search');
		$("button[aria-label='Columns']").attr('title', 'Show/Hide More Columns');

        $('[data-toggle="popover"]').popover();

		region_listener();
/*
		$('button[name="clearSearch"]').click(function() {
			$('select.bootstrap-table-filter-control-city').multipleSelect('setSelects', [])
			filterData()
		})

		function customFilter(row,filter){
			const filterCities = filter['cities']
			return filterCities.length == 0 || filterCities.includes(row.city)
		}

		function filterData() {
			$table.bootstrapTable('filterBy', {
			cities: $('select.bootstrap-table-filter-control-city').multipleSelect('getSelects')
			}, {
			'filterAlgorithm': customFilter
			})
		}

		$('select.bootstrap-table-filter-control-halplo_assertion').change(function () {
			console.log("check1");
			filterData()
		})
*/
  	});

</script>

@endsection
