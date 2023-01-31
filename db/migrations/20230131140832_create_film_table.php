<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateFilmTable extends AbstractMigration
{
    const TABLE = 'films';

    public function up(): void
    {
        if (!$this->hasTable(self::TABLE)) {
            $table = $this->table(self::TABLE);
            $table->addColumn('name', 'string');
            $table->addColumn('year', 'integer');
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
