<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GeneLib;

/**
 *
 * @category   Web
 * @package    Search
 * @author     P. Weller <pweller1@geisinger.edu>
 * @author     S. Goehringer <scottg@creationproject.com>
 * @copyright  2020 ClinGen
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      Class available since Release 1.0.0
 *
 * */
class ConditionController extends Controller
{
	private $api = '/api/conditions';

    /**
     * Display a listing of all gene validity assertions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $page = 1, $size = 50, $search="")
    {
		// process request args
		foreach ($request->only(['page', 'size', 'order', 'sort', 'search']) as $key => $value)
			$$key = $value;

		// set display context for view
        $display_tabs = collect([
            'active' => "condition",
            'title' => "ClinGen Diseases"
        ]);

		return view('condition.index', compact('display_tabs'))
						->with('apiurl', $this->api)
						->with('pagesize', $size)
						->with('page', $page)
						->with('search', $search);
    }


    /**
	* Display the specified condition.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show(Request $request, $id = null)
	{
		$record = GeneLib::conditionDetail([ 
										'condition' => $id,
										'curations' => true,
										'action_scores' => true,
										'validity' => true,
										'dosage' => true
										]);

		if ($record === null)
			return view('error.message-standard')
						->with('title', 'Error retrieving Disease details')
						->with('message', 'The system was not able to retrieve details for this Disease.  Error message was: ' . GeneLib::getError() . '. Please return to the previous page and try again.')
						->with('back', url()->previous());


		// set display context for view
		$display_tabs = collect([
			'active' => "condition",
			'title' => $record->label . " curation results by ClinGen activity"
		]);
//dd($record);
		return view('condition.by-activity', compact('display_tabs', 'record'));
	}


	/**
	 * Display the specified condition.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show_by_gene(Request $request, $id = null)
	{
		$record = GeneLib::conditionDetail([
			'condition' => $id,
			'curations' => true,
			'action_scores' => true,
			'validity' => true,
			'dosage' => true
		]);

		if ($record === null)
			return view('error.message-standard')
						->with('title', 'Error retrieving Disease details')
						->with('message', 'The system was not able to retrieve details for this Disease.  Error message was: ' . GeneLib::getError() . '. Please return to the previous page and try again.')
						->with('back', url()->previous());


		// set display context for view
		$display_tabs = collect([
			'active' => "condition",
			'title' => $record->label . " curation results organized by gene"
		]);

		return view('condition.by-gene', compact('display_tabs', 'record'));
	}


	/**
	* Display the External Genomic Resources section of the specific condition..
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function external(Request $request, $id = null)
	{
		if ($id === null)
			return view('error.message-standard')
				->with('title', 'Error retrieving Disease details')
				->with('message', 'The system was not able to retrieve details for this Disease. Please return to the previous page and try again.')
				->with('back', url()->previous());


		$record = GeneLib::conditionDetail([
											'condition' => $id,
											'curations' => true,
											'action_scores' => true,
											'validity' => true,
											'dosage' => true
										]);

		if ($record === null)
			return view('error.message-standard')
						->with('title', 'Error retrieving Disease details')
						->with('message', 'The system was not able to retrieve details for this Disease.  Error message was: ' . GeneLib::getError() . '. Please return to the previous page and try again.')
						->with('back', url()->previous());

		// set display context for view
		$display_tabs = collect([
			'active' => "condition",
			'title' => $record->label . " Disease External Resources"
		]);

		return view('condition.show-external-resources', compact('display_tabs', 'record'));
	}


	/**
	* Display a listing of all genes.
	*
	* @return \Illuminate\Http\Response
	*/
	public function search(Request $request)
	{
		// process request args
		foreach ($request->only(['search']) as $key => $value)
			$$key = $value;

		// the way layouts is set up, everything is named search.  Condition is the second

		return redirect()->route('condition-index', ['page' => 1, 'size' => 50, 'search' => $search[1] ]);
	}
}
