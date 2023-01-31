<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRolesTable extends AbstractMigration
{
    const TABLE = 'user_roles';

    public function up(): void
    {
        if (!$this->hasTable(self::TABLE)) {
            $table = $this->table(self::TABLE);
            $table->addColumn('label', 'string', ['length' => 100]);
            $table->create();
        }
    }

    public function down(): void
    {
        if ($this->hasTable(self::TABLE)) {
            $this->table(self::TABLE)->drop()->save();
        }
    }
}
