<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    const TABLE = 'users';

    public function up(): void
    {
        if (!$this->hasTable(self::TABLE)) {
            $table = $this->table(self::TABLE);
            $table->addColumn('firstname', 'string', ['length' => 100]);
            $table->addColumn('lastname', 'string', ['length' => 100]);
            $table->addColumn('email', 'string');
            $table->addColumn('password', 'string');
            $table->addColumn('roles', 'string');
            $table->addTimestamps();
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
