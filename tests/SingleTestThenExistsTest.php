<?php

/*
 * Copyright (c) 2023 Sura
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

declare(strict_types=1);

namespace Temis\Database\Tests;

use Temis\Database\Database;

class SingleTestThenExistsTest extends DatabaseWriteTest
{
    protected function getResultForMethod(Database $db, $statement, $params)
    {
        $args = $params;
        array_unshift($args, $statement);
        return call_user_func_array([$db, 'exists'], $args);
    }

    /**
     * @dataProvider goodFactoryCreateArgument2DatabaseInsertManyProvider
     * @depends      Temis\Database\Tests\Is1DArrayThenDeleteReadOnlyTest::testDeleteThrowsException
     * @depends      Temis\Database\Tests\Is1DArrayThenDeleteReadOnlyTest::testDeleteTableNameEmptyThrowsException
     * @depends      Temis\Database\Tests\Is1DArrayThenDeleteReadOnlyTest::testDeleteTableNameInvalidThrowsException
     * @depends      Temis\Database\Tests\Is1DArrayThenDeleteReadOnlyTest::testDeleteConditionsReturnsNull
     * @depends      Temis\Database\Tests\InsertManyTest::testInsertMany
     * @depends      Temis\Database\Tests\SingleTest::testMethod
     * @param callable $cb
     * @param array $insertMany
     */
    public function testExists(callable $cb, array $insertMany)
    {
        $db = $this->databaseExpectedFromCallable($cb);
        $this->assertFalse(
            $db->exists('SELECT COUNT(*) FROM irrelevant_but_valid_tablename')
        );
        $db->insertMany('irrelevant_but_valid_tablename', $insertMany);
        $this->assertTrue(
            $db->exists('SELECT COUNT(*) FROM irrelevant_but_valid_tablename')
        );
        foreach ($insertMany as $insertVal) {
            $this->assertTrue(
                $this->getResultForMethod(
                    $db,
                    'SELECT COUNT(*) FROM irrelevant_but_valid_tablename WHERE foo = ?',
                    array_values($insertVal)
                )
            );
            $db->delete('irrelevant_but_valid_tablename', $insertVal);
            $this->assertFalse(
                $this->getResultForMethod(
                    $db,
                    'SELECT COUNT(*) FROM irrelevant_but_valid_tablename WHERE foo = ?',
                    array_values($insertVal)
                )
            );
        }
        $this->assertFalse(
            $db->exists('SELECT COUNT(*) FROM irrelevant_but_valid_tablename')
        );
    }
}
