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
 * Reflection or foreign key.
 */
final class ForeignKey
{
	public function __construct(
		public string $name,
		public array $columns,
		public string $targetTable,
		public array $targetColumns,
	) {
	}
}
