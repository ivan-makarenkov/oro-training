<?php

declare(strict_types=1);

namespace Training\Bundle\UserNamingBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingBundleInstaller implements Installation, ExtendExtensionAwareInterface
{
    private ExtendExtension $extendExtension;

    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion(): string
    {
        return 'v1_1';
    }

    /**
     * {@inheritdoc}
     * @throws SchemaException
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createUserNamingTypeTable($schema);

        /** Additional relations */
        $this->addRelationFromUser($schema);
    }

    /**
     * @param Schema $schema
     */
    protected function createUserNamingTypeTable(Schema $schema): void
    {
        $table = $schema->createTable('training_user_naming_type');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('title', 'string', ['length' => 64]);
        $table->addColumn('format', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     * @throws SchemaException
     */
    protected function addRelationFromUser(Schema $schema) :void
    {
        $table = $schema->getTable('oro_user');
        $this->extendExtension->addManyToOneRelation(
            $schema,
            $table,
            'namingType',
            UserNamingType::TABLE_NAME,
            'title',
            [
                'extend' => ['owner' => ExtendScope::OWNER_CUSTOM],
            ]
        );
    }

    /**
     * @param ExtendExtension $extendExtension
     */
    public function setExtendExtension(ExtendExtension $extendExtension): void
    {
        $this->extendExtension = $extendExtension;
    }
}
