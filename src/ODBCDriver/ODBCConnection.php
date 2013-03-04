<?php

namespace Ccovey\ODBCDriver;

use Illuminate\Database as Database;

class ODBCConnection extends Database\Connection {

    /**
     * Get the default query grammar instance.
     *
     * @return Illuminate\Database\Query\Grammars\Grammars\Grammar
     */
    protected function getDefaultQueryGrammar() {
        return $this->withTablePrefix(new Query\Grammars\Grammar);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return Illuminate\Database\Schema\Grammars\Grammar
     */
    protected function getDefaultSchemaGrammar() {
        return $this->withTablePrefix(new Schema\Grammars\Grammar);
    }
}