@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-5">
      <table class="mt-3 mb-2">
        <tr>
          <td class="valign-top"><img src="/images/dosageSensitivity-on.png" width="40" height="40"></td>
          <td class="pl-2"><h1 class="h2 p-0 m-0">  Dosage Sensitivity</h1>
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
					<li class="text-stats line-tight text-center pl-3 pr-3"><span class="countCurations text-18px"><i class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Curations</li>
					<li class="text-stats line-tight text-center pl-3 pr-3"><span class="countGenes text-18px"><i class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Genes</li>
					<li class="text-stats line-tight text-center pl-3 pr-3"><span class="countRegions text-18px"><i class="glyphicon glyphicon-refresh text-18px text-muted"></i></span><br />Total<br />Regions</li>
					{{-- <li class="text-stats line-tight text-center pl-3 pr-3"><div class="btn-group p-0 m-0" style="display: block"><a class="dropdown-toggle pointer text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-download text-18px"></i><br />Download<br />Options
					</a>
						<ul class="dropdown-menu dropdown-menu-left">
							<li><a href="{{ route('dosage-download') }}">Summary Data (CSV)</a></li>
							<li><a href="{{ route('dosage-ftp') }}">Additional Data (FTP)</a></li>
						</ul>
					</li>
					<li class="text-stats line-tight text-center pl-3 pr-3"><div class="btn-group p-0 m-0" style="display: block"><a class="dropdown-toggle pointer text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-list-alt text-18px text-muted"></i><br />ACMG<br />CNV
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

		{{-- <div class="collapse" id="collapseExample">
			<div class="row">
			  <div class="col-sm-12  mt-0 pt-0 small">
				<div class="info_panel">
					<h3 style="color: #985735; font-weight: bold; font-size: 1.3em">About Our Data</h3>
					<p>This study makes use of data generated by the DECIPHER community. A full list of centres who contributed to the generation of the data is available from https://decipher.sanger.ac.uk/about/stats and via email from decipher@sanger.ac.uk. Funding for the DECIPHER project was provided by Wellcome.  DECIPHER: Database of Chromosomal Imbalance and Phenotype in Humans using Ensembl Resources. Firth, H.V. et al., 2009. Am.J.Hum.Genet 84, 524-533 (DOI: dx.doi.org/10/1016/j.ajhg.2009.03.010)
					</p>
				</div>
			  </div>
			</div>
		</div> --}}


		<div class="col-md-12 light-arrows">

			@include('_partials.genetable')

			<hr />
			<h6>About Our Data</h6>
			<p class="small">This study makes use of data generated by the DECIPHER community. A full list of centres who contributed to the generation of the data is available from https://decipher.sanger.ac.uk/about/stats and via email from decipher@sanger.ac.uk. Funding for the DECIPHER project was provided by Wellcome. DECIPHER: Database of Chromosomal Imbalance and Phenotype in Humans using Ensembl Resources. Firth, H.V. et al., 2009. Am.J.Hum.Genet 84, 524-533 (DOI: dx.doi.org/10/1016/j.ajhg.2009.03.010)</p>

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

@endsection


@section('script_js')

<link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/addrbar/bootstrap-table-addrbar.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/filter-control/bootstrap-table-filter-control.css">
<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/filter-control/bootstrap-table-filter-control.js"></script>

<!-- load up all the local formatters and stylers -->
<script src="/js/genetable.js"></script>

<script>

	/**
	**
	**		Globals
	**
	*/

	var $table = $('#table');
	var showadvanced = true;
	var report = "{{ env('CG_URL_CURATIONS_DOSAGE') }}";

	/**
	 *
	 * Listener for displaying only genes
	 *
	 * */
	$('.action-show-genes-btn').on('click', function() {
		var viz = [];

		if ($(this).find('.action-show-genes').hasClass('fa-toggle-on'))
		{
			$(this).find('.action-show-genes').removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-genes-text').html('Off')
		}
		else
		{
			viz.push(0);
			$(this).find('.action-show-genes').removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-genes-text').html('On')
		}

		if ($('.action-show-regions').hasClass('fa-toggle-on'))
			viz.push(1);

		$table.bootstrapTable('filterBy', {
				type: viz
		});
	});


	/**
	 *
	 * Listener for displaying only regions
	 *
	 * */
	$('.action-show-regions-btn').on('click', function() {
		var viz = [];
		if ($('.action-show-genes').hasClass('fa-toggle-on'))
			viz.push(0);

		if ($(this).find('.action-show-regions').hasClass('fa-toggle-on'))
		{
			$(this).find('.action-show-regions').removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-regions-text').html('Off')
		}
		else
		{
			viz.push(1);
			$(this).find('.action-show-regions').removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-regions-text').html('On')
		}

		$table.bootstrapTable('filterBy', {
					type: viz
		});
	});


	/**
	 *
	 * Listener for displaying only the known HI
	 *
	 * */
	 $('.action-show-hiknown').on('click', function() {

		if ($(this).hasClass('fa-toggle-off'))
		{
			$table.bootstrapTable('filterBy', {haplo_assertion: 'Sufficient Evidence (3)'});

			$(this).removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-hiknown-text').html('On');

		}
		else
		{
			$table.bootstrapTable('filterBy', {type: [0, 1]});

			$(this).removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-hiknown-text').html('Off');

		}
	});


	/**
	 *
	 * Listener for displaying only the known TS
	 *
	 * */
	 $('.action-show-tsknown').on('click', function() {

		if ($(this).hasClass('fa-toggle-off'))
		{
			$table.bootstrapTable('filterBy', {triplo_assertion: 'Sufficient Evidence (3)'});

			$(this).removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-tsknown-text').html('On');

		}
		else
		{
			$table.bootstrapTable('filterBy', {type: [0, 1]});

			$(this).removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-tsknown-text').html('Off');

		}
	});


	/**
	 *
	 * Listener for displaying only the recent score changes
	 *
	 * */
	$('.action-show-new').on('click', function() {
		var viz = [];

		if ($(this).hasClass('fa-toggle-off'))
		{
			$table.bootstrapTable('filterBy', {thr: 1, hhr: 1}, {'filterAlgorithm': 'or'});

			$(this).removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-regions-text').html('On');

		}
		else
		{
			$table.bootstrapTable('filterBy', {thr: [0, 1]}, {'filterAlgorithm': 'or'});

			$(this).removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-regions-text').html('Off');

		}

		// 'filterAlgorithm': function (){ return true;}
	});


	/**
	 *
	 * Listener for displaying only the recent reviewed items
	 *
	 * */
	 $('.action-show-recent').on('click', function() {

		if ($(this).hasClass('fa-toggle-off'))
		{
			$table.bootstrapTable('filterBy', {type: [0, 1]}, {'filterAlgorithm': monthFilter});

			$(this).removeClass('fa-toggle-off').addClass('fa-toggle-on');
			$('.action-show-recent-text').html('On');

		}
		else
		{
			$table.bootstrapTable('filterBy', {thr: [0, 1]}, {'filterAlgorithm': 'or'});
			$(this).removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$('.action-show-recent-text').html('Off');

		}
	});

	var timestamp = new Date().getTime() - (12 * 30 * 24 * 60 * 60 * 1000);

	function monthFilter(rows, filters)
	{
		return Date.parse(rows.rawdate) > timestamp;
	}


	/**
	 *
	 * Table response handler for updating page counters after data load
	 *
	 * */
	function responseHandler(res) {

		// update the counters
		$('.countCurations').html(res.total);
		$('.countGenes').html(res.ngenes);
		$('.countRegions').html(res.nregions);
		//$('.countTriplo').html(res.ntriplo);
		return res
	}


	function inittable() {
		$table.bootstrapTable('destroy').bootstrapTable({
			locale: 'en-US',
			sortName:  "symbol",
			sortOrder: "asc",
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
					title: 'Gene/<br>Region',
					field: 'symbol',
					formatter: symbolFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					width: 200,
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'HGNC',
					field: 'hgnc',
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
					field: 'GRCh37_position',
					formatter: locationFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					sorter: locationSorter,
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'GRCh38',
					field: 'GRCh38_position',
					formatter: location38Formatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					sorter: locationSorter,
					searchFormatter: false,
					visible: false,
					sortable: true
				},
				{
					title: 'Haplo-<br>insufficiency',
					field: 'haplo_assertion',
					formatter: haploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					align: "center",
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'Triplo-<br>sensitity',
					field: 'triplo_assertion',
					formatter: triploFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					align: "center",
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'OMIM',
					field: 'omimlimk',
					formatter: omimFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					align: 'center',
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'Morbid',
					field: 'morbid',
					formatter: morbidFormatter,
					cellStyle: cellFormatter,
					filterControl: 'select',
					align: 'center',
					searchFormatter: false,
					sortable: true
				},
				{
					title: '%HI',
					field: 'hi',
					formatter: hiFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					align: 'center',
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'pLI',
					field: 'pli',
					formatter: pliFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					align: 'center',
					searchFormatter: false,
					sortable: true
				},
				{
					title: 'LO<br>EUF',
					field: 'plof',
					formatter: plofFormatter,
					cellStyle: cellFormatter,
					filterControl: 'input',
					align: 'center',
					searchFormatter: false,
					sortable: true
				},
				{
					field: 'date',
					title: 'Last Eval.',
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
			console.log("error fired");

			$("body").css("cursor", "default");

			swal({
				title: "Load Error",
				text: "The system could not retrieve data from GeneGraph",
				icon: "error"
			});
		})

		$table.on('load-success.bs.table', function (e, name, args) {
			console.log("success fired");

			$("body").css("cursor", "default");

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


		$table.on('expand-row.bs.table', function (e, index, row, $obj) {

			// split the object
			$obj.attr('colspan',10);
			$obj.addClass("bg-white");
			if (row.type == 0)
				$obj.before('<td class="gene"></td>');
			else
				$obj.before('<td class="region"></td>');
			$obj.closest('tr').css('border-bottom', '2px solid black');


			//$obj.addClass('detail-table-shade');
			$obj.load( "api/dosage/expand/" + row.hgnc_id );

			return false;
		})

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
    	$('[data-toggle="popover"]').popover();

		var html = `@include("gene-dosage.panels.search")`;

		$(".fixed-table-toolbar .search .input-group").attr("style","width:800px;");
        $(".fixed-table-toolbar .search .input-group:first").attr("style","float:left; width:200px;");
		$(".fixed-table-toolbar .search .input-group:first").after(html);

		region_listener();

  	});

</script>

@endsection
