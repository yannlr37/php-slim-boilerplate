<?php


use Phinx\Seed\AbstractSeed;
use Sheepdev\Auth\PasswordCryptService;

class DefaultUserSeeder extends AbstractSeed
{
    const TABLE = 'users';

    public function run(): void
    {
        $passwordCryptService = new PasswordCryptService();

        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'DOE',
                'email' => 'john.doe@example.com',
                'password' => $passwordCryptService->encryptPassword('admin'),
                'sessionToken' => '',
                'roles' => 'author,reviewer,publisher'
            ]
        ];

        if ($this->hasTable(self::TABLE)) {
            $table = $this->table(self::TABLE);
            foreach ($users as $user) {
                $table->insert($user)->saveData();
            }
        }
    }
}
