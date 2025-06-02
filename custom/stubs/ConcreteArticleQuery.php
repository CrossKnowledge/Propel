<?php

use CK\Runtime\Lib\Connection\PropelPDO;
use CK\Runtime\Lib\Exception\PropelException;
use CK\Runtime\Lib\Propel;

class ConcreteArticleQuery {
    protected PropelPDO $con;

    public static function create(): ConcreteArticleQuery
    {
        return new self();
    }

    /**
     * @throws PropelException
     */
    public function find(): array
    {
        $con = Propel::getConnection('bookstore');
        $stmt = $con->query("SELECT * FROM concrete_article");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
