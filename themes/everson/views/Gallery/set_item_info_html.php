<?php print "(".$this->getVar("set_item_num")."/".$this->getVar("set_num_items").")<br/>"; ?>
{{{<ifdef code="ca_objects.preferred_labels.name"><H6>^ca_objects.preferred_labels.name</H6><br/></ifdef>}}}

{{{<ifcount min="1" code="ca_objects.date.dates_value"><unit delimiter="<br/>">^ca_objects.date.dates_value (^ca_objects.date.dc_dates_types)</unit><br/><br/></ifcount>}}}
{{{<ifdef code="ca_objects.description">^ca_objects.description<br/><br/></ifdef>}}}

{{{<ifcount code="ca_entities" min="1" max="1"><b>Related person: </b></ifcount>}}}
{{{<ifcount code="ca_entities" min="2"><b>Related people: </b></ifcount>}}}
{{{<unit relativeTo="ca_entities" delimiter=", "><l>^ca_entities.preferred_labels.displayname</l></unit><br/><br/>}}}


<?php print caDetailLink($this->request, _t("VIEW RECORD"), '', 'ca_objects',  $this->getVar("object_id")); ?>