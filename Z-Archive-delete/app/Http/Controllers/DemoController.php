<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Ahsan\Neo4j\Facade\Cypher;




class DemoController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = '
            MATCH (n:Gene) 
            RETURN n,
            n.iri as iri,
            n.symbol as symbol
            LIMIT 100';

       $items = Cypher::run($query);

       //dd($items);
       $collection = collect();
       
       //echo "<pre>";
        foreach($items->records() as $item) {

            $collect = (object)[
                    'iri'           => $item->value('iri'),
                    'symbol'        => $item->value('symbol')
            ];

            //$collect = $item
            //$collect = collect($collect);
            $collection->push($collect);
            //print_r($items);
            //print_r($item);
             //echo ."<br/>";
         }
         $collection->all();
         //print_r($collection);
         

    		$display_tabs = collect([
    				'active'							=> "home",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);

         //print_r($display_tabs);
         //exit();
        return view('home', compact('display_tabs', 'collection', 'items'));
    }

    // Gene START
            public function geneIndex()
            {
            $display_tabs = collect([
                    'active'                            => "gene",
                    'query'                             => "",
                    'counts'    => [
                        'dosage'                        => "1434",
                    'gene_disease'          => "500",
                    'actionability'         => "270",
                    'variant_path'          => "300"]
            ]);
                return view('gene.index', compact('display_tabs'));
            }

            public function geneShow()
            {
            $display_tabs = collect([
                    'active'                            => "gene",
                    'query'                             => "BRCA2",
                    'counts'    => [
                        'dosage'                        => "434",
                        'gene_disease'                  => "500",
                        'actionability'                 => "270",
                        'variant_path'                  => "300"
                    ]
            ]);
                return view('gene.show', compact('display_tabs'));
            }
    // Gene END
    // ************************************************************************************************

    // Dosage START
		    public function dosageIndex()
		    {
    		$display_tabs = collect([
    				'active'							=> "dosage",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-dosage.index', compact('display_tabs'));
		    }

		    public function dosageShow()
		    {
            $display_tabs = collect([
                    'active'                            => "gene",
                    'query'                             => "BRCA2",
                    'counts'    => [
                        'dosage'                        => "1434",
                        'gene_disease'                  => "500",
                        'actionability'                 => "270",
                        'variant_path'                  => "300"
                    ]
            ]);
		        return view('gene-dosage.show', compact('display_tabs'));
		    }

		    public function dosageStats()
		    {
    		$display_tabs = collect([
    				'active'							=> "dosage",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-dosage.stats', compact('display_tabs'));
		    }

		    public function dosageReports()
		    {
    		$display_tabs = collect([
    				'active'							=> "dosage",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-dosage.reports', compact('display_tabs'));
		    }

		    public function dosageDownload()
		    {
    		$display_tabs = collect([
    				'active'							=> "dosage",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-dosage.download', compact('display_tabs'));
		    }
    // Dosage END
    // ************************************************************************************************

    // Gene Disease START
		    public function geneValidityIndex()
		    {
    		$display_tabs = collect([
    				'active'							=> "gene_disease",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-disease-validity.index', compact('display_tabs'));
		    }

		    public function geneValidityShow()
		    {
    		$display_tabs = collect([
    				'active'							=> "gene_disease",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('gene-disease-validity.show', compact('display_tabs'));
		    }
    // Gene Disease END
    // ************************************************************************************************

    // Actionability START
		    public function actionabilityIndex()
		    {
    		$display_tabs = collect([
    				'active'							=> "actionability",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('clinical-actionability.index', compact('display_tabs'));
		    }

		    public function actionabilityShow()
		    {
    		$display_tabs = collect([
    				'active'							=> "actionability",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('clinical-actionability.show', compact('display_tabs'));
		    }
    // Actionability END
    // ************************************************************************************************

    // Variant Path START
		    public function varaintPathIndex()
		    {
    		$display_tabs = collect([
    				'active'							=> "variant_path",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('variant-path.index', compact('display_tabs'));
		    }

		    public function varaintPathShow()
		    {
    		$display_tabs = collect([
    				'active'							=> "variant_path",
                    'query'                             => "",
    				'counts'	=> [
    					'dosage'						=> "1434",
    		    	'gene_disease'			=> "500",
    		    	'actionability'			=> "270",
    		    	'variant_path'			=> "300"]
    		]);
		        return view('variant-path.show', compact('display_tabs'));
		    }
    // Variant Path END
    // ************************************************************************************************
}
