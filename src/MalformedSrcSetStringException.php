<?php

namespace Mezun\GoGoMikeMike;

class MalformedSrcSetStringException extends \RuntimeException
{
	public function __construct( string $sizes_string )
	{
		parent::__construct( "Malformed srcset string given to SrcSet constructor: {$sizes_string}. Srcset item must have space separating URL & width." );
	}
}
