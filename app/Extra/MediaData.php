<?php

namespace App\Extra;

use Illuminate\Support\Facades\Storage;

class MediaData extends SerializableData
{
	public function __construct($attachment)
	{
		parent::__construct([
			'id' => $attachment->id,
            'src' => $attachment->src,
            'name' => $attachment->name,
            'mime_type' => Storage::mimeType($attachment->uuid),
            'size' => Storage::size($attachment->uuid),
            'created_at' => $attachment->created_at->toDateTimeString(),
            'updated_at' => $attachment->updated_at->toDateTimeString(),
        ]);
	}
}

// class MediaData extends SerializableData
// {
// 	protected $localUrl;

// 	public function __construct($mediaFile, $localUrl = false)
// 	{
// 		$this->localUrl = $localUrl;

// 		parent::__construct([
//             'url' => Storage::url($mediaFile->src),
//             'mime_type' => Storage::mimeType($mediaFile->src),
//             'size' => Storage::size($mediaFile->src),
//             'created_at' => $mediaFile->created_at->toDateTimeString(),
//             'updated_at' => $mediaFile->updated_at->toDateTimeString(),
//         ]);
// 	}

// 	protected function valueToSerialize()
// 	{
// 		if (!$this->localUrl) {
// 			return array_merge($this->value, [
// 				'url' => url($this->value['url'])
// 			]);
// 		}

// 		return $this->value;
// 	}
// }