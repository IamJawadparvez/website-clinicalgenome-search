function detailFormatter(t,a){return!1}function reportDetailFormatter(t,a,e){var s;return $.ajaxSetup({cache:!0,contentType:"application/x-www-form-urlencoded",processData:!0,headers:{"X-Requested-With":"XMLHttpRequest","X-CSRF-TOKEN":window.token,Authorization:"Bearer "+Cookies.get("clingen_dash_token")}}),$.ajax({url:"/api/home/rpex/"+a.ident,type:"get",dataType:"html",async:!1,success:function(t){s=t}}),s}function table_buttons(){return"undefined"!=typeof showadvanced&&showadvanced?{btnUsersAdd:{text:"Filters",icon:"glyphicon-tasks",event:function(){$("#modalFilter").modal("toggle")},attributes:{title:"Advanced Filters"}},btnAdd:{text:"Page Preferences",icon:"glyphicon-bookmark",event:function(){1!==window.auth?swal({title:"Page Preferences",text:"You must be logged in to manage page preferences."}):$("#modalBookmark").modal("toggle")},attributes:{title:"Page Preferences"}}}:"undefined"!=typeof bookmarksonly&&bookmarksonly?{btnUsersAdd:{text:"Page Preferences",icon:"glyphicon-bookmark",event:function(){1!==window.auth?swal({title:"Page Preferences",text:"You must be logged in to manage page preferemces."}):($("#modal-bookmark-status").html("&nbsp;"),$("#modal-new-bookmark").val(""),$("#bookmark-selected-preference").val(""),$("#modalBookmark").modal("toggle"))},attributes:{title:"Page Preferences"}}}:{}}function symbolFormatter(t,a){return 0==a.type||3==a.type?'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+a.hgnc_id+'"><b>'+a.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+a.hgnc_id+'"><b>'+a.symbol+"</b></a></span>"}function typeFormatter(t,a){return 0==a.type?{classes:"global_table_cell gene"}:3==a.type?{classes:"global_table_cell gene"}:{classes:"global_table_cell region"}}function nullFormatter(t,a){return 0==a.type?'<span title="Gene">G</span>':3==a.type?'<span title="Gene">P</span>':'<span title="Region">R</span>'}function geneFormatter(t,a){return'<a href="/kb/genes/'+a.hgnc_id+'"><b>'+a.symbol+"</b></a>"}function hgncFormatter(t,a){return 0==a.type||3==a.type?'<a href="/kb/gene-dosage/'+a.hgnc_id+'">'+a.hgnc_id+"</a>":'<a href="/kb/gene-dosage/region/'+a.hgnc_id+'">'+a.hgnc_id+"</a>"}function location01Formatter(t,a){if(null==a.location)return"";var e=a.location.trim();0===e.toLowerCase().indexOf("chr")&&(e=e.substring(3));var s=e.indexOf(":"),n=e.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+e.substring(0,s)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+e.substring(s+1,n)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+e.substring(n+1)+"</span></div>"}function locationFormatter(t,a){if(null==a.grch37)return"";var e=a.grch37.trim();0===e.toLowerCase().indexOf("chr")&&(e=e.substring(3));var s=e.indexOf(":"),n=e.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+e.substring(0,s)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+e.substring(s+1,n)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+e.substring(n+1)+"</span></div>"}function location38Formatter(t,a){if(null==a.grch38)return"";var e=a.grch38.trim();0===e.toLowerCase().indexOf("chr")&&(e=e.substring(3));var s=e.indexOf(":"),n=e.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+e.substring(0,s)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+e.substring(s+1,n)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+e.substring(n+1)+"</span></div>"}function regionFormatter(t,a){return'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+a.key+'"><b>'+a.name+"</b></a></span>"}function pliFormatter(t,a){return null===a.pli?"&hyphen;":a.pli>=.9?'<span class="format-pli-high">'+a.pli+"</span>":'<span class="format-pli-low">'+a.pli+"</span>"}function hiFormatter(t,a){return null===a.hi?"&hyphen;":a.hi<=10?'<span class="format-hi-high">'+a.hi+"</span>":'<span class="format-hi-low">'+a.hi+"</span>"}function plofFormatter(t,a){return null===a.plof?"&hyphen;":a.plof<=.35?'<span class="format-pli-high">'+a.plof+"</span>":'<span class="format-pli-low">'+a.plof+"</span>"}function haploFormatter(t,a){if(!1===a.haplo_assertion)return"";if("Not Yet Evaluated"==a.haplo_assertion)return'<span class="text-muted">Not Yet Evaluated</span>';var e=a.haplo_assertion;return null===a.haplo_history?e:'<span class="pointer text-danger" data-toggle="tooltip" data-placement="top" title="'+a.haplo_history+'"><b>'+e+'</b>  <i class="fas fa-comment"></i></span>'}function triploFormatter(t,a){if(!1===a.triplo_assertion)return"";if("Not Yet Evaluated"==a.triplo_assertion)return'<span class="text-muted">Not Yet Evaluated</span>';var e=a.triplo_assertion;return null===a.triplo_history?e:'<span class="pointer text-danger" data-toggle="tooltip" data-placement="top" title="'+a.triplo_history+'"><b>'+e+'</b>  <i class="fas fa-comment"></i></span>'}function omimFormatter(t,a){return a.omimlink?'<span onclick="event.stopPropagation();" ><a href="https://omim.org/entry/'+a.omimlink+'" > <span class="text-success"><i class="fas fa-check"></i></span></a></span>':""}function morbidFormatter(t,a){return"Yes"==a.morbid?'<span onclick="event.stopPropagation();" ><a href="https://omim.org/entry/'+a.omimlink+'" > <span class="text-success"><i class="fas fa-check"></i></span></a></span>':""}function reportFormatter(t,a){return 0==a.type||3==a.type?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/'+a.hgnc_id+'"><i class="fas fa-file"></i>   '+a.date+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+a.hgnc_id+'"><i class="fas fa-file"></i>   '+a.date+"</a></span>"}function iscaFormatter(t,a){return 0==a.type||3==a.type?'<a href="/kb/gene-dosage/'+a.hgnc_id+'">'+a.isca+"</a>":1==a.type?'<a href="/kb/gene-dosage/region/'+a.isca+'">'+a.isca+"</a>":a.isca}function cellFormatter(t,a){return{classes:"global_table_cell"}}function noExpCellFormatter(t,a){return{classes:"global_table_cell no-expand"}}function headerStyle(t){return"undefined"!=typeof lightstyle&&lightstyle?{}:{classes:"bg-secondary text-light header_class"}}function affiliateFormatter(t,a){return'<a href="/kb/affiliate/'+a.agent+'">'+a.label+"</a>"}function badgeFormatter(t,a){var e="";return a.has_validity?e+='<img class="" src="/images/clinicalValidity-on.png" title="Gene-Disease Validity" style="width:30px">':e+='<img class="" src="/images/clinicalValidity-off.png" title="Gene-Disease Validity" style="width:30px">',a.has_dosage?e+='<img class="" src="/images/dosageSensitivity-on.png" title="Dosage Sensitivity" style="width:30px">':e+='<img class="" src="/images/dosageSensitivity-off.png" title="Dosage Sensitivity" style="width:30px">',a.has_actionability?e+='<img class="" src="/images/clinicalActionability-on.png" title="Clinical Actionability" style="width:30px">':e+='<img class="" src="/images/clinicalActionability-off.png" title="Clinical Actionability" style="width:30px">',a.has_variant?e+='<img class="" src="/images/variantPathogenicity-on.png" title="Variant Pathogenicity" style="width:30px">':e+='<img class="" src="/images/variantPathogenicity-off.png" title="Variant Pathogenicity" style="width:30px">',a.has_pharma?e+='<img class="" src="/images/Pharmacogenomics-on.png" title="Pharmacogenomics" style="width:30px">':e+='<img class="" src="/images/Pharmacogenomics-off.png" title="Pharmacogenomics" style="width:30px">',e}function ashgncFormatter(t,a){return'<a href="/kb/genes/'+a.hgnc_id+'">'+a.hgnc_id+"</a>"}function asdiseaseFormatter(t,a){return'<a href="/kb/conditions/'+a.mondo+'">'+a.disease+"</a>"}function asmondoFormatter(t,a){return'<a href="/kb/conditions/'+a.mondo+'">'+a.mondo.replace("_",":")+"</a>"}function asbadgeFormatter(t,a){return'<a class="btn btn-default btn-block btn-classification" href="/kb/gene-validity/'+a.perm_id+'">'+a.classification+"</a>"}function datebadgeFormatter(t,a){return'<a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-validity/'+a.perm_id+'"><i class="glyphicon glyphicon-file"></i> '+a.released+"</a>"}function conditionFormatter(t,a){var e='<a href="/kb/conditions/'+a.curie+'"><strong>'+a.label+'</strong></a><div class="small text-dark">'+a.curie+" ";return 9==a.status&&(e+='<span class="badge bg-light text-muted border-1 text-normal small" title="MONARCH has deprecated this term">Obsolete Term</span>'),e+="</div>",null!=a.synonym&&(e+='<div class="text-sm text-muted">Synonym: '+a.synonym+"</div>"),e}function cbadgeFormatter(t,a){var e="";return a.has_validity?e+='<img class="" src="/images/clinicalValidity-on.png" title="Gene-Disease Validity" style="width:30px">':e+='<img class="" src="/images/clinicalValidity-off.png" title="Gene-Disease Validity" style="width:30px">',a.has_dosage?e+='<img class="" src="/images/dosageSensitivity-on.png" title="Dosage Sensitivity" style="width:30px">':e+='<img class="" src="/images/dosageSensitivity-off.png" title="Dosage Sensitivity" style="width:30px">',a.has_actionability?e+='<img class="" src="/images/clinicalActionability-on.png" title="Clinical Actionability" style="width:30px">':e+='<img class="" src="/images/clinicalActionability-off.png" title="Clinical Actionability" style="width:30px">',a.has_variant?e+='<img class="" src="/images/variantPathogenicity-on.png" title="Variant Pathogenicity" style="width:30px">':e+='<img class="" src="/images/variantPathogenicity-off.png" title="Variant Pathogenicity" style="width:30px">',a.has_pharma?e+='<img class="" src="/images/Pharmacogenomics-on.png" title="Pharmacogenomics" style="width:30px">':e+='<img class="" src="/images/Pharmacogenomics-off.png" title="Pharmacogenomics" style="width:30px">',e}function drsymbolFormatter(t,a){return'<a href="/kb/drugs/'+a.curie+'">RXNORM:'+a.curie+"</a>"}function drugFormatter(t,a){return'<a href="/kb/drugs/'+a.curie+'">'+a.label+"</a>"}function drPortalFormatter(t,a){return'<a target="external" href="https://bioportal.bioontology.org/ontologies/RXNORM?p=classes&conceptid='+a.curie+'" class="badge-info badge pointer ml-2">BioPortal <i class="fas fa-external-link-alt"></i></a>'}function drbadgeFormatter(t,a){var e="";return a.has_validity?e+='<img class="" src="/images/clinicalValidity-on.png" title="Gene-Disease Validity" style="width:30px">':e+='<img class="" src="/images/clinicalValidity-off.png" title="Gene-Disease Validity" style="width:30px">',a.has_dosage?e+='<img class="" src="/images/dosageSensitivity-on.png" title="Dosage Sensitivity" style="width:30px">':e+='<img class="" src="/images/dosageSensitivity-off.png" title="Dosage Sensitivity" style="width:30px">',a.has_actionability?e+='<img class="" src="/images/clinicalActionability-on.png" title="Clinical Actionability" style="width:30px">':e+='<img class="" src="/images/clinicalActionability-off.png" title="Clinical Actionability" style="width:30px">',a.has_variant?e+='<img class="" src="/images/variantPathogenicity-on.png" title="Variant Pathogenicity" style="width:30px">':e+='<img class="" src="/images/variantPathogenicity-off.png" title="Variant Pathogenicity" style="width:30px">',a.has_pharma?e+='<img class="" src="/images/Pharmacogenomics-on.png" title="Pharmacogenomics" style="width:30px">':e+='<img class="" src="/images/Pharmacogenomics-off.png" title="Pharmacogenomics" style="width:30px">',e}var terms={AD:"Autosomal Dominant",AR:"Autosomal Recessive",XL:"X-Linked",XLR:"X-linked recessive",MT:"Mitochondrial",SD:"Semidominant",Undetermined:"Undetermined MOI"};function moiFormatter(t,a){return'<span class="pointer" data-toggle="tooltip" data-placement="top" title="'+terms[a.moi]+'" ">'+a.moi+"</span>"}function hasvalidityFormatter(t,a){return null==a.has_validity?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasPharmaFormatter(t,a){return null==a.has_pharma?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasVariantFormatter(t,a){return null==a.has_variant?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="https://erepo.clinicalgenome.org/evrepo/ui/classifications?matchMode=exact&gene='+a.symbol+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Approved VCEP</span></a>'}function hasactionabilityFormatter(t,a){return null==a.has_actionability?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasdosageFormatter(t,a){return null==a.has_dosage?"":'<a class="btn btn-success  btn-wrap btn-sm pb-0 pt-0" href="/kb/genes/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>'}function hashaploFormatter(t,a){return a.has_dosage_haplo?'<a class="btn btn-success  btn-wrap btn-sm pb-0 pt-0" href="/kb/gene-dosage/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>':""}function hastriploFormatter(t,a){return a.has_dosage_triplo?'<a class="btn btn-success  btn-wrap btn-report btn-sm pb-0 pt-0" href="/kb/gene-dosage/'+a.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs"> Curated</span></a>':""}function region_listener(){$(".fixed-table-toolbar").on("click",".action-select-grch",function(){var t=$(this).attr("data-uuid");$(".action-select-text").html(t),$("#select-gchr").val(t)})}function cnvlocationFormatter(t,a){var e=a.location.trim();if(null==e)return"";0===e.toLowerCase().indexOf("chr")&&(e=e.substring(3));var s=e.indexOf(":"),n=e.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+e.substring(0,s)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+e.substring(s+1,n)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+e.substring(n+1)+"</span></div>"}var score_assertion_strings={0:"No Evidence",1:"Little Evidence",2:"Emerging Evidence",3:"Sufficient Evidence",30:"Autosomal Recessive",40:"Dosage Sensitivity Unlikely","Not yet evaluated":""};function cnvhaploFormatter(t,a){return!1===a.haplo_assertion?"":"Not yet evaluated"==a.haplo_assertion?'<span class="text-muted">Not Yet Evaluated</span>':a.haplo_assertion+" ("+score_assertion_strings[a.haplo_assertion]+")"}function cnvtriploFormatter(t,a){return!1===a.triplo_assertion?"":"Not yet evaluated"==a.triplo_assertion?'<span class="text-muted">Not Yet Evaluated</span>':a.triplo_assertion+" ("+score_assertion_strings[a.triplo_assertion]+")"}function cnvreportFormatter(t,a){return""===a.rawdate?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+a.key+'"><i class="fas fa-file"></i>  Under Review</a></span>':'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+a.key+'"><i class="fas fa-file"></i>   '+a.date+"</a></span>"}function acmsymbolFormatter(t,a){return'<a href="/kb/gene-dosage/'+a.hgnc_id+'"><b>'+a.gene+"</b></a>"}function acmomimFormatter(t,a){var e=a.omimgene.substring(a.omimgene.lastIndexOf("/")+1);return'<a href="'+a.omimgene+'">'+e+"</a>"}function acmomimsFormatter(t,a){var e="",s=a.omims.split(","),n=!1;return s.forEach(function(t){var a=t.trim();n&&(e+=", "),e+='<a href="https://omim.org/entry/'+a+'">'+a+"</a>",n=!0}),e}function acmpmidsFormatter(t,a){var e="",s=a.pmids.split(","),n=!1;return s.forEach(function(t){var a=t.trim();n&&(e+=", "),e+='<a href="https://ncbi.nlm.nih.gov/pubmed/'+a+'">'+a+"</a>",n=!0}),e}function acmhaploFormatter(t,a){return!1===a.haplo_assertion?"":score_assertion_strings[a.haplo_assertion]+" ("+a.haplo_assertion+")"}function acmtriploFormatter(t,a){return!1===a.triplo_assertion?"":score_assertion_strings[a.triplo_assertion]+" ("+a.triplo_assertion+")"}function acmreportFormatter(t,a){return'<a class="btn btn-block btn btn-default btn-xs" href="'+report+a.symbol+'"><i class="fas fa-file"></i>   '+a.date+"</a>"}function dsreportFormatter(t,a){var e="Awaiting Review"==a.workflow?"default":"success",s="";return 3==a.type&&(e="unreviewable",a.workflow="Not Reviewable",s="This gene will not be reviewed because it is a pseudogene"),0==a.type||3==a.type?null==a.hgnc_id?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+e+' btn-block" title="'+s+'" href="/kb/gene-dosage/'+a.isca+'"><i class="fas fa-file"></i>   '+a.workflow+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+e+' btn-block" title="'+s+'" href="/kb/gene-dosage/'+a.hgnc_id+'"><i class="fas fa-file"></i>   '+a.workflow+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+e+' btn-block" title="'+s+'" href="/kb/gene-dosage/region/'+a.isca+'"><i class="fas fa-file"></i>   '+a.workflow+"</a></span>"}function dssymbolFormatter(t,a){return 0==a.type||3==a.type?null==a.hgnc_id?'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+a.isca+'"><b>'+a.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+a.hgnc_id+'"><b>'+a.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+a.isca+'"><b>'+a.symbol+"</b></a></span>"}function relationFormatter(t,a){var e="";if(0==a.type?e+='<div class="global_table_cell font-weight-bold gene" title="Gene">G</div>':1==a.type?e+='<div class="global_table_cell font-weight-bold region" title="Region">R</div>':e+='<div class="global_table_cell font-weight-bold psuedogene" title="Pseudogene">P</div>',null===a.relationship)return e;var s=a.relationship.substring(0,1);return e+='<div class="global_table_cell font-weight-bold carryover mt-1 mb-1" title="'+a.relationship+'">'+s+"</div>"}function locationSorter(t,a){var e=t.match(/\d+|X|Y/g),s=a.match(/\d+|X|Y/g);return"X"==e[0]?e[0]=23:"Y"==e[0]?e[0]=24:e[0]=parseInt(e[0]),"X"==s[0]?s[0]=23:"Y"==s[0]?s[0]=24:s[0]=parseInt(s[0]),e[0]<s[0]?-1:e[0]>s[0]?1:(e[1]=parseInt(e[1]),s[1]=parseInt(s[1]),e[1]<s[1]?-1:e[1]>s[1]?1:(e[2]=parseInt(e[2]),s[2]=parseInt(s[2]),e[2]<s[2]?-1:1))}
