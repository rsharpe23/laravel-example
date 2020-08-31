<?php

namespace App\Extra;

use JsonSerializable;

class SerializableData implements JsonSerializable
{
	protected $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function jsonSerialize()
	{
		return $this->valueToSerialize();
	}

	protected function valueToSerialize()
	{
		return $this->value;
	}
}