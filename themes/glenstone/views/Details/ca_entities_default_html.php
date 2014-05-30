<?php
	$t_entity = $this->getVar("item");
	$va_comments = $this->getVar("comments");
?>
		<div class="row">
			<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>
				<div class="detailNavBgLeft">
					{{{previousLink}}}{{{resultsLink}}}
				</div><!-- end detailNavBgLeft -->
			</div><!-- end col -->
			<div class='col-xs-10 col-sm-10 col-md-10 col-lg-10'>
	
			</div>
			<div class='col-xs-1 col-sm-1 col-md-1 col-lg-1'>
				<div class="detailNavBgRight">
					{{{nextLink}}}
				</div><!-- end detailNavBgLeft -->
			</div><!-- end col -->
		</div><!-- end row -->
		<div class="row">
			<div class="container">
				<div class="artworkTitle">
					<H4>{{{^ca_entities.preferred_labels.displayname}}}</H4>
					<H5>{{{ca_entities.entity_dates}}}{{{<ifdef code="ca_entities.nationality,ca_entities.entity_dates" >,</ifdef>}}} {{{<ifcount min="1" code="ca_entities.nationality"><unit delimiter=", ">^ca_entities.nationality</unit></ifcount>}}}</H5> 
				</div>
				<div class='col-sm-12 col-md-12 col-lg-12'>
					
			<!-- Related Artworks -->
<?php			
		if ($va_artwork_ids = $t_entity->get('ca_objects.object_id', array('restrictToTypes' => array('artwork'), 'returnAsArray' => true))) {	
?>		
			<div id="detailRelatedObjects">
				<H6>Related Artworks </H6>
				<div class="jcarousel-wrapper">
					<div id="detailScrollButtonNext"><i class="fa fa-angle-right"></i></div>
					<div id="detailScrollButtonPrevious"><i class="fa fa-angle-left"></i></div>
					<!-- Carousel -->
					<div class="jcarousel">
						<ul>
<?php
						foreach ($va_artwork_ids as $va_object_id => $va_artwork_id) {
							$t_object = new ca_objects($va_artwork_id);
							print "<li>";
							print "<div class='detailObjectsResult'>".caNavLink($this->request, $t_object->get('ca_object_representations.media.library'), '', '', 'Detail', 'objects/'.$va_artwork_id)."</div>";
							print "<div class='caption'>".caNavLink($this->request, $t_object->get('ca_entities.preferred_labels', array('restrictToRelationshipTypes' => array('artist')))."<br/><i>".$t_object->get('ca_objects.preferred_labels')."</i>, ".$t_object->get('ca_objects.creation_date'), '', '', 'Detail', 'objects/'.$va_artwork_id)."</div>";
							print "</li>";
						}
?>						
						</ul>
					</div><!-- end jcarousel -->
					
				</div><!-- end jcarousel-wrapper -->
			</div><!-- end detailRelatedObjects -->
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					/*
					Carousel initialization
					*/
					$('.jcarousel')
						.jcarousel({
							// Options go here
						});
			
					/*
					 Prev control initialization
					 */
					$('#detailScrollButtonPrevious')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '-=1'
						});
			
					/*
					 Next control initialization
					 */
					$('#detailScrollButtonNext')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '+=1'
						});
				});
			</script>
<?php
		}
?>			
		<!-- Related Artworks -->
					
		<!-- Related Archival Materials -->
			
		{{{<ifcount code="ca_objects" restrictToTypes="audio|moving_image|image|ephemera|document" min="1">
			<div id="detailRelatedArchives">
				<H6>Related Archival Material </H6>
				<div class="jcarousel-wrapper">
					<div id="detailScrollButtonNextArchive"><i class="fa fa-angle-right"></i></div>
					<div id="detailScrollButtonPreviousArchive"><i class="fa fa-angle-left"></i></div>
					<!-- Carousel -->
					<div class="jcarouselarchive">
						<ul>
							<unit relativeTo="ca_objects"  restrictToTypes="audio|moving_image|image|ephemera|document" delimiter=" "><li><div class='detailObjectsResult'><l>^ca_object_representations.media.library</l></div><div class='caption'><i><l>^ca_objects.preferred_labels.name</l></i><ifdef code="ca_objects.dc_date.dc_dates_value"><br/><l>^ca_objects.dc_date.dc_dates_value</l></ifdef></div></li><!-- end detailObjectsBlockResult --></unit>
						</ul>
					</div><!-- end jcarousel -->
					
				</div><!-- end jcarousel-wrapper -->
			</div><!-- end detailRelatedObjects -->
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					/*
					Carousel initialization
					*/
					$('.jcarouselarchive')
						.jcarousel({
							// Options go here
						});
			
					/*
					 Prev control initialization
					 */
					$('#detailScrollButtonPreviousArchive')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '-=1'
						});
			
					/*
					 Next control initialization
					 */
					$('#detailScrollButtonNextArchive')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '+=1'
						});
				});
			</script></ifcount>}}}<!-- Related Archives -->
			
		<!-- Related Library Materials -->
			
		{{{<ifcount code="ca_objects" restrictToTypes="book" min="1">
			<div id="detailRelatedLibrary">
				<H6>Related Library Material </H6>
				<div class="jcarousel-wrapper">
					<div id="detailScrollButtonNextLibrary"><i class="fa fa-angle-right"></i></div>
					<div id="detailScrollButtonPreviousLibrary"><i class="fa fa-angle-left"></i></div>
					<!-- Carousel -->
					<div class="jcarouselLibrary">
						<ul>
							<unit relativeTo="ca_objects"  restrictToTypes="book" delimiter=" "><li><div class='detailObjectsResult'><l>^ca_object_representations.media.library</l></div><div class='caption'><i><l>^ca_objects.preferred_labels.name</l></i><ifdef code="ca_objects.creation_date">, ^ca_objects.creation_date</ifdef></div></li><!-- end detailObjectsBlockResult --></unit>
						</ul>
					</div><!-- end jcarousel -->
					
				</div><!-- end jcarousel-wrapper -->
			</div><!-- end detailRelatedObjects -->
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					/*
					Carousel initialization
					*/
					$('.jcarouselLibrary')
						.jcarousel({
							// Options go here
						});
			
					/*
					 Prev control initialization
					 */
					$('#detailScrollButtonPreviousLibrary')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '-=1'
						});
			
					/*
					 Next control initialization
					 */
					$('#detailScrollButtonNextLibrary')
						.on('jcarouselcontrol:active', function() {
							$(this).removeClass('inactive');
						})
						.on('jcarouselcontrol:inactive', function() {
							$(this).addClass('inactive');
						})
						.jcarouselControl({
							// Options go here
							target: '+=1'
						});
				});
			</script></ifcount>}}}<!-- Related Archives -->		
			
				</div><!-- end col -->
			</div><!-- end container -->
		</div><!-- end row -->	
		<div class="row">
			
			<div class='col-md-6 col-lg-6'> 
<?php
#				if ($t_entity->get('ca_entities.locations.location_description') != "") {			
#					$va_locations = $t_entity->get('ca_entities.locations', array('returnAsArray' => true));
#					print "<H6>Location</H6>";
#					foreach ($va_locations as $va_location) {
#						print "<p>".$va_location['location_type'].": ".$va_location['location_description']."</p>";
#						
#					}
#				}
	
?>		
			<h2>Other Information</h2>
			
				{{{<ifcount min="1" code="ca_entities.locations.location_description"><H6>Location</H6></ifcount>}}}
				{{{<unit delimiter="<br/>">^ca_entities.locations.location_type<ifdef code="ca_entities.locations.location_type,ca_entities.locations.location_description">: </ifdef>^ca_entities.locations.location_description</unit>}}} 
					
				{{{<ifdef code="ca_entities.affiliation|ca_entities.job_title"><H6>Affiliation</H6></ifdef>}}}
				{{{^ca_entities.affiliation}}}{{{<ifdef code="ca_entities.affiliation,ca_entities.job_title">: </ifdef>}}}{{{^ca_entities.job_title}}} 
				
				
				{{{<ifcount code="ca_entities.related" min="1" max="1"><H6>Related person</H6></ifcount>}}}
				{{{<ifcount code="ca_entities.related" min="2"><H6>Related people</H6></ifcount>}}}
				{{{<unit relativeTo="ca_entities" delimiter="<br/>">^ca_entities.related.preferred_labels.displayname</unit><br/><br/>}}}
			</div><!-- end col -->
			<div class='col-md-6 col-lg-6'>
				

			</div><!-- end col -->
		</div><!-- end row -->