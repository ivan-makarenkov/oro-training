<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable(UserNamingType::TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('title', 'string', ['length' => 64]);
        $table->addColumn('format', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }
}
