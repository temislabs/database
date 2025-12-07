<?php

/*
 * Copyright (c) 2023 Temis
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temis\Database\Reflection;


/**
 * Reflection of database table or view.
 */
final class Table
{
	public function __construct(
		public string $name,
		public bool $view = false,
		public ?string $fullName = null,
	) {
	}
}
