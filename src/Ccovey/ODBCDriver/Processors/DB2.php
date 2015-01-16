<?php namespace Ccovey\ODBCDriver\Processors;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Processors\Processor;

class DB2 extends Processor {
	
	
	/**
	 * Process an  "insert get ID" query.
	 *
	 * @param  \Illuminate\Database\Query\Builder  $query
	 * @param  string  $sql
	 * @param  array   $values
	 * @param  string  $sequence
	 * @return int
	 */
	public function processInsertGetId(Builder $query, $sql, $values, $sequence = null)
	{
		$sequence = $sequence ?: 'id';
		$query->getConnection()->insert($sql, $values);
		$result = $query->getConnection()->selectOne('SELECT IDENTITY_VAL_LOCAL() AS LASTID FROM SYSIBM.SYSDUMMY1');
		$id = $result->LASTID;
		return is_numeric($id) ? (int) $id : $id;
	}

	/**
	 * Process the results of a column listing query.
	 *
	 * @param  array  $results
	 * @return array
	 */
	public function processColumnListing($results)
	{
		return array_map(function($r) { return $r->column_name; }, $results);
	}

}
