
<!DOCTYPE html>
<html>
<head>

	<meta charset=utf-8 />
	<title>Yet Another DataTables Column Filter (yadcf) Showcase</title>
	<link href="resources/css/chosen.min.css" rel="stylesheet" type="text/css" />
	
	<link href="resources/css/jquery.dataTables.10.min.css" rel="stylesheet" type="text/css"></link>
	<link href="resources/css/dataTables.colVis.css" rel="stylesheet" type="text/css"></link>
	<link href="resources/css/dataTables.jqueryui.css" rel="stylesheet" type="text/css"></link>
	<link href="resources/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
	<link href="resources/css/jquery-ui.1.9.0.css" rel="stylesheet" type="text/css" />
	<link href="resources/css/fixedHeader.dataTables.min.css" rel="stylesheet" type="text/css" />	
	<link href="resources/css/jquery.dataTables.yadcf.css" rel="stylesheet" type="text/css" />
	<link href="resources/css/shCore.css" rel="stylesheet" type="text/css" />
	<link href="resources/css/shThemeDefault.css" rel="stylesheet" type="text/css" />
	<link href="resources/css/main.css" rel="stylesheet" type="text/css" />
		
	<script src="resources/js/jquery-1.8.2.min.js"></script>
	<script src="resources/js/jquery-ui.1.9.0.js"></script>
	<script src="resources/js/chosen.jquery.min.js"></script>
	<script src="resources/js/jquery.dataTables.10.min.js"></script>
	<script src="resources/js/dataTables.fixedHeader.min.js"></script>
	<script src="resources/js/dataTables.responsive.js"></script>
	<script src="resources/js/dataTables.jqueryui.js"></script>
	<script src="resources/js/dataTables.colVis.js"></script>
	<script src="resources/js/jquery.dataTables.yadcf.js"></script>
	<script src="resources/js/dom_ajax_multiple_1.10_example.js"></script>
	<script type="text/javascript" src="resources/js/shCore.js"></script>
	<script type="text/javascript" src="resources/js/shBrushJScript.js"></script>
	
	<style>
		.label {
			padding: 0px 10px 0px 10px;
			border: 1px solid #ccc;
			-moz-border-radius: 1em; /* for mozilla-based browsers */
			-webkit-border-radius: 1em; /* for webkit-based browsers */
			border-radius: 1em; /* theoretically for *all* browsers*/
		}
		
		.label.lightblue {
			background-color: #99CCFF;
		}
		
		#external_filter_container_wrapper {
		  margin-bottom: 20px;
		}
		
		#external_filter_container {
		  display: inline-block;
		}
			
	</style>
	

</head>
 <body>
	<a href="https://github.com/vedmack/yadcf" target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub"></a>
	<div id="header">
		<div>
			<span class="top-nav">
		  		<a href="DOM_source.html">DOM source</a>
		  	</span>	
			<span class="top-nav">
		  		<a href="DOM_source_chosen.html">DOM source with chosen</a>
		  	</span>
			<span class="top-nav">
		  		<a href="DOM_source_select2.html">DOM source with select2</a>
		  	</span>
			<span>
		  		<a href="dom_multi_columns_tables_1.10.html">DOM source multiple columns/tables</a>
		  	</span>	  	
		</div>
		<div>
			<span class="top-nav">
		  		<a href="ajax_source.html">AJAX source</a>
		  	</span>
		  	<span class="top-nav">
		  		<a href="ajax_mData_source.html">AJAX mData (deep)</a>
		  	</span>
			<span class="top-nav">
		  		<a href="multiple_tables.html">Multiple tables</a>
		  	</span>
			<span class="top-nav">
		  		<a href="server_side_source.html">Server-side 1.10</a>
		  	</span>
			<span class="top-nav">
		  		<a href="dom_source_externally_triggered.html">Externally triggered filters</a>
		  	</span>	
			<span>
		  		<a href="dom_source_externally_triggered.html">Externally triggered filters</a>
		  	</span>		  	
		  </div>
	</div>
	<div id="git_buttons">
		<div class="like-star-want-fork-also-follow">
			<span>Like it? Star it!</span>
			<span>Want it? Fork it!</span>
			<span>And also follow ;)</span>
		</div>	
		<iframe src="http://ghbtns.com/github-btn.html?user=vedmack&repo=yadcf&type=watch&count=true"
			allowtransparency="true" frameborder="0" scrolling="0" width="150" height="30" style="vertical-align: middle"></iframe>
			
		<iframe src="http://ghbtns.com/github-btn.html?user=vedmack&repo=yadcf&type=fork&count=true"
			allowtransparency="true" frameborder="0" scrolling="0" width="150" height="30" style="vertical-align: middle"></iframe>
			
		<iframe src="http://ghbtns.com/github-btn.html?user=vedmack&type=follow&count=true"
			allowtransparency="true" frameborder="0" scrolling="0" width="270" height="30" style="vertical-align: middle"></iframe>				
	 
	  	<a href="https://twitter.com/danielreznick" class="twitter-follow-button" data-show-count="false" >Follow @danielreznick</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

					
		<a href="https://twitter.com/share" class="twitter-share-button" data-via="danielreznick" data-count="none">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					
	</div>		
	
	<div id="my-other-plugin">
		<a href="http://feedback-me.appspot.com/">Check out my other jQuery plug-in: Feedback Me</a><a href="http://vedmack.github.io/angular-colorpicker/">Check out my AngularJS Directive: Color Picker</a>
	</div>

   	<div class="container_wrapper">
   	 	<div id="description">
	   	 	<h1>Yet Another DataTables Column Filter (yadcf) 0.9.1</h1>
	   	 	<h1 id="desc_example">DOM / Ajax / Multiple 1.10.0 example</h1>
	   	 	<p id="desc_p">This jQuery plug-in allows the user to easily add filter components to table columns, the plug-in works on top of the DataTables jQuery plug-in.</p>
   	 		<div id="download_btn_wrapper">
				<a href="https://github.com/vedmack/yadcf/releases" class="some_btn download_btn">
					Downloads
				</a>
				<a href="https://github.com/vedmack/yadcf/blob/master/ChangeLog.markdown" class="some_btn changelog_btn">
					Change log
				</a>
			</div>		   	 	
   	 	</div>
   	 	<div id="local_hrefs" class='hide'>
   	 		<a href="#features">Features</a>
			<a href="#source_code">View source</a>
			<a href="#all_params">All params</a>
   	 	</div>
  		<div class="container">
	      <div id="external_filter_container_wrapper" class="">
	        <label>yadcf.initMultipleTables:</label>
	        <span id="multi-table-filter"></span>
	      </div>
		  <div id="table_1">
			  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
				  <tr>
					<th>Some Data</th>
					<th>Numbers</th>
					<th>Dates</th>
					<th>Values</th>
					<th>Tags</th>
				  </tr>
				</thead>
				<tbody>
				  <tr class="odd gradeX">
					<td>Some Data 1</td>
					<td>1000</td>
					<td>01/24/2014</td>
					<td>a_value,b_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="even gradeC">
					<td>Some Data 2</td>
					<td>22</td>
					<td>02/20/2014</td>
					<td>b_value,c_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag3</span></td>
				  </tr>
				  <tr class="odd gradeA">
					<td>Some Data 3</td>
					<td>33</td>
					<td>02/26/2014</td>
					<td>a_value</td>
					<td><span class="label lightblue">Tag2</span><span class="label lightblue">Tag3</span></td>
				  </tr>
				  <tr class="even gradeA">
					<td>Some Data 4</td>
					<td>44</td>
					<td>02/11/2014</td>
					<td>b_value</td>
					<td><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="odd gradeA">
					<td>Some Data 5</td>
					<td>55</td>
					<td>02/29/2014</td>
					<td>a_value,b_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="even gradeA">
					<td>Some Data 1</td>
					<td>111</td>
					<td>11/24/2014</td>
					<td>c_value,d_value</td>
					<td><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 2</td>
					<td>222</td>
					<td>02/03/2014</td>
					<td>e_value,f_value</td>
					<td><span class="label lightblue">Tag3</span><span class="label lightblue">Tag4</span><span class="label lightblue">Tag5</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 3</td>
					<td>33</td>
					<td>02/03/2014</td>
					<td>a_value,bb_value</td>
					<td><span class="label lightblue">Tag5</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 4</td>
					<td>444</td>
					<td>03/24/2014</td>
					<td>a_value,f_value</td>
					<td><span class="label lightblue">Tag4</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 5</td>
					<td>55</td>
					<td>03/22/2014</td>
					<td>a_value,c_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 1</td>
					<td>300</td>
					<td>02/20/2014</td>
					<td>a_value,b_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag3</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 2</td>
					<td>242</td>
					<td>02/04/2014</td>
					<td>d_value,aa_value</td>
					<td><span class="label lightblue">Tag1</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 3</td>
					<td>703</td>
					<td>02/05/2014</td>
					<td>a_value,c_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 4</td>
					<td>604</td>
					<td>02/25/2014</td>
					<td>a_value,bb_value</td>
					<td><span class="label lightblue">Tag1</span><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 5</td>
					<td>550</td>
					<td>02/01/2014</td>
					<td>c_value,e_value</td>
					<td><span class="label lightblue">Tag2</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 1</td>
					<td>901</td>
					<td>02/02/2014</td>
					<td>a_value,e_value</td>
					<td><span class="label lightblue">Tag1</span></td>
				  </tr>
				  <tr class="gradeA">
					<td>Some Data 11</td>
					<td>911</td>
					<td>02/22/2014</td>
					<td>a_value,e_value</td>
					<td><span class="label lightblue">Tag11</span></td>
				  </tr>				  
				</tbody>
			  </table>
			</div>
			<br><br>
			<div id="table_2">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="entrys_table" width="100%">
					<thead>
						<tr>
							<th width="20%">Rendering engine</th>
							<th width="25%">Browser</th>
							<th width="25%">Platform(s)</th>
							<th width="15%">Engine version</th>
							<th width="15%">CSS grade</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
    </div>
	<div class="panel">
			<div id="features" class="center">
				<div class="panel_title">Features:</div>	
				<ul>
					<li>
						Support DataTables 1.10.0 - Use yadcf.init(...) for new API (Capital "D")
					</li>
					<li class="bold-text">
						Support all data source: DOM, Javascript, Ajax and server-side processing (1.10.0 +)
					</li>
					<li>
						Various filter options - 9 different types !!! :
						<ul>
							<li>select input</li>
							<li>multiple selection input</li>
							<li>text input</li>
							<li>autocomplete input - make use of the jQuery UI Autocomplete widget (with some enhancements)</li>
							<li>date input - make use of the jQuery UI Datepicker widget (with some enhancements)</li>
							<li>range of numbers</li>
							<li>range of numbers with slider widget - make use of the jQuery UI Slider widget (with some enhancements)</li>
							<li>range of dates - make use of the jQuery UI Datepicker widget (with some enhancements)</li>
							<li class="bold-text">custom function</li>
						</ul>
					</li>
					<li class="bold-text">
						Filters can be placed in the header (thead) or in the footer (tfoot) , second argument of yadcf constructor
						or third argument of init function
					</li>
					<li>
						Parsing various types of columns:
						<ul>
							<li>plain text</li>
							<li>plain text with delimiter</li>
							<li>one or more HTML elements with the ability to extract text / value / id from each HTML element</li>
						</ul>
					</li>
					<li>
						Multiple tables support
					</li>
					<li>
						CSS support:
						<ul>
							<li>each filter element has got a css style class , so its style can be easily overridden</li>
						</ul>
					</li>
					<li>
						Reset button for filter:
						<ul>
							<li>next to each filter a reset button will appear (this button allows the user to reset the filter)</li>
						</ul>
					</li>
					<li>
						Filter in use visual notification:
						<ul>
							<li>when a certain filter is being used it will be highlighted (the color of highlight can easily be changed with css)</li>
						</ul>
					</li>
					<li>
						Miscellaneous:
						<ul>
							<li>integration with the Chosen / Select2 plugins (for single and multiple select)</li>
							<li>integration with the Datatables ColVis plugin (1.10.0 +)</li>
							<li class="bold-text">filter delay (for text / range_number / range_date filters / range_number_slider)</li>
							<li>predefined data source for filter (array of strings or objects)</li>
							<li>mData support (including deeply nested objects)</li>
							<li>ability to place the filter in an external html element (for example: inside a div element)</li>
							<li>ability to control matching mode of the filter (Possible values: contains / exact / startsWith)</li>
							<li>change the filter's default label (Select value, etc)</li>
							<li>change the filter's reset button text (x, clear etc)</li>
							<li>define how the values in the filter will be sorted</li>
							<li>define the order in which the values in the filter will be sorted</li>
							<li>support all major browser (including IE8)</li>
							<li>define in which date format the date will be parsed and displayed in datepicker widget</li>
							<li>support aoColumns { "bVisible": false }</li>
							<li>support for case sensitive filtering</li><li>allow addition of classes to filters</li>
						</ul>
					</li>
					<li>
						External API functions:
						<ul>
							<li>exFilterColumn: Allows to trigger filter/s externally/programmatically (support ALL filter types!!!) , perfect for showing table with pre filtered columns</li>
							<li>exGetColumnFilterVal: Allows to retrieve  column current filtered value (support ALL filter types!!!)</li>
							<li>exResetAllFilters: Allows to reset all filters externally/programmatically (support ALL filter types!!!) , perfect for adding a "reset all" button to your page!</li>
						</ul>
					</li>
					<li>
						Notable datatables API / Features support
						<ul>
							<li class="bold-text">ColReorder / scrollX / scrollY / stateSave / deferRender / HTML5 data-* attributes / Complex headers</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>		
		<div class="panel">
			<div id="source_code">
				<div class="panel_title">Usage(on this page example):</div>
					<pre class="brush: js">
					$(document).ready(function () {
					    'use strict';
					
					    var oTable,
							oTable2;
					    
					    oTable = $('#example').DataTable({
							stateSave: true
					    });
					    
					    //----------------------------------------------
					    //notice the new yadcf API for init the filters:
					    //----------------------------------------------
					    
					    yadcf.init(oTable, [{
					        column_number: 0
					    }, {
					        column_number: 1,
					        filter_type: "range_number_slider"
					    }, {
					        column_number: 2,
					        filter_type: "date"
					    }, {
					        column_number: 3,
					        filter_type: "auto_complete",
					        text_data_delimiter: ","
					    }, {
					        column_number: 4,
					        column_data_type: "html",
					        html_data_type: "text",
					        filter_default_label: "Select tag"
					    }]);
					
					    oTable2 = $('#entrys_table').DataTable({
					    	"responsive": true,
					        "processing": true,
					        "ajax": "resources/sources/deep.txt",
					        "columns": [{
					            "data": "engine"
					        }, {
					            "data": "browser"
					        }, {
					            "data": "platform.inner"
					        }, {
					            "data": "platform.details.0"
					        }, {
					            "data": "platform.details.1"
					        }]
					    });
					    
					    //----------------------------------------------
					    //notice the new yadcf API for init the filters:
					    //----------------------------------------------
					    
					    yadcf.init(oTable2, [{
					        column_number: 0
					    }, {
					        column_number: 1,
			                filter_type: "text",
					        exclude: true,
					        exclude_label: '!(not)'
					    }, {
					        column_number: 2,
					        filter_type: "auto_complete"
					    }, {
					        column_number: 3,
					        filter_type: "range_number_slider",
					        ignore_char: "-"
					    }, {
					        column_number: 4
					    }]);
					    
					    yadcf.exFilterColumn(oTable2, [[0, "Misc"]]);
					    
					    
				    	yadcf.initMultipleTables([oTable, oTable2], [{
							filter_container_id: 'multi-table-filter',
							filter_default_label: 'Filter all tables!'
						}]);
					});
					</pre>
			</div>
		</div>
		<div class="panel">
			<div id="all_params" class="center">
				<span class="panel_title">All available parameters</span>
				<span class="panel_title_small">(detailed documentation inside jquery.dataTables.yadcf.js):</span>
				<ul>
					<li>column_number</li>
					<li>filter_type</li>
					<li>custom_func</li>
					<li>data</li><li>append_data_to_table_data</li>
					<li>column_data_type</li>
					<li>text_data_delimiter</li>
					<li>html_data_type</li>
					<li>filter_container_id</li>
					<li>filter_default_label</li>
					<li>filter_reset_button_text</li>
					<li>enable_auto_complete</li>
					<li>sort_as</li>
					<li>sort_order</li>
					<li>date_format</li>
					<li>ignore_char</li>
					<li>filter_match_mode</li><li>exclude</li><li>exclude_label</li>
					<li>select_type</li>
					<li>select_type_options</li>
					<li>case_insensitive</li>
					<li>filter_delay</li>
				</ul>
			</div>
		</div>
  </body>
</html>
