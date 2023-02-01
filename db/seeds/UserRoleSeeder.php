<?php

use Phinx\Seed\AbstractSeed;

class UserRoleSeeder extends AbstractSeed
{
    const TABLE = 'user_roles';

    public function run(): void
    {
        $roles = [
            ['label' => 'author'],
            ['label' => 'reviewer'],
            ['label' => 'publisher']
        ];

        if ($this->hasTable(self::TABLE)) {
            $table = $this->table(self::TABLE);
            foreach ($roles as $role) {
                $table->insert($role)->saveData();
            }
        }
    }
}
