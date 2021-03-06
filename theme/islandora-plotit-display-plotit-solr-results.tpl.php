<?php
/**
 * @file
 * Islandora PlotIt Solr results template.
 *
 * Variables available:
 * - $solr_search: The Solr search URL for use in the preprocess.
 * - $solr_query_processor: The IslandoraSolrResults class, being passed through for the preprocess.
 *
 * @see islandora_plotit_preprocess_islandora_plotit_display_ploitit_solr_results().
 */
?>
<table id="frame">
<tr>
<td id="sidebar">
<h2>CWRC TimeMap v0.0.6</h2>
<div ex:role="coordinator" id="bubble-coordinator"></div>

<b>How to use search:</b><br />
<small>Search below by choosing a facet or typing keywords. To restart your search, click on "Reset all Filters" above the map.</small>
<hr />

<div id="exhibit-browse-panel">
<p><b>Historical map:</b> <a href="#" onclick="javascript:addOverlay();">Show</a> | <a href="#" onclick="javascript:removeOverlay();">Hide</a></p>
<b>Search:</b>
<div ex:role="facet" ex:facetClass="TextSearch"></div>
<div ex:role="facet" ex:expression=".startDate" ex:facetLabel="Date Slider" ex:facetClass="Slider" ex:horizontal="true" ex:precision="1" ex:histogram="true" ex:width="285px"></div>
<div ex:role="facet" ex:expression=".group" ex:facetLabel="Collection" ex:height="3em"></div>
<div ex:role="facet" ex:expression=".subGroup" ex:facetLabel="Sub-Groups" ex:height="3em"></div>
<div ex:role="facet" ex:expression=".eventType" ex:facetLabel="Event Type" ex:height="3em"></div>
<div ex:role="facet" ex:expression=".locationType" ex:facetLabel="Location Granularity" ex:height="3em"></div>
<div ex:role="facet" ex:expression=".dateType" ex:facetLabel="Date Granularity" ex:height="3em"></div>
<div ex:role="facet" ex:expression=".pointType" ex:facetLabel="Point Type" ex:height="3em"></div>
</div>
</td>

<td id="content">
<div class="item" ex:role="lens" style="display: none; overflow: auto; width: 300px; height: 100px;">
<!-- Begin popup. If only this is set, it will be used for the map markers too. Can be disabled for timeline, and show on map only as well -->
<table cellpadding="2" width="100%" style="font-size: 13px; color: #777; font-family: Arial, Tahoma, Sans-serif;">
<tr>
<td width="1">
<img ex:if-exists=".images" ex:src-content=".images" width="100px" />
</td>
<td width="1">
<iframe width="150" height="150" ex:if-exists=".videos" ex:src-content=".videos" frameborder="0" allowfullscreen></iframe>
</td>
<td>
<a ex:if-exists=".urls" ex:href-content=".urls"><span ex:content=".label" /></a>
<div><b><span ex:if-exists=".location" ex:content=".location"></span>.</b> <span ex:content=".longLabel"></span> <span ex:content=".description"></span></div>
</td>
</tr>
</table>
<!-- End timeline popup -->
</div>

<div ex:role="coder" ex:coderClass="Color" id="event-colors">
<span ex:color="#f00">BIBLIFO</span>
<span ex:color="#0f0">LGLC</span>
<span ex:color="#00f">MULTIMEDIA</span>
<span ex:color="#ff0">ORLANDO</span>
</div>

<!-- Example for customizing icons without any data manipulations -->
<div ex:role="coder" ex:coderClass="Icon" id="event-icons" style="display:none;">
<span ex:icon="http://simile.mit.edu/painter/painter?renderer=map-marker&shape=circle&width=15&height=15&pinHeight=5&background=f00">BIBLIFO</span>
<span ex:icon="http://simile.mit.edu/painter/painter?renderer=map-marker&shape=circle&width=15&height=15&pinHeight=5&background=0f0">LGLC</span>
<span ex:icon="http://simile.mit.edu/painter/painter?renderer=map-marker&shape=circle&width=15&height=15&pinHeight=5&background=00f">MULTIMEDIA</span>
<span ex:icon="http://simile.mit.edu/painter/painter?renderer=map-marker&shape=circle&width=15&height=15&pinHeight=5&background=ff0">ORLANDO</span>
</div>

<!-- This sychronizes the showing of popups, i.e. if a map marker is clicked, the popup on the timeline also shows -->
<div ex:role="coordinator" id="event"></div>

<!-- Begin timeline component -->
<div ex:role="view"
ex:viewClass="Timeline"
ex:label="Timeline"
ex:start=".startDate"
ex:end=".endDate"
ex:bubbleWidth="350"
ex:topBandPixelsPerUnit="400"
ex:showSummary="false"
ex:iconCoder="event-icons"
ex:iconKey=".group"
ex:timelineHeight="170"
ex:selectCoordinator="bubble-coordinator">
</div>
<!-- End timeline component -->

<div ex:role="viewPanel">
<!-- This controls a custom popup for the map markers. Disabling it causes the same popup to be used for both timeline and map -->
<div class="map-lens" ex:role="lens" style="display: none; text-align: left; overflow: auto; width: 300px; height: 100px;">
<table cellpadding="2" width="100%">
<tr>
<td width="1">
<img ex:if-exists=".images" ex:src-content=".images" width="100px" />
</td>
<td width="1">
<iframe width="150" height="150" ex:if-exists=".videos" ex:src-content=".videos" frameborder="0" allowfullscreen></iframe>
</td>
<td>
<a ex:if-exists=".urls" ex:href-content=".urls"><span ex:content=".label" /></a>
<div><b><span ex:if-exists=".location" ex:content=".location"></span>.</b> <span ex:content=".longLabel"></span> <span ex:content=".description"></span></div>
</td>
</tr>
</table>
</div>

<!-- Begin map control, same map can hold multiple views, only one is needed here -->
<div ex:role="view"
                     id="map1"
ex:viewClass="MapView"
ex:label="Map View"
ex:latlng=".latLng"
ex:latlngOrder="lnglat"
ex:latlngPairSeparator="|"
ex:polygon=".polygon"
ex:polyline=".polyline"
ex:opacity="0.5"
ex:borderWidth="4"
ex:center="38.479394673276445, -115.361328125"
ex:zoom="3"
ex:colorCoder="event-colors"
ex:colorKey=".group"
ex:shapeWidth="20"
ex:shapeHeight="20"
ex:selectCoordinator="bubble-coordinator">
</div>
<!-- End map control -->

<!-- Begin data details -->
<div ex:role="view"
ex:viewClass=""
ex:label="List View"
ex:columns=".label, .group, .subGroup, .eventType, .location, .startDate, .endDate"
ex:columnLabels="Title, Collection, Sub-group, Event Type, Location, Start, End"
ex:sortAscending="false">

<table style="display: none;">
<tr>
<td><b ex:content=".label"></b></td>
<td><span ex:content=".group"></span></td>
<td><span ex:content=".subGroup"></span></td>
<td><span ex:content=".eventType"></span></td>
<td><span ex:content=".location"></span></td>
<td><span ex:content=".startDate"></span></td>
<td><span ex:if-exists=".endDate" ex:content=".endDate"></span></td>
</tr>
</table>
</div>

<!-- Begin tabular details -->
<div ex:role="view"
ex:viewClass="Tabular"
ex:label="Grid View"
ex:columns=".label, .group, .subGroup, .eventType, .location, .startDate, .endDate"
ex:columnLabels="Title, Collection, Sub-group, Event Type, Location, Start, End"
ex:sortAscending="false">
<table style="display: none;">
<tr>
<td><b ex:content=".label"></b></td>
<td><span ex:content=".group"></span></td>
<td><span ex:content=".subGroup"></span></td>
<td><span ex:content=".eventType"></span></td>
<td><span ex:content=".location"></span></td>
<td><span ex:content=".startDate"></span></td>
<td><span ex:if-exists=".endDate" ex:content=".endDate"></span></td>
</tr>
</table>
</div>
</div>
</td>
</tr>
</table>
