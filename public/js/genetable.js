function detailFormatter(a,t){return!1}function reportDetailFormatter(a,t,s){var n;return $.ajaxSetup({cache:!0,contentType:"application/x-www-form-urlencoded",processData:!0,headers:{"X-Requested-With":"XMLHttpRequest","X-CSRF-TOKEN":window.token,Authorization:"Bearer "+Cookies.get("clingen_dash_token")}}),$.ajax({url:"/api/home/rpex/"+t.ident,type:"get",dataType:"html",async:!1,success:function(a){n=a}}),n}function table_buttons(){return"undefined"!=typeof showadvanced&&showadvanced?{btnUsersAdd:{text:"Filters",icon:"glyphicon-tasks",event:function(){$("#modalFilter").modal("toggle")},attributes:{title:"Advanced Filters"}}}:{}}function symbolFormatter(a,t){return 0==t.type||3==t.type?'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+t.hgnc_id+'"><b>'+t.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+t.hgnc_id+'"><b>'+t.symbol+"</b></a></span>"}function typeFormatter(a,t){return 0==t.type?{classes:"global_table_cell gene"}:3==t.type?{classes:"global_table_cell gene"}:{classes:"global_table_cell region"}}function nullFormatter(a,t){return 0==t.type?'<span title="Gene">G</span>':3==t.type?'<span title="Gene">P</span>':'<span title="Region">R</span>'}function geneFormatter(a,t){return'<a href="/kb/genes/'+t.hgnc_id+'"><b>'+t.symbol+"</b></a>"}function hgncFormatter(a,t){return 0==t.type||3==t.type?'<a href="/kb/gene-dosage/'+t.hgnc_id+'">'+t.hgnc_id+"</a>":'<a href="/kb/gene-dosage/region/'+t.hgnc_id+'">'+t.hgnc_id+"</a>"}function location01Formatter(a,t){if(null==t.location)return"";var s=t.location.trim();0===s.toLowerCase().indexOf("chr")&&(s=s.substring(3));var n=s.indexOf(":"),e=s.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+s.substring(0,n)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+s.substring(n+1,e)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+s.substring(e+1)+"</span></div>"}function locationFormatter(a,t){if(null==t.grch37)return"";var s=t.grch37.trim();0===s.toLowerCase().indexOf("chr")&&(s=s.substring(3));var n=s.indexOf(":"),e=s.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+s.substring(0,n)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+s.substring(n+1,e)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+s.substring(e+1)+"</span></div>"}function location38Formatter(a,t){if(null==t.grch38)return"";var s=t.grch38.trim();0===s.toLowerCase().indexOf("chr")&&(s=s.substring(3));var n=s.indexOf(":"),e=s.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+s.substring(0,n)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+s.substring(n+1,e)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+s.substring(e+1)+"</span></div>"}function regionFormatter(a,t){return'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+t.key+'"><b>'+t.name+"</b></a></span>"}function pliFormatter(a,t){return null===t.pli?"&hyphen;":t.pli>=.9?'<span class="format-pli-high">'+t.pli+"</span>":'<span class="format-pli-low">'+t.pli+"</span>"}function hiFormatter(a,t){return null===t.hi?"&hyphen;":t.hi<=10?'<span class="format-hi-high">'+t.hi+"</span>":'<span class="format-hi-low">'+t.hi+"</span>"}function plofFormatter(a,t){return null===t.plof?"&hyphen;":t.plof<=.35?'<span class="format-pli-high">'+t.plof+"</span>":'<span class="format-pli-low">'+t.plof+"</span>"}function haploFormatter(a,t){if(!1===t.haplo_assertion)return"";if("Not Yet Evaluated"==t.haplo_assertion)return'<span class="text-muted">Not Yet Evaluated</span>';var s=t.haplo_assertion;return null===t.haplo_history?s:'<span class="pointer text-danger" data-toggle="tooltip" data-placement="top" title="'+t.haplo_history+'"><b>'+s+'</b>  <i class="fas fa-comment"></i></span>'}function triploFormatter(a,t){if(!1===t.triplo_assertion)return"";if("Not Yet Evaluated"==t.triplo_assertion)return'<span class="text-muted">Not Yet Evaluated</span>';var s=t.triplo_assertion;return null===t.triplo_history?s:'<span class="pointer text-danger" data-toggle="tooltip" data-placement="top" title="'+t.triplo_history+'"><b>'+s+'</b>  <i class="fas fa-comment"></i></span>'}function omimFormatter(a,t){return t.omimlink?'<span onclick="event.stopPropagation();" ><a href="https://omim.org/entry/'+t.omimlink+'" > <span class="text-success"><i class="fas fa-check"></i></span></a></span>':""}function morbidFormatter(a,t){return"Yes"==t.morbid?'<span onclick="event.stopPropagation();" ><a href="https://omim.org/entry/'+t.omimlink+'" > <span class="text-success"><i class="fas fa-check"></i></span></a></span>':""}function reportFormatter(a,t){return 0==t.type||3==t.type?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/'+t.hgnc_id+'"><i class="fas fa-file"></i>   '+t.date+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+t.hgnc_id+'"><i class="fas fa-file"></i>   '+t.date+"</a></span>"}function iscaFormatter(a,t){return 0==t.type||3==t.type?'<a href="/kb/gene-dosage/'+t.hgnc_id+'">'+t.isca+"</a>":1==t.type?'<a href="/kb/gene-dosage/region/'+t.isca+'">'+t.isca+"</a>":t.isca}function cellFormatter(a,t){return{classes:"global_table_cell"}}function noExpCellFormatter(a,t){return{classes:"global_table_cell no-expand"}}function headerStyle(a){return"undefined"!=typeof lightstyle&&lightstyle?{}:{classes:"bg-secondary text-light header_class"}}function affiliateFormatter(a,t){return'<a href="/kb/affiliate/'+t.agent+'">'+t.label+"</a>"}function badgeFormatter(a,t){var s="";return t.has_validity?s+='<img class="" src="/images/clinicalValidity-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalValidity-off.png" style="width:30px">',t.has_dosage?s+='<img class="" src="/images/dosageSensitivity-on.png" style="width:30px">':s+='<img class="" src="/images/dosageSensitivity-off.png" style="width:30px">',t.has_actionability?s+='<img class="" src="/images/clinicalActionability-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalActionability-off.png" style="width:30px">',t.has_variant?s+='<img class="" src="/images/variantPathogenicity-on.png" style="width:30px">':s+='<img class="" src="/images/variantPathogenicity-off.png" style="width:30px">',t.has_pharma?s+='<img class="" src="/images/Pharmacogenomics-on.png" style="width:30px">':s+='<img class="" src="/images/Pharmacogenomics-off.png" style="width:30px">',s}function ashgncFormatter(a,t){return'<a href="/kb/genes/'+t.hgnc_id+'">'+t.hgnc_id+"</a>"}function asdiseaseFormatter(a,t){return'<a href="/kb/conditions/'+t.mondo+'">'+t.disease+"</a>"}function asmondoFormatter(a,t){return'<a href="/kb/conditions/'+t.mondo+'">'+t.mondo.replace("_",":")+"</a>"}function asbadgeFormatter(a,t){return'<a class="btn btn-default btn-block btn-classification" href="/kb/gene-validity/'+t.perm_id+'">'+t.classification+"</a>"}function datebadgeFormatter(a,t){return'<a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-validity/'+t.perm_id+'"><i class="glyphicon glyphicon-file"></i> '+t.released+"</a>"}function conditionFormatter(a,t){var s='<a href="/kb/conditions/'+t.curie+'"><strong>'+t.label+'</strong></a><div class="small text-dark">'+t.curie+" ";return 9==t.status&&(s+='<span class="badge bg-light text-muted border-1 text-normal small" title="MONARCH has deprecated this term">Obsolete Term</span>'),s+="</div>",null!=t.synonym&&(s+='<div class="text-sm text-muted">'+t.synonym+"</div>"),s}function cbadgeFormatter(a,t){var s="";return t.has_validity?s+='<img class="" src="/images/clinicalValidity-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalValidity-off.png" style="width:30px">',t.has_dosage?s+='<img class="" src="/images/dosageSensitivity-on.png" style="width:30px">':s+='<img class="" src="/images/dosageSensitivity-off.png" style="width:30px">',t.has_actionability?s+='<img class="" src="/images/clinicalActionability-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalActionability-off.png" style="width:30px">',t.has_variant?s+='<img class="" src="/images/variantPathogenicity-on.png" style="width:30px">':s+='<img class="" src="/images/variantPathogenicity-off.png" style="width:30px">',t.has_pharma?s+='<img class="" src="/images/Pharmacogenomics-on.png" style="width:30px">':s+='<img class="" src="/images/Pharmacogenomics-off.png" style="width:30px">',s}function drsymbolFormatter(a,t){return'<a href="/kb/drugs/'+t.curie+'">RXNORM:'+t.curie+"</a>"}function drugFormatter(a,t){return'<a href="/kb/drugs/'+t.curie+'">'+t.label+"</a>"}function drPortalFormatter(a,t){return'<a target="external" href="https://bioportal.bioontology.org/ontologies/RXNORM?p=classes&conceptid='+t.curie+'" class="badge-info badge pointer ml-2">BioPortal <i class="fas fa-external-link-alt"></i></a>'}function drbadgeFormatter(a,t){var s="";return t.has_validity?s+='<img class="" src="/images/clinicalValidity-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalValidity-off.png" style="width:30px">',t.has_dosage?s+='<img class="" src="/images/dosageSensitivity-on.png" style="width:30px">':s+='<img class="" src="/images/dosageSensitivity-off.png" style="width:30px">',t.has_actionability?s+='<img class="" src="/images/clinicalActionability-on.png" style="width:30px">':s+='<img class="" src="/images/clinicalActionability-off.png" style="width:30px">',t.has_variant?s+='<img class="" src="/images/variantPathogenicity-on.png" style="width:30px">':s+='<img class="" src="/images/variantPathogenicity-off.png" style="width:30px">',t.has_pharma?s+='<img class="" src="/images/Pharmacogenomics-on.png" style="width:30px">':s+='<img class="" src="/images/Pharmacogenomics-off.png" style="width:30px">',s}var terms={AD:"Autosomal Dominant",AR:"Autosomal Recessive",XL:"X-Linked",XLR:"X-linked recessive",MT:"Mitochondrial",SD:"Semidominant",Undetermined:"Undetermined MOI"};function moiFormatter(a,t){return'<span class="pointer" data-toggle="tooltip" data-placement="top" title="'+terms[t.moi]+'" ">'+t.moi+"</span>"}function hasvalidityFormatter(a,t){return null==t.has_validity?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasPharmaFormatter(a,t){return null==t.has_pharma?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasVariantFormatter(a,t){return null==t.has_variant?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="https://erepo.clinicalgenome.org/evrepo/ui/classifications?matchMode=exact&gene='+t.symbol+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Approved VCEP</span></a>'}function hasactionabilityFormatter(a,t){return null==t.has_actionability?"":'<a class="btn btn-success btn-sm pb-0 pt-0" href="/kb/genes/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i>  <span class="hidden-sm hidden-xs">Curated</span></a>'}function hasdosageFormatter(a,t){return null==t.has_dosage?"":'<a class="btn btn-success  btn-wrap btn-sm pb-0 pt-0" href="/kb/genes/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>'}function hashaploFormatter(a,t){return t.has_dosage_haplo?'<a class="btn btn-success  btn-wrap btn-sm pb-0 pt-0" href="/kb/gene-dosage/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs">Curated</span></a>':""}function hastriploFormatter(a,t){return t.has_dosage_triplo?'<a class="btn btn-success  btn-wrap btn-report btn-sm pb-0 pt-0" href="/kb/gene-dosage/'+t.hgnc_id+'"><i class="glyphicon glyphicon-file"></i> <span class="hidden-sm hidden-xs"> Curated</span></a>':""}function region_listener(){$(".fixed-table-toolbar").on("click",".action-select-grch",function(){var a=$(this).attr("data-uuid");$(".action-select-text").html(a),$("#select-gchr").val(a)})}function cnvlocationFormatter(a,t){var s=t.location.trim();if(null==s)return"";0===s.toLowerCase().indexOf("chr")&&(s=s.substring(3));var n=s.indexOf(":"),e=s.indexOf("-");return'<div class="position"><span aria-label="Chromosome" class="chr">'+s.substring(0,n)+'</span><span aria-label=" at " class="sr-only">:</span><span class="start">'+s.substring(n+1,e)+'</span><span aria-label=" to " class="sr-only">-</span><span class="end">'+s.substring(e+1)+"</span></div>"}var score_assertion_strings={0:"No Evidence",1:"Little Evidence",2:"Emerging Evidence",3:"Sufficient Evidence",30:"Autosomal Recessive",40:"Dosage Sensitivity Unlikely","Not yet evaluated":""};function cnvhaploFormatter(a,t){return!1===t.haplo_assertion?"":"Not yet evaluated"==t.haplo_assertion?'<span class="text-muted">Not Yet Evaluated</span>':t.haplo_assertion+" ("+score_assertion_strings[t.haplo_assertion]+")"}function cnvtriploFormatter(a,t){return!1===t.triplo_assertion?"":"Not yet evaluated"==t.triplo_assertion?'<span class="text-muted">Not Yet Evaluated</span>':t.triplo_assertion+" ("+score_assertion_strings[t.triplo_assertion]+")"}function cnvreportFormatter(a,t){return""===t.rawdate?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+t.key+'"><i class="fas fa-file"></i>  Under Review</a></span>':'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-success btn-block btn-report" href="/kb/gene-dosage/region/'+t.key+'"><i class="fas fa-file"></i>   '+t.date+"</a></span>"}function acmsymbolFormatter(a,t){return'<a href="/kb/gene-dosage/'+t.hgnc_id+'"><b>'+t.gene+"</b></a>"}function acmomimFormatter(a,t){var s=t.omimgene.substring(t.omimgene.lastIndexOf("/")+1);return'<a href="'+t.omimgene+'">'+s+"</a>"}function acmomimsFormatter(a,t){var s="",n=t.omims.split(","),e=!1;return n.forEach(function(a){var t=a.trim();e&&(s+=", "),s+='<a href="https://omim.org/entry/'+t+'">'+t+"</a>",e=!0}),s}function acmpmidsFormatter(a,t){var s="",n=t.pmids.split(","),e=!1;return n.forEach(function(a){var t=a.trim();e&&(s+=", "),s+='<a href="https://ncbi.nlm.nih.gov/pubmed/'+t+'">'+t+"</a>",e=!0}),s}function acmhaploFormatter(a,t){return!1===t.haplo_assertion?"":score_assertion_strings[t.haplo_assertion]+" ("+t.haplo_assertion+")"}function acmtriploFormatter(a,t){return!1===t.triplo_assertion?"":score_assertion_strings[t.triplo_assertion]+" ("+t.triplo_assertion+")"}function acmreportFormatter(a,t){return'<a class="btn btn-block btn btn-default btn-xs" href="'+report+t.symbol+'"><i class="fas fa-file"></i>   '+t.date+"</a>"}function dsreportFormatter(a,t){var s="Awaiting Review"==t.workflow?"default":"success",n="";return 3==t.type&&(s="unreviewable",t.workflow="Not Reviewable",n="This gene will not be reviewed because it is a pseudogene"),0==t.type||3==t.type?null==t.hgnc_id?'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+s+' btn-block" title="'+n+'" href="/kb/gene-dosage/'+t.isca+'"><i class="fas fa-file"></i>   '+t.workflow+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+s+' btn-block" title="'+n+'" href="/kb/gene-dosage/'+t.hgnc_id+'"><i class="fas fa-file"></i>   '+t.workflow+"</a></span>":'<span onclick="event.stopPropagation();" ><a class="btn btn-xs btn-'+s+' btn-block" title="'+n+'" href="/kb/gene-dosage/region/'+t.isca+'"><i class="fas fa-file"></i>   '+t.workflow+"</a></span>"}function dssymbolFormatter(a,t){return 0==t.type||3==t.type?null==t.hgnc_id?'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+t.isca+'"><b>'+t.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/genes/'+t.hgnc_id+'"><b>'+t.symbol+"</b></a></span>":'<span onclick="event.stopPropagation();" ><a href="/kb/gene-dosage/region/'+t.isca+'"><b>'+t.symbol+"</b></a></span>"}function relationFormatter(a,t){var s="";if(0==t.type?s+='<div class="global_table_cell font-weight-bold gene" title="Gene">G</div>':1==t.type?s+='<div class="global_table_cell font-weight-bold region" title="Region">R</div>':s+='<div class="global_table_cell font-weight-bold psuedogene" title="Pseudogene">P</div>',null===t.relationship)return s;var n=t.relationship.substring(0,1);return s+='<div class="global_table_cell font-weight-bold carryover mt-1 mb-1" title="'+t.relationship+'">'+n+"</div>"}function locationSorter(a,t){var s=a.match(/\d+|X|Y/g),n=t.match(/\d+|X|Y/g);return"X"==s[0]?s[0]=23:"Y"==s[0]?s[0]=24:s[0]=parseInt(s[0]),"X"==n[0]?n[0]=23:"Y"==n[0]?n[0]=24:n[0]=parseInt(n[0]),s[0]<n[0]?-1:s[0]>n[0]?1:(s[1]=parseInt(s[1]),n[1]=parseInt(n[1]),s[1]<n[1]?-1:s[1]>n[1]?1:(s[2]=parseInt(s[2]),n[2]=parseInt(n[2]),s[2]<n[2]?-1:1))}
