<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonOpenstreetmap extends SppagebuilderAddons {

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';

		//Options
		$map_style = (isset($this->addon->settings->map_style) && $this->addon->settings->map_style) ? $this->addon->settings->map_style : 'CartoDB.Voyager';
		$zoom = (isset($this->addon->settings->zoom) && $this->addon->settings->zoom) ? $this->addon->settings->zoom : 0;
		$mousescroll = (isset($this->addon->settings->mousescroll) && $this->addon->settings->mousescroll) ? $this->addon->settings->mousescroll : 0;
		$dragging = (isset($this->addon->settings->dragging) && $this->addon->settings->dragging) ? $this->addon->settings->dragging : 0;
		$zoomcontrol = (isset($this->addon->settings->zoomcontrol) && $this->addon->settings->zoomcontrol) ? $this->addon->settings->zoomcontrol : 0;
		$attribution = (isset($this->addon->settings->attribution) && $this->addon->settings->attribution) ? $this->addon->settings->attribution : 0;

		$total_location = [];
		if((array) $this->addon->settings->multi_location_items){
			foreach($this->addon->settings->multi_location_items as $key => $item){
				$lat_long = explode(',', $item->location_item);
				$total_location[] = array(
					'address'=>$item->location_popup_text,
					'latitude'=>$lat_long[0],
					'longitude'=>$lat_long[1],
					'custom_icon'=>(isset($item->custom_icon) && $item->custom_icon ? JURI::base(true) . '/' . $item->custom_icon : '')
				);
			}
		}
		$location_json = json_encode($total_location);

		$output = '';
		if($location_json){
			$output .= '<div class="sppb-addon-openstreetmap-wrapper">';
			$output .= '<div class="sppb-addon-content">';
				$output .= '<div id="sppb-addon-osm-' . $this->addon->id .'" class="sppb-addon-openstreetmap '.$class.'" data-location=\''.$location_json.'\' data-mapstyle="' . $map_style . '" data-mapzoom="'. $zoom .'" data-mousescroll="'. $mousescroll .'" data-dragging="'. $dragging .'" data-zoomcontrol="'. $zoomcontrol .'" data-attribution="'. $attribution .'"></div>';
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public function scripts() {
		return array(
			JURI::base(true) . '/components/com_sppagebuilder/assets/js/leaflet.js',
			JURI::base(true) . '/components/com_sppagebuilder/assets/js/leaflet.provider.js',
		);
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/leaflet.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 0;
		$height_sm = (isset($this->addon->settings->height_sm) && $this->addon->settings->height_sm) ? $this->addon->settings->height_sm : 0;
		$height_xs = (isset($this->addon->settings->height_xs) && $this->addon->settings->height_xs) ? $this->addon->settings->height_xs : 0;

		$css = '';
		if($height) {
			$css .= $addon_id . ' .sppb-addon-openstreetmap {';
			$css .= 'height:' . (int) $height . 'px;';
			$css .= '}';
		}

		if ($height_sm) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-addon-openstreetmap {';
				$css .= 'height:' . (int) $height_sm . 'px;';
				$css .= '}';
			$css .= '}';
		}

		if ($height_xs) {
			$css .= '@media (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-addon-openstreetmap {';
				$css .= 'height:' . (int) $height_xs . 'px;';
				$css .= '}';
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#

			let location_addr = [];
			if(_.isObject(data.multi_location_items) && data.multi_location_items){
				_.each(data.multi_location_items, function(item){
					let latLong = _.split(item.location_item, ",");
					let mainObj = [{
						address: item.location_popup_text,
						latitude: latLong[0],
						longitude: latLong[1],
						custom_icon: (!_.isEmpty(item.custom_icon) && item.custom_icon ? pagebuilder_base + "/" + item.custom_icon : "")
					}];
					location_addr = _.concat(location_addr, mainObj);
				})
			}

			let location_json = JSON.stringify(location_addr);
			
		#>
		<style type="text/css">
		#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
			<# if(_.isObject(data.height)){ #>
				height: {{ data.height.md }}px;
			<# } else { #>
				height: {{ data.height }}px;
			<# } #>
		}
		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.sm }}px;
				<# } #>
			}
		}
		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.xs }}px;
				<# } #>
			}
		}
		</style>
		<div class="sppb-addon-openstreetmap-wrapper edit-view">
			<div class="sppb-addon-content">
				<div id="sppb-addon-osm-{{ data.id }}" class="sppb-addon-openstreetmap {{data.class}}" data-location=\'{{location_json}}\' data-mapstyle="{{data.map_style}}" data-mapzoom="{{data.zoom}}" data-mousescroll="{{data.mousescroll}}" data-dragging="{{data.dragging}}" data-zoomcontrol="{{data.zoomcontrol}}" data-attribution="{{data.attribution}}"></div>
			</div>
		</div>
		';

		return $output;
	}
}
