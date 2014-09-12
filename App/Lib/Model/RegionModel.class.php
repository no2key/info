<?php
class RegionModel extends Model {
	public $regions;

	public function getRegion() {
		if (isset($this->regions)) {
			return $this->regions;
		}
		$reg = M('region');
		$regions = $reg->select();
		foreach ($regions as $r) {
			$this->regions[$r['id']] = $r['name'];
		}
		return $this->regions;
	}
}



?>