<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel as Gexcel;

use App\Imports\Excel;
use App\Exports\ValidityExport;

use Auth;

require app_path() .  '/Helpers/helper.php';

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
class ValidityController extends Controller
{
    private $api = '/api/validity';
    private $user = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('api')->check())
                $this->user = Auth::guard('api')->user();
            return $next($request);
        });
    }


    /**
     * Display a listing of all gene validity assertions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $page = 1, $size = 50)
    {
		// process request args
		foreach ($request->only(['page', 'size', 'order', 'sort', 'search']) as $key => $value)
			$$key = $value;

		// set display context for view
        $display_tabs = collect([
            'active' => "validity",
            'title' => "ClinGen Gene-Disease Validity Curations"
        ]);

        $display_list = ($this->user === null ? 25 : $this->user->preferences['display_list'] ?? 25);

		return view('gene-validity.index', compact('display_tabs'))
						->with('apiurl', $this->api)
						->with('pagesize', $size)
						->with('page', $page)
                        ->with('user', $this->user)
                        ->with('display_list', $display_list);
    }


    /**
     * Display the specific gene validity report.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
		if ($id === null)
            return view('error.message-standard')
                ->with('title', 'Error retrieving Gene Validity details')
                ->with('message', 'The system was not able to retrieve details for this Disease. Please return to the previous page and try again.')
                ->with('back', url()->previous())
                ->with('user', $this->user);

		$record = GeneLib::validityDetail(['page' => 0,
										'pagesize' => 20,
										'perm' => $id
										 ]);

        if ($record === null)
                return view('error.message-standard')
                            ->with('title', 'Error retrieving Gene Validity details')
                            ->with('message', 'The system was not able to retrieve details for this Gene Validity.  Error message was: ' . GeneLib::getError() . '. Please return to the previous page and try again.')
                            ->with('back', url()->previous())
                            ->with('user', $this->user);

        // set display context for view
        $display_tabs = collect([
            'active' => "validity",
            'title' => $record->label . " curation results for Gene-Disease Validity"
        ]);

        return view('gene-validity.show', compact('display_tabs', 'record'))
                            ->with('user', $this->user);
	}


	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $date = date('Y-m-d');

		return Gexcel::download(new ValidityExport, 'Clingen-Gene-Disease-Summary-' . $date . '.csv');
    }
}
