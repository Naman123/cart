
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

	public function indexBy($arr, $key) {
		$newArr = [];
		foreach ($arr as $item) {
			if (is_array($item)) {
				$newArr[$item[$key]] = $item;
			} else {
				$newArr[$item->$key] = $item;
			}
		}

		return $newArr;
	}
}
