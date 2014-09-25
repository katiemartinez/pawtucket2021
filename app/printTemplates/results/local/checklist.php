<?php
/* ----------------------------------------------------------------------
 * app/templates/checklist.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * -=-=-=-=-=- CUT HERE -=-=-=-=-=-
 * Template configuration:
 *
 * @name Checklist
 * @type page
 * @pageSize letter
 * @pageOrientation portrait
 * @tables ca_objects
 *
 * ----------------------------------------------------------------------
 */

	$t_display				= $this->getVar('t_display');
	$va_display_list 		= $this->getVar('display_list');
	$vo_result 				= $this->getVar('result');
	$vn_items_per_page 		= $this->getVar('current_items_per_page');
	$vs_current_sort 		= $this->getVar('current_sort');
	$vs_default_action		= $this->getVar('default_action');
	$vo_ar					= $this->getVar('access_restrictions');
	$vo_result_context 		= $this->getVar('result_context');
	$vn_num_items			= (int)$vo_result->numHits();
	
	$vn_start 				= 0;

	print $this->render("pdfStart.php");
	print $this->render("header.php");
	print $this->render("../footer.php");
?>
		<div class="criteria"><?php print $this->getVar('title'); ?></div>
		<div id='body'>
<?php
		if(file_exists($this->request->getThemeDirectoryPath()."/assets/pawtucket/graphics/".$this->request->config->get('report_img'))){
			print '<img src="'.$this->request->getThemeDirectoryPath().'/assets/pawtucket/graphics/'.$this->request->config->get('report_img').'" class="headerImg"/>';
		}
		if($this->request->config->get('report_show_search_term')) {
			print "<span class='footerText'>".$this->getVar('criteria_summary_truncated')."</span>";
		}
		$vo_result->seek(0);
		
		$vn_line_count = 0;
		while($vo_result->nextHit()) {
			$vn_object_id = $vo_result->get('ca_objects.object_id');		
?>
			<div class="row">
			<table>
			<tr>
				<td>
<?php 
					if ($vs_tag = $vo_result->get('ca_object_representations.media.page', array('scaleCSSWidthTo' => '80px', 'scaleCSSHeightTo' => '80px'))) {
						print "<div class=\"imageTiny\">{$vs_tag}</div>";
					} else {
?>
						<div class="imageTinyPlaceholder">&nbsp;</div>
<?php					
					}	
?>								

				</td>
				<td>
					<div class="metaBlock">
<?php
					print "<div class='title'>".$vo_result->get('ca_entities.preferred_labels.name', array('restrictToRelationshipTypes' => array('artist')))."</div>"; 				
					print "<div><i>".$vo_result->get('ca_objects.preferred_labels.name')."</i>, ".$vo_result->getWithTemplate('^ca_objects.creation_date')."</div>"; 
					print "<div>".$vo_result->get('ca_objects.medium')."</div>"; 	
					print "<div>".$vo_result->get('ca_objects.dimensions.display_dimensions')."</div>"; 				
					if ($vo_result->get('ca_objects.edition.edition_number') || $vo_result->get('ca_objects.edition.ap_number')) {
						print "<span>Edition </span>";
					}
					if ($vo_result->get('ca_objects.edition.edition_number')) {
						print "<div style='display:inline;'>".$vo_result->get('ca_objects.edition.edition_number')." / ".$vo_result->get('ca_objects.edition.edition_total')."</div>"; 	
					}
					if ($vo_result->get('ca_objects.edition.ap_number')) {
						print "<div style='display:inline;'>".$vo_result->get('ca_objects.edition.ap_number')." / ".$vo_result->get('ca_objects.edition.ap_total')."</div>"; 	
					}
					if ($this->request->user->hasUserRole("founder") || $this->request->user->hasUserRole("supercurator")){
						print "<div>".$vo_result->get('ca_objects.idno')."</div>"; 
						if ($vo_result->get('is_deaccessioned') && ($vo_result->get('deaccession_date', array('getDirectDate' => true)) <= caDateToHistoricTimestamp(_t('now')))) {
							print "<div style='font-style:italic; font-size:10px; color:red;'>"._t('Deaccessioned %1', $vo_result->get('deaccession_date'))."</div>\n";
						}						
					}													
								
						
?>
					</div>				
				</td>	
			</tr>
			</table>	
			</div>
<?php
		}
?>
		</div>
<?php
	print $this->render("../pdfEnd.php");
?>